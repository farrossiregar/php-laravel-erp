<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\TrainingMaterial as TrainingMaterialModel;
use App\Models\TrainingMaterialFile;
use Livewire\WithFileUploads;

class TrainingMaterial extends Component
{
    use WithFileUploads;

    public $name;
    public $file,$description;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = TrainingMaterialModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.training-material')->with(['data'=>$data->paginate(100)]);
    }

    public function mount(){}

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'file.*' => 'required|mimes:doc,docx,pdf,jpg,png,jpeg,xls,xlsx'
        ]);
            
        $data = new TrainingMaterialModel();
        $data->name = $this->name;
        $data->description = $this->description;
        $data->save();
        
        if(!empty($this->file)){
            foreach($this->file as $file){
                $new_file = new TrainingMaterialFile();
                $new_file->training_material_id = $data->id;
                $name = $file->getClientOriginalName() .".".$file->extension();
                $file->storeAs("public/training-material/{$data->id}", $name);
                $new_file->file = "public/training-material/{$data->id}/{$name}";
                $new_file->name = $file->getClientOriginalName();
                $new_file->file_ext = $file->extension();
                $new_file->save();
            }
        }

        $this->reset();
        $this->emit('message-success','Training Material & Exam Added');
        $this->emit('refresh-page');
    }
}
