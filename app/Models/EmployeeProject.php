<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientProject;

class EmployeeProject extends Model
{
    use HasFactory;

    protected $table = 'employee_projects';

    public function project()
    {
        return $this->hasOne(ClientProject::class,'id','client_project_id');
    }
}
