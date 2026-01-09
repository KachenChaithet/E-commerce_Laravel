<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'receiver_address',
        'receiver_phone',
        'user_id',
        'product_id',
        'status'
    ];
    public const STATUSES = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
