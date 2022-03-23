<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEpl extends Model
{
    use HasFactory;
    protected $connection = 'epl_pmt';
    protected $table = 'user';

    // public function region()
    // {
    //     return $this->belongsTo(\App\Models\Region::class);
    // }
}
