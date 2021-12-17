<?php

namespace App\Models\EPL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory; 

    protected $connection = 'epl_pmt';

    protected $table = 'vehicle';
}
