<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayablePettycash;

class WeeklyOpex extends Component
{
    public function render()
    {
        $data = AccountPayablePettycash::orderBy('updated_at','DESC');

        return view('livewire.finance.weekly-opex')->with(['data'=>$data->paginate(100)]);
    }
}
