<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id', 'lender_id', 'amount', 'transaction_date', 'return_date', 'remarks', 'loan_type', 'paid_status', 
    ];
}
