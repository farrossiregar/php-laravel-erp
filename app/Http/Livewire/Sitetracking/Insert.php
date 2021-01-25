<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\Cluster;

class Insert extends Component
{
    public $region_id;
    public $name;
    public $message;

    protected $rules = [
        'region_id' => 'required|string',
        'name' => 'required|string',
    ];

    public function render()
    {
        $data = \App\Models\Region::orderBy('id','ASC');
        return view('livewire.cluster.insert')->with(['data'=>$data->paginate(100)]);
    }

    public function save(){
        $this->validate();
        
        $data = new Cluster();
        $data->region_id = $this->region_id;
        $data->name = $this->name;
        $data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('cluster');
    }
}
