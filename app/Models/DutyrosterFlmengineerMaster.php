<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientProject;
use App\Models\Employee;

class DutyrosterFlmengineerMaster extends Model
{
    use HasFactory;
    protected $table = 'dutyroster_flmengineer_master';

    public function project()
    {
        return $this->belongsTo(ClientProject::class,'client_project_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function user()
    {
        return $this->belongsTo(Employee::class,'user_id');
    }
}