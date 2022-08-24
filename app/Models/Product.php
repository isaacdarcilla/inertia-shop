<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static orderByName()
 * @method static count()
 * @method static where(string $string, $slug)
 * @method static create(array $array)
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Order scoping
     *
     * @param $query
     * @return void
     */
    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }
}
