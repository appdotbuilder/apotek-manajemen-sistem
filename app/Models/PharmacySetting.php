<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PharmacySetting
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo_path
 * @property string $address
 * @property string|null $phone
 * @property string|null $email
 * @property int $low_stock_threshold
 * @property array|null $notification_recipients
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereLowStockThreshold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereLogoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereNotificationRecipients($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PharmacySetting whereUpdatedAt($value)
 * @method static \Database\Factories\PharmacySettingFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PharmacySetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'logo_path',
        'address',
        'phone',
        'email',
        'low_stock_threshold',
        'notification_recipients',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'notification_recipients' => 'array',
        'low_stock_threshold' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the singleton pharmacy settings instance.
     *
     * @return PharmacySetting
     */
    public static function getInstance(): PharmacySetting
    {
        return static::firstOrCreate([], [
            'name' => 'Apotek Sehat',
            'address' => 'Jl. Kesehatan No. 1, Jakarta',
            'phone' => '021-12345678',
            'email' => 'info@apoteksehat.com',
            'low_stock_threshold' => 20,
            'notification_recipients' => ['admin@apoteksehat.com'],
        ]);
    }
}