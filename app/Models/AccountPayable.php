<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PettyCashType;
use App\Models\AccountPayablePettycash;

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
}
