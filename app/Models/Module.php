<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientProject;

class Module extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->hasMany('\App\Models\ModulesItem','module_id','id')->where('type',1);
    }

    public function client_project()
    {
        return $this->hasOne(ClientProject::class,'id','client_project_id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\DepartmentSub::class,'department_id');
    }
}
