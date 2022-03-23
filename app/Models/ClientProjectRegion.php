<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\SubRegion;

class ClientProjectRegion extends Model
{
    use HasFactory;

    protected $table = 'client_project_region';

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function sub_region()
    {
        return $this->belongsTo(SubRegion::class,'region_cluster_id');
    }
}
