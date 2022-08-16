<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SubRegion;

class HqadministrationBudget extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'hqadministration_budget';

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class,'id','region');
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class,'subregion','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function sub_department()
    {
        return $this->belongsTo(DepartmentSub::class,'sub_department_id','id');
    }
}
