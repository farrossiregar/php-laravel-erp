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
    public function render()
    {
        $data = AccountPayablePettycash::orderBy('updated_at','DESC');

        return view('livewire.finance.petty-cash')->with(['data'=>$data->paginate(100)]);
    }
}
