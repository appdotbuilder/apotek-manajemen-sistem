<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\AuditLog
 *
 * @property int $id
 * @property string $action
 * @property string $model
 * @property string $model_id
 * @property array|null $old_values
 * @property array|null $new_values
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuditLog whereUserId($value)
 * @method static \Database\Factories\AuditLogFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class AuditLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'action',
        'model',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the audit log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}