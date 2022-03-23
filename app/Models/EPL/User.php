<?php

namespace App\Models\EPL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory; 

    protected $connection = 'epl_pmt';

    protected $table = 'user';
}
