<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $fillable = [
        'category_name', 'category_remarks', 'user_id',
    ];
}
