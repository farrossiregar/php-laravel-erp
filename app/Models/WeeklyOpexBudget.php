<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\ClientProject;
use App\Models\Employee;

class WeeklyOpexBudget extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'weekly_opex_budget';

    public function client_project()
    {
        return $this->hasOne(ClientProject::class,'id','client_project_id');
    } 

    public function pic()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    } 

    public function regions()
    {
        return $this->hasOne(Region::class,'id','region');
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class,'subregion','id');
    }
}
