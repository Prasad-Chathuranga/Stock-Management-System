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
        // return $this->hasOneThrough(Order::class, Customer::class, 'id','id','id', 'id'); 
        return $this->hasOneThrough(
            Customer::class,
            Order::class,
          
            
            'id', // Foreign key on the owners table...
            'id', // Foreign key on the cars table...
            'order_id', // Local key on the mechanics table...
            'customer_id' // Local key on the cars table...
        );
    }
}
