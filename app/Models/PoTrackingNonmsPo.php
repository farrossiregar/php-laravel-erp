<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PoTrackingNonmsBoq;
use App\Models\Employee;

class PoTrackingNonmsPo extends Model
{
    use HasFactory;

    protected $table = 'po_tracking_nonms_po';

    public function wos()
    {
        return $this->hasMany(PoTrackingNonmsBoq::class,'po_tracking_nonms_po_id','id');
    }

    public function regional_employee()
    {
        return $this->hasOne(Employee::class,'id','regional_employee_id');
    }
}
