<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MilkDeposit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id', 'milk_quantity', 'milk_fat', 'milk_snf', 'milk_price_per_ltr', 'per_ltr_commission', 'milk_per_ltr_price_with_commission', 'milk_total_price', 'milk_deposit_date', 'milk_deposit_time', 'milk_type'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
