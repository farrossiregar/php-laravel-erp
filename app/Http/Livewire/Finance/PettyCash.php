<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayablePettycash;

class PettyCash extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public $is_apstaff=false;
    public function render()
    {
        $data = AccountPayablePettycash::where('company_id',session()->get('company_id'))->orderBy('updated_at','DESC');

        return view('livewire.finance.petty-cash')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->is_apstaff = check_access('is-apstaff');
    }
}