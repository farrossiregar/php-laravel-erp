<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\ToolboxCheck;

class ToolsCheck extends Model
{
    use HasFactory;

    protected $table = 'tools_check';

    public function _employee()
    {
        return $this->hasOne(Employee::class, 'id','employee_id');
    }

    public function toolsboxCheck()
    {
        return $this->hasMany(ToolboxCheck::class,'tools_check_id','id')->orderBy('toolbox_id','ASC');
    }
}
