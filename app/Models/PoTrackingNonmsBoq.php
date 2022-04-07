<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class PoTrackingNonmsBoq extends Model
{
    use HasFactory;
    
    protected $table = 'po_tracking_nonms_boq';

    public function wo()
    {
        return $this->hasOne(PoTrackingNonms::class,'id','id_po_nonms_master');
    }
}
