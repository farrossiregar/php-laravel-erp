<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PettyCashItem;
use App\Models\AccountPayable;
use App\Models\Employee;

class AccountPayablePettycash extends Model
{
    use HasFactory;

    protected $table = 'account_payable_pettycash';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function items()
    {
        return $this->hasMany(PettyCashItem::class,'petty_cash_id','id');
    }

    public function master()
    {
        return $this->hasOne(AccountPayable::class,'id','id_master');
    }
}
