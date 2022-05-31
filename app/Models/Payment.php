<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function order(){
        return $this->hasOne(Order::class, 'id', 'order_id');  
    }

    public function customer(){
        return $this->hasManyThrough(Customer::class, Order::class, 'customer_id','id','order_id', 'id'); 
    }
}
