<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'user_id', 'expense_category_id', 'expense_name', 'expense_amount', 'expense_details', 'expense_date',
    ];
}
