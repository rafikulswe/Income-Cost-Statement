<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'user_id', 'income_category_id', 'income_name', 'income_amount', 'income_details', 'income_date',
    ];
}