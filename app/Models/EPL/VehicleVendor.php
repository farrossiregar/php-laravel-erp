<?php

namespace App\Models\EPL;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EPL\Vendor;
use App\Models\EPL\Vehicle;

class VehicleVendor extends Model
{
    use HasFactory;
    protected $connection = 'epl_pmt';
    protected $table = 'vehicle_vendor';

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
