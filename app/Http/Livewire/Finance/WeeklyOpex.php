<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayableWeeklyopex;

class WeeklyOpex extends Component
{
    use WithPagination;
    public $filterproject, $filterweek, $filtermonth, $filteryear, $subrequest_type;
    protected $paginationTheme = 'bootstrap',$listeners=['refresh'=>'$refresh'];
    public $keyword;
    public $is_apstaff=false,$is_finance=false;

    public function render()
    {
        // $data = AccountPayableWeeklyopex::orderBy('updated_at','DESC');

        $data = AccountPayableWeeklyopex::select('account_payable_weeklyopex.*', 'account_payable.subrequest_type')
                                        ->join('account_payable','account_payable.id','=','account_payable_weeklyopex.id_master')
                                        ->where('account_payable.request_type','2')
                                        ->where('account_payable_weeklyopex.company_id',session()->get('company_id'))
                                        ->orderBy('account_payable_weeklyopex.updated_at','DESC');

        if($this->filteryear) $data->whereYear('account_payable.created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('account_payable.created_at',$this->filtermonth);                
        if($this->subrequest_type) $data->where('account_payable.subrequest_type',$this->subrequest_type);

        return view('livewire.finance.weekly-opex')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_apstaff = check_access('is-apstaff');
        $this->is_finance = check_access('is-finance');
    }
}
