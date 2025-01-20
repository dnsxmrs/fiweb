<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //

    use HasFactory;

    protected $fillable = [
        'order_number',
        'order_type',
        'total',
        'tax',
        'subtotal',
        'delivery_fee',
        'status',
        'first_name',
        'last_name',
        'contact_number',
        'email',
        'region',
        'province',
        'municipality',
        'barangay',
        'street',
        'unit',
        'address_type',
        'delivery_time',
    ];

    // Relationship with OrderProduct
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }

    // Relationship with Payment
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
