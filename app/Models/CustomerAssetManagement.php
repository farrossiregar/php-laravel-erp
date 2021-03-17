<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAssetManagement extends Model
{
    use HasFactory;
    
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class);
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

    public function cluster()
    {
        return $this->belongsTo(\App\Models\Cluster::class,'region_cluster_id');
    }

    public function relokasi_site()
    {
        return $this->belongsTo(\App\Models\Site::class,'direlokasi_ke_site_id');
    }
}
