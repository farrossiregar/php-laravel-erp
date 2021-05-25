<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\TrainingMaterial as TrainingMaterialModel;

class TrainingMaterial extends Component
{
    public $name,$start_date,$end_date,$day,$place;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = TrainingMaterialModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.training-material')->with(['data'=>$data->paginate(100)]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'day' => 'required',
            'place' => 'required'
        ]);
            
        $data = new TrainingMaterialModel();
        $data->name = $this->name;
        $data->from_date = $this->start_date;
        $data->end_date = $this->end_date;
        $data->days = $this->day;
        $data->place = $this->place;
        $data->save();

        $this->reset();
        $this->emit('message-success','Training Material & Exam Added');
        $this->emit('refresh-page');
    }
}
