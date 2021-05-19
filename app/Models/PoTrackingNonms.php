<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoTrackingNonms extends Model
{
    use HasFactory;
    protected $table = 'po_tracking_nonms_master';

    public function field_team()
    {
        return $this->hasOne(Employee::class,'id','field_team_id');
    }
}
