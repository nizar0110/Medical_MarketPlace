<?php

namespace App\Models\ERP\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\User;

class StockMovement extends Model
{
    protected $table = 'erp_inventory_stock_movements';

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'location_id',
        'movement_type',
        'quantity',
        'reference_type',
        'reference_id',
        'unit_cost',
        'total_cost',
        'notes',
        'performed_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    // Movement types
    const TYPE_IN = 'in';
    const TYPE_OUT = 'out';
    const TYPE_TRANSFER = 'transfer';
    const TYPE_ADJUSTMENT = 'adjustment';

    /**
     * Get the product this movement belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse this movement belongs to.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the location this movement belongs to.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Get the user who performed this movement.
     */
    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    /**
     * Check if this is an inbound movement.
     */
    public function isInbound(): bool
    {
        return $this->movement_type === self::TYPE_IN;
    }

    /**
     * Check if this is an outbound movement.
     */
    public function isOutbound(): bool
    {
        return $this->movement_type === self::TYPE_OUT;
    }

    /**
     * Check if this is a transfer movement.
     */
    public function isTransfer(): bool
    {
        return $this->movement_type === self::TYPE_TRANSFER;
    }

    /**
     * Check if this is an adjustment movement.
     */
    public function isAdjustment(): bool
    {
        return $this->movement_type === self::TYPE_ADJUSTMENT;
    }
}
