<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lender extends Model
{
    protected $fillable = [
        'user_id', 'lender_name', 'lender_phone', 'lender_email', 'lender_remarks', 'status',
    ];
}
