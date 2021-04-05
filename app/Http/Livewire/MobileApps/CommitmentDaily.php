<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\CommitmentDaily as ModelsCommitmentDaily;

class CommitmentDaily extends Component
{
    public function render()
    {
        $data = ModelsCommitmentDaily::orderBy('id','DESC');

        return view('livewire.mobile-apps.commitment-daily')->with(['data'=>$data->paginate(100)]);
    }
}
