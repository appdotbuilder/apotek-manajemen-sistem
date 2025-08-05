<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Distributor
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $contact_person
 * @property string|null $notes
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductStock> $productStocks
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distributor active()
 * @method static \Database\Factories\DistributorFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Distributor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'address',
        'phone',
        'email',
        'contact_person',
        'notes',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product stocks for the distributor.
     */
    public function productStocks(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    /**
     * Scope a query to only include active distributors.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}