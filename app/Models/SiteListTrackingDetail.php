<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Region;

class SiteListTrackingDetail extends Model
{
    use HasFactory;
    protected $table = 'site_list_tracking_detail';
    public function picRpm()
    {
        return $this->hasOne(Employee::class,'nik','pic_rpm');
    }
    public function picSm()
    {
        return $this->hasOne(Employee::class,'nik','pic_sm');
    }
    public function region_()
    {
        return $this->belongsTo(Region::class,'region_id');
    }
}
