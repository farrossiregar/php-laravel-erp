<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;

class SiteListTrackingDetail extends Model
{
    use HasFactory;
    protected $table = 'site_list_tracking_detail';

    public function region_()
    {
        return $this->belongsTo(Region::class,'region_id');
    }
}