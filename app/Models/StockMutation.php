<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\StockMutation
 *
 * @property int $id
 * @property string $mutation_number
 * @property int $product_stock_id
 * @property string $type
 * @property int $quantity
 * @property int $stock_before
 * @property int $stock_after
 * @property string|null $reason
 * @property string|null $reference_type
 * @property string|null $reference_id
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ProductStock $productStock
 * @property-read \App\Models\User $createdBy
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation query()
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereMutationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereProductStockId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereReferenceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereStockAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereStockBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StockMutation whereUpdatedAt($value)
 * @method static \Database\Factories\StockMutationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class StockMutation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'mutation_number',
        'product_stock_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'reason',
        'reference_type',
        'reference_id',
        'created_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'stock_before' => 'integer',
        'stock_after' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product stock that owns the mutation.
     */
    public function productStock(): BelongsTo
    {
        return $this->belongsTo(ProductStock::class);
    }

    /**
     * Get the user who created the mutation.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}