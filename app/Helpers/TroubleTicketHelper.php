<?php
namespace App\Helpers;

use App\Models\TroubleTicket;

class TroubleTicketHelper
{
    public static function generate_number()
    {
        return  "TT/".date('dmy').'/'.str_pad((TroubleTicket::count()+1),6, '0', STR_PAD_LEFT);
    }
}