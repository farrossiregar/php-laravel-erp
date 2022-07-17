<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class AccountPayableOtheropex extends Model
{
    use HasFactory;

    protected $table = 'account_payable_otheropex';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function items()
    {
        return $this->hasMany(OtherOpexItem::class,'other_opex_id','id');
    }

    public function master()
    {
        return $this->hasOne(AccountPayable::class,'id','id_master');
    }
}
