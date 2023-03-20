<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_session_id',
        'student_id',
        'status',
    ];
    
}
