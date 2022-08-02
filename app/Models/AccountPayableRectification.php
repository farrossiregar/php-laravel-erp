<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class AccountPayableRectification extends Model
{
    use HasFactory;

    protected $table = 'account_payable_rectification';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function items()
    {
        return $this->hasMany(RectificationItem::class,'rectification_id','id');
    }

    public function master()
    {
        return $this->hasOne(AccountPayable::class,'id','id_master');
    }

}
