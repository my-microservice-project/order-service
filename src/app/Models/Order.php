<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method create(array $array)
 * @property mixed $total
 */
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'total',
        'discounted_total'
    ];

    protected $casts = [
        'total' => 'decimal:2',
        'discounted_total' => 'decimal:2'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function appliedDiscounts(): HasMany
    {
        return $this->hasMany(AppliedDiscounts::class);
    }
}
