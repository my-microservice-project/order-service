<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method create(array $array)
 */
class AppliedDiscounts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_id',
        'campaign_name',
        'campaign_type',
        'discount_amount',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
