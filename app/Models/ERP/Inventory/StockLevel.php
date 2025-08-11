<?php

namespace App\Models\ERP\Inventory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;

class StockLevel extends Model
{
    protected $table = 'erp_inventory_stock_levels';

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'location_id',
        'quantity_on_hand',
        'quantity_reserved',
        'quantity_available',
        'reorder_point',
        'max_stock',
        'average_cost',
        'last_movement_date',
    ];

    protected $casts = [
        'quantity_on_hand' => 'integer',
        'quantity_reserved' => 'integer',
        'quantity_available' => 'integer',
        'reorder_point' => 'integer',
        'max_stock' => 'integer',
        'average_cost' => 'decimal:2',
        'last_movement_date' => 'datetime',
    ];

    /**
     * Get the product this stock level belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the warehouse this stock level belongs to.
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the location this stock level belongs to.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Check if the stock level is below reorder point.
     */
    public function needsReorder(): bool
    {
        return $this->quantity_available <= $this->reorder_point;
    }

    /**
     * Calculate the value of stock at this level.
     */
    public function getStockValue(): float
    {
        return $this->quantity_on_hand * $this->average_cost;
    }
}
