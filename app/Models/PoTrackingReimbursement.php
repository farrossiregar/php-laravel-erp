<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoTrackingReimbursement extends Model
{
    use HasFactory;
    protected $table = 'po_tracking_reimbursement';

    public function region()
    {
        return $this->hasOne(\App\Models\Region::class,'region_code','bidding_area');
    }
}
