<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TroubleTicketCategory;

class TroubleTicket extends Model
{
    use HasFactory;

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function category()
    {
        return $this->belongsTo(TroubleTicketCategory::class, 'trouble_ticket_category_id');
    }
}
