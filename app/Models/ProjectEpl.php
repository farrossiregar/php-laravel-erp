<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectEpl extends Model
{
    use HasFactory;
    protected $connection = 'epl_pmt';
    protected $table = 'projects';
}