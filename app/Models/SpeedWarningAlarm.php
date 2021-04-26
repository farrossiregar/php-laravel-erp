<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeedWarningAlarm extends Model
{
    use HasFactory;

    public function _employee()
    {
        return $this->belongsTo(\App\Models\Employee::class,'employee_id');
    }
}
