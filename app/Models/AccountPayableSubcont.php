<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class AccountPayableSubcont extends Model
{
    use HasFactory;

    protected $table = 'account_payable_subcont';

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public function items()
    {
        return $this->hasMany(SubcontItem::class,'subcont_id','id');
    }

    public function master()
    {
        return $this->hasOne(AccountPayable::class,'id','id_master');
    }
}
