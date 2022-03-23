<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\ClientProject;

class DophomebaseMaster extends Model
{
    use HasFactory;
    protected $table = 'dop_homebase_master';

    public function project()
    {
        return $this->belongsTo(ClientProject::class,'client_project_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
