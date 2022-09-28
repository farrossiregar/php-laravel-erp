<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoMsHuawei extends Model
{
    use HasFactory;
    protected $table = 'po_ms_huawei';

    public function details()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no');
    }

    public function count_regional_recon()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('is_regional_reconciliation','<>','');
    }

    public function count_bos_approved()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('bos_approved','<>','');
    }

    public function count_customer_gm()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('is_customer_gm','<>','');
    }

    public function count_customer_gh()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('is_customer_gh','<>','');
    }

    public function count_customer_od()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('is_customer_od','<>','');
    }

    public function count_verification()
    {
        return $this->hasMany(PoMsHuawei::class,'po_no','po_no')->where('is_verification','<>','');
    }
    
}
