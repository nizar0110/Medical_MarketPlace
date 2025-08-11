<?php

namespace App\Traits;

trait HasERPRoles
{
    /**
     * ERP roles and their permissions
     */
    protected static array $erpRoles = [
        'admin' => [
            'erp.*',
        ],
        'warehouse_manager' => [
            'erp.inventory.*',
            'erp.inventory.warehouses.*',
            'erp.inventory.locations.*',
            'erp.inventory.stock.*',
        ],
        'accountant' => [
            'erp.accounting.*',
            'erp.accounting.journal.*',
            'erp.accounting.payments.*',
        ],
        'buyer' => [
            'erp.purchases.*',
            'erp.inventory.view',
        ],
        'sales_manager' => [
            'erp.sales.*',
            'erp.inventory.view',
        ],
        'seller' => [
            'erp.sales.quotes.create',
            'erp.sales.quotes.view-own',
            'erp.inventory.view',
        ],
        'client' => [
            'erp.sales.quotes.view-own',
            'erp.sales.orders.view-own',
        ],
    ];

    /**
     * Check if the user has a specific ERP role
     */
    public function hasERPRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if the user has any of the given ERP roles
     *
     * @param array|string $roles
     */
    public function hasAnyERPRole($roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return in_array($this->role, $roles);
    }

    /**
     * Check if the user has permission for a specific ERP action
     */
    public function hasERPPermission(string $permission): bool
    {
        if (!isset(self::$erpRoles[$this->role])) {
            return false;
        }

        $rolePermissions = self::$erpRoles[$this->role];

        // Admin has all permissions
        if ($this->role === 'admin' || in_array('erp.*', $rolePermissions)) {
            return true;
        }

        // Check specific permissions
        foreach ($rolePermissions as $rolePermission) {
            if ($this->matchPermission($permission, $rolePermission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if the user has any of the given ERP permissions
     *
     * @param array|string $permissions
     */
    public function hasAnyERPPermission($permissions): bool
    {
        $permissions = is_array($permissions) ? $permissions : [$permissions];
        
        foreach ($permissions as $permission) {
            if ($this->hasERPPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Match a permission against a pattern
     */
    protected function matchPermission(string $permission, string $pattern): bool
    {
        $pattern = str_replace('.', '\.', $pattern);
        $pattern = str_replace('*', '.*', $pattern);
        return (bool) preg_match('/^' . $pattern . '$/', $permission);
    }

    /**
     * Get all permissions for the user's role
     */
    public function getERPPermissions(): array
    {
        return self::$erpRoles[$this->role] ?? [];
    }
}
