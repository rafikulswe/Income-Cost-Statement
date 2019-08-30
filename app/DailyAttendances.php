<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DailyAttendances extends Model
{
    protected $fillable = [
        'employee_id', 'attend_date', 'start_time', 'end_time', 'late_duration', 'user_type', 'approval_status', 'approve_remarks', 'approved_by',
    ];
    
}
