<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithPagination;

class Huawei extends Component
{
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = \App\Models\PoMsHuawei::orderBy('created_at', 'desc');
                                    

        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        
        return view('livewire.po-tracking-ms.huawei')->with(['data'=>$data->paginate(50)]);
    }
}
