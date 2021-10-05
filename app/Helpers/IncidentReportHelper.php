<?php
namespace App\Helpers;

use App\Models\IncidentReport;

class IncidentReportHelper
{
    public static function generate_number()
    {
        return  "TT/".date('dmy').'/'.str_pad((IncidentReport::count()+1),6, '0', STR_PAD_LEFT);
    }
}