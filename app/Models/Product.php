<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static orderByName()
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function scopeOrderByName($query)
    {
        $query->orderBy('name');
    }
}
