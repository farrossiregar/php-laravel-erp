<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class LocationOfFieldTeam extends Model
{
    use HasFactory;

    public function _employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
