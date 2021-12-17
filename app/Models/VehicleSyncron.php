<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\EPL\VehicleVendor;

class VehicleSyncron extends Model
{
    use HasFactory;

    protected $table = 'vehicle_syncron';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function epl_vehicle()
    {
        return $this->hasOne(VehicleVendor::class,'id','epl_vehicle_id');
    }
}
