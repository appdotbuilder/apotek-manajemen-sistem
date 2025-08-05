<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\ProductStock
 *
 * @property int $id
 * @property int $product_id
 * @property int $distributor_id
 * @property string $batch_number
 * @property \Illuminate\Support\Carbon $expiry_date
 * @property float $cost_price
 * @property float $selling_price
 * @property int $current_stock
 * @property int $initial_stock
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Distributor $distributor
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\StockMutation> $mutations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SaleItem> $saleItems
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereBatchNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereCostPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereCurrentStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereDistributorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereExpiryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereInitialStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock available()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductStock notExpired()
 * @method static \Database\Factories\ProductStockFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class ProductStock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'product_id',
        'distributor_id',
        'batch_number',
        'expiry_date',
        'cost_price',
        'selling_price',
        'current_stock',
        'initial_stock',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiry_date' => 'date',
        'cost_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'current_stock' => 'integer',
        'initial_stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product that owns the stock.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the distributor that owns the stock.
     */
    public function distributor(): BelongsTo
    {
        return $this->belongsTo(Distributor::class);
    }

    /**
     * Get the mutations for the stock.
     */
    public function mutations(): HasMany
    {
        return $this->hasMany(StockMutation::class);
    }

    /**
     * Get the sale items for the stock.
     */
    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    /**
     * Scope a query to only include available stock.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('current_stock', '>', 0);
    }

    /**
     * Scope a query to only include non-expired stock.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotExpired($query)
    {
        return $query->where('expiry_date', '>', now());
    }

    /**
     * Check if stock is expired.
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expiry_date->isPast();
    }

    /**
     * Check if stock is near expiry (within 3 months).
     *
     * @return bool
     */
    public function isNearExpiry(): bool
    {
        return $this->expiry_date->diffInMonths(now()) <= 3;
    }
}