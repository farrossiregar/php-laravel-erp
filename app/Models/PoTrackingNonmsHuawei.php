<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoTrackingNonmsHuaweiItem;
use App\Models\Employee;

class PoTrackingNonmsHuawei extends Model
{
    use HasFactory;

    protected $table = 'po_tracking_nonms_huawei';

    public function items()
    {
        return $this->hasMany(PoTrackingNonmsHuaweiItem::class,'po_tracking_nonms_huawei_id','id');
    }

    public function client_project()
    {
        return $this->hasOne(ClientProject::class,'id','client_project_id');
    }

    public function field_team()
    {
        return $this->hasOne(Employee::class,'id','field_team_id');
    }

    public function coordinator()
    {
        return $this->hasOne(Employee::class,'id','coordinator_id');
    }
}
