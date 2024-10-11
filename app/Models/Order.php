<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function order_status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function guest_user(): BelongsTo
    {
        return $this->belongsTo(GuestUser::class);
    }
    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
