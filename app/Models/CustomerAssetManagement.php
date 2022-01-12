<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\SubRegion;
use App\Models\Cluster;

class CustomerAssetManagement extends Model
{
    use HasFactory;
    
    public function coordinator()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function tower()
    {
        return $this->belongsTo(\App\Models\Tower::class);
    }

    public function site()
    {
        return $this->belongsTo(\App\Models\Site::class);
    }

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class,'region_cluster_id');
    }

    public function relokasi_site()
    {
        return $this->belongsTo(\App\Models\Site::class,'direlokasi_ke_site_id');
    }
}
