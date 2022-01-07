<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SubRegion;

class PreventiveMaintenanceSowMaster extends Model
{
    use HasFactory;

    protected $table = 'preventive_maintenance_sow_master';

    public function region()
    {
        return $this->hasOne(Region::class,'id','region_id');
    }

    public function sub_region()
    {
        return $this->hasOne(SubRegion::class,'id','sub_region_id');
    }
}
