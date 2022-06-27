<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\AssetsType;

class AssetType extends Component
{
    protected $listeners = ['reload'=>'$refresh'];
    public $insert=false,$asset_type;
    public function render()
    {
        $data = AssetsType::orderBy('id','DESC');

        return view('livewire.asset-request.asset-type')->with(['data'=>$data->get()]);
    }

    public function save()
    {
        $this->validate([
            'asset_type' => ['required',
                Rule::unique('asset_type')->where(function ($query) {
                    return $query->where('asset_type', $this->asset_type);
                })
            ],
        ],
        [
            'asset_type.unique' => 'Data already exists'
        ]);

        $data = new AssetsType();
        $data->asset_type = $this->asset_type;
        $data->save();

        $this->insert = false;
        $this->reset(['asset_type']);
        $this->emit('reload');
    }
}