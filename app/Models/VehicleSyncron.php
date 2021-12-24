<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\ClientProject;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\EPL\VehicleVendor;

class VehicleSyncron extends Model
{
    use HasFactory;

    protected $table = 'vehicle_syncron';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function project()
    {
        return $this->hasOne(ClientProject::class,'id','project_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function driver_employee()
    {
        return $this->belongsTo(Employee::class,'driver_employee_id');
    }

    public function sub_region()
    {
        return $this->hasOne(SubRegion::class,'id','sub_cluster_id');
    }

    public function epl_vehicle()
    {
        return $this->hasOne(VehicleVendor::class,'id','epl_vehicle_id');
    }
}
