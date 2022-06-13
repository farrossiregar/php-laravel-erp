<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubRegion extends Model
{
    // use SoftDeletes;

    use HasFactory;

    protected $table = 'sub_region';
    
    // protected $dates = ['deleted_at'];
}
