<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class ConsumableItemDatabase extends Model
{
    use HasFactory;

    protected $table = 'consumable_item_database';

}
