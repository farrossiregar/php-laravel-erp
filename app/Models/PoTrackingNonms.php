<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoTrackingNonmsBuktiTransfer;

class PoTrackingNonms extends Model
{
    use HasFactory;
    protected $table = 'po_tracking_nonms_master';

    public function field_team()
    {
        return $this->hasOne(Employee::class,'id','field_team_id');
    }

    public function coordinator()
    {
        return $this->hasOne(Employee::class,'id','coordinator_id');
    }

    public function bukti_transfer()
    {
        return $this->hasMany(PoTrackingNonmsBuktiTransfer::class,'po_tracking_nonms_master_id','id');
    }
}
