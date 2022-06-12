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
        $data = AccountPayableWeeklyopex::orderBy('updated_at','DESC');

        return view('livewire.finance.weekly-opex')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_apstaff = check_access('is-apstaff');
        $this->is_finance = check_access('is-finance');
    }
}
