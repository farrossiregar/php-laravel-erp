<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class SiteListTrackingMaster extends Model
{
    use HasFactory;
    protected $table = 'site_list_tracking_master';

    public function approved()
    {
        return $this->hasOne(Employee::class,'id','approved_id');
    }
}
