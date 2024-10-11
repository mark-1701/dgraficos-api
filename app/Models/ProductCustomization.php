<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCustomization extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
