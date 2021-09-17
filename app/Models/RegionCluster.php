<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionCluster extends Model
{
    use HasFactory;

    protected $table = 'region_cluster';
    protected $connection = 'epl_pmt';
}