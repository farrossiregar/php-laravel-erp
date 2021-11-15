<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Region;
use App\Models\SubRegion;

class CommitmentLetter extends Model
{
    use HasFactory;

    protected $table = 'commitment_letter';

   
}
