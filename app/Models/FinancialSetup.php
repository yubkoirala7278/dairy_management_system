<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSetup extends Model
{
    use HasFactory;
    protected $fillable=['fixed_interest_rate','compound_interest_rate','tax_deduction_rate'];
}
