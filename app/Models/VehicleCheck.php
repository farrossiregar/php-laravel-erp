<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\VehicleCheckCleanliness;

class VehicleCheck extends Model
{
    use HasFactory;

    protected $table = 'vehicle_check';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function cleanliness()
    {
        return $this->hasMany(VehicleCheckCleanliness::class,'vehicle_check_id','id');
    }
}
