<?php

namespace App\Http\Livewire\Finance;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountPayableWeeklyopex;

class WeeklyOpex extends Component
{
    public function render()
    {
        $data = AccountPayableWeeklyopex::orderBy('updated_at','DESC');

        return view('livewire.finance.weekly-opex')->with(['data'=>$data->paginate(100)]);
    }
}
