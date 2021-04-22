<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoTrackingReimbursementBastupload;
use App\Models\PoTrackingReimbursementEsarupload;
use App\Models\PoTrackingReimbursementAccdocupload;

class PoTrackingReimbursement extends Model
{
    use HasFactory;
    protected $table = 'po_tracking_reimbursement';

    public function region()
    {
        return $this->hasOne(\App\Models\Region::class,'region_code','bidding_area');
    }

    public function bast()
    {
        return $this->hasOne(PoTrackingReimbursementBastupload::class,'po_tracking_reimbursement_id','id');
    }

    public function esar()
    {
        return $this->hasOne(PoTrackingReimbursementEsarupload::class,'po_tracking_reimbursement_id','id');
    }

    public function acceptance()
    {
        return $this->hasOne(PoTrackingReimbursementAccdocupload::class,'po_tracking_reimbursement_id','id');
    }
}
