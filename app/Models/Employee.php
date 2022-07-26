<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\Employee as EmployeeModel;
use App\Models\EmployeeProject;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    public function employee_project()
    {
        return $this->hasMany(EmployeeProject::class,'employee_id','id');
    }

    public function employee_project_first()
    {
        return $this->hasOne(EmployeeProject::class,'employee_id','id');
    }

    public function region()
    {
        return $this->hasOne(Region::class,'id','region_id');
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class);
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class);
    }
    
    public function department_sub()
    {
        return $this->belongsTo(\App\Models\DepartmentSub::class);
    }
    
    public function access()
    {
        return $this->belongsTo(\App\Models\UserAccess::class,'user_access_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function pic_speed()
    {
        return $this->belongsTo(EmployeeModel::class,'speed_warning_pic_id');
    }
}
