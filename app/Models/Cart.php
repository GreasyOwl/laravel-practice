<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function checkout()
    {
        $order = $this->order()->create([
            'user_id' => $this->user_id,
        ]);

        foreach ($this->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'order_id' => $order->id,
            ]);
        }

        $this->update([
            'checkouted' => true,
        ]);

        $order->orderItems;

        return $order;
    }
}
