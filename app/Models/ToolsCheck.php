<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\ToolboxCheck;
use App\Models\Region;
use App\Models\SubRegion;

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

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class);
    }
}
