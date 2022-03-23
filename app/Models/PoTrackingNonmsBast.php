<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoTrackingNonmsBast extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'po_tracking_nonms_bast';
    protected $dates = ['deleted_at'];
}
