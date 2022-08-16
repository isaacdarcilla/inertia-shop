<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static count()
 * @method static sum(string $string)
 * @method static checkoutAt()
 */
class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeCheckoutAt($query)
    {
        $query->whereNull('checkout_at');
    }
}
