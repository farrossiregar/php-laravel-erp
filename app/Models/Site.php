<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class,'region_id');
    }

    public function cluster()
    {
        return $this->belongsTo(\App\Models\Cluster::class,'cluster_id');
    }
}
