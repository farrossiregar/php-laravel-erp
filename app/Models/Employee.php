<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

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
}
