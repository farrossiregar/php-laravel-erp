<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Region;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function region()
    {
        return $this->hasOne(Region::class,'id','region_id');
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
}
