<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayablePettycash;

class PettyCash extends Component
{
    use WithPagination;
    public $filterproject, $filterweek, $filtermonth, $filteryear, $subrequest_type;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public $is_apstaff=false;
    public function render()
    {
        // $data = AccountPayablePettycash::orderBy('updated_at','DESC');
        $data = AccountPayablePettycash::select('account_payable_pettycash.*', 'account_payable.subrequest_type')->join('account_payable','account_payable.id','=','account_payable_pettycash.id_master')->where('account_payable.request_type','1')->orderBy('account_payable_pettycash.updated_at','DESC');
        $this->is_apstaff = check_access('is-apstaff');

        if($this->filteryear) $data->whereYear('account_payable.created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('account_payable.created_at',$this->filtermonth);                
        if($this->subrequest_type) $data->where('account_payable.subrequest_type',$this->subrequest_type);

        return view('livewire.finance.petty-cash')->with(['data'=>$data->paginate(100)]);
    }
}
