<?php

namespace App\Http\Livewire\Cluster;

use Livewire\Component;
use App\Models\Cluster;


class Edit extends Component
{
    public $data;
    public $region_id;
    public $name;
    public $message;

    protected $rules = [
        'region_id' => 'required',
        'name' => 'required|string',
    ];

    public function render()
    {
        if(check_access_controller('cluster.edit') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }
        return view('livewire.cluster.edit')->with(['data'=>$this->data]);
    }

    public function mount($id)
    {
        $this->data         = Cluster::find($id);
        
        $this->name         = $this->data->name;
        $this->region_id    = $this->data->region_id;
    }

    public function save(){
        $this->validate();
        
        $this->data->name = $this->name;
        $this->data->region_id = $this->region_id;
        $this->data->save();

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->to('cluster');
    }
}
