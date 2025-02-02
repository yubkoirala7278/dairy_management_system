<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','sub_total','total_charge','payment_status','status','shipped_date','shipping_charge'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
