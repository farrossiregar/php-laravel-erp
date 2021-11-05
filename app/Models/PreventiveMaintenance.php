<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Site;
use App\Models\Employee;
use App\Models\Region;
use App\Models\SubRegion;

class PreventiveMaintenance extends Model
{
    use HasFactory;

    protected $table = 'preventive_maintenance';

    public function site()
    {
        return $this->hasOne(Site::class,'id','site_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function admin()
    {
        return $this->hasOne(Employee::class,'id','admin_project_id');
    }

    public function region()
    {
        return $this->hasOne(Region::class,'id','region_id');
    }

    public function sub_region()
    {
        return $this->hasOne(SubRegion::class,'id','sub_region_id');
    }
}
