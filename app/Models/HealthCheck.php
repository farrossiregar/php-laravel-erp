<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class HealthCheck extends Model
{
    use HasFactory;

    protected $table = 'health_check';

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
