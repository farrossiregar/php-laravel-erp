<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class ConsumableItemRequest extends Model
{
    use HasFactory;

    protected $table = 'consumable_item_request';

}
