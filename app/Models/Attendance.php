<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'request_content',
        'absent_flg',
        'absent_reason',
        'date'
    ];
    
}

