<?php
namespace App\Helpers;

use App\Models\TroubleTicket;

class TroubleTicketHelper
{
    public static function generate_number()
    {
        $count = get_setting('trouble_ticket_count') ? get_setting('trouble_ticket_count') : 0;

        update_setting('trouble_ticket_count',$count+1);

        return  "TT/".date('dmy').'/'.str_pad(($count+1),6, '0', STR_PAD_LEFT);
    }
}