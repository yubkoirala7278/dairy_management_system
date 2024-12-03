<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['user_id','withdraw','order_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
