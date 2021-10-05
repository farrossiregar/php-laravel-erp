<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class IncidentReport extends Model
{
    use HasFactory;

    protected $table = 'incident_report';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function pic()
    {
        return $this->belongsTo(Employee::class,'employee_pic_id');
    }
}
