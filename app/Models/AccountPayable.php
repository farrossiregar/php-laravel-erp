<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PettyCashType;
use App\Models\AccountPayablePettycash;
use App\Models\WeeklyOpexType;
use App\Models\AccountPayableWeeklyopex;
use App\Models\AccountPayableOtheropex;
use App\Models\AccountPayableRectification;

class AccountPayable extends Model
{
    use HasFactory;

    protected $table = 'account_payable';

    public function petty_cash_type()
    {
        return $this->hasOne(PettyCashType::class,'id','subrequest_type');
    }

    public function petty_cash()
    {
        return $this->hasOne(AccountPayablePettycash::class,'id_master','id');
    }

    public function weekly_opex_type()
    {
        return $this->hasOne(WeeklyOpexType::class,'id','subrequest_type');
    }

    public function weekly_opex()
    {
        return $this->hasOne(AccountPayableWeeklyopex::class,'id_master','id');
    }

    public function other_opex()
    {
        return $this->hasOne(AccountPayableOtheropex::class,'id_master','id');
    }

    public function rec()
    {
        return $this->hasOne(AccountPayableRectification::class,'id_master','id');
    }
}
