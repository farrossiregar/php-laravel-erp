<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Site;
use App\Models\Employee;

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
}
