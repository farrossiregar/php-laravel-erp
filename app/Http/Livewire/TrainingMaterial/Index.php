<?php

namespace App\Http\Livewire\TrainingMaterial;

use Livewire\Component;
use App\Models\TrainingMaterial as TrainingMaterialModel;
use App\Models\TrainingMaterialFile;
use Livewire\WithFileUploads;
use App\Models\TrainingMaterialGroup;
use App\Models\TrainingMaterialGroupEmployee;

class Index extends Component
{
    use WithFileUploads;

    public $name;
    public $file,$description,$training_material_group_id,$group_training,$list_employee_group;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = TrainingMaterialModel::orderBy('id','DESC');

        return view('livewire.training-material.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->group_training =  TrainingMaterialGroup::orderBy('id')->get();
    }

    public function updated($propertyName)
    {
        if($propertyName == 'training_material_group_id'){
            $this->list_employee_group  = TrainingMaterialGroupEmployee::where('training_material_group_id',$this->$propertyName)->get();
        }
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            //'description' => 'required',
            'file.*' => 'required|mimes:doc,docx,pdf,jpg,png,jpeg,xls,xlsx',
            'training_material_group_id' => 'required'
        ]);
            
        $data = new TrainingMaterialModel();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->training_material_group_id = $this->training_material_group_id;
        $data->save();

        if(!empty($this->file)){
            foreach($this->file as $file){
                $new_file = new TrainingMaterialFile();
                $new_file->training_material_id = $data->id;
                $name = $file->getClientOriginalName();
                $file->storeAs("public/training-material/{$data->id}", $name);
                $new_file->file = "storage/training-material/{$data->id}/{$name}";
                $new_file->name = $file->getClientOriginalName();
                $new_file->file_ext = $file->extension();
                $new_file->save();
            }
        }

        $this->reset(['name','description','training_material_group_id']);
        $this->emit('message-success','Training Material & Exam Added');
        $this->emit('refresh-page');
    }
}
