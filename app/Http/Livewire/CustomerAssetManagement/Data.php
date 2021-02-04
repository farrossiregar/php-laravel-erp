<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perpage=100;
    protected $listeners = ['refresh-page'=>'$refresh'];
    public function render()
    {
        $data = \App\Models\CustomerAssetManagement::orderBy('id','desc');
        
        return view('livewire.customer-asset-management.data')->with(['data'=>$data->paginate($this->perpage)]);
    }
}
