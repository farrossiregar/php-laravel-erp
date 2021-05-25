<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\DrugTest as DrugTestModel;
use App\Models\DrugTestUpload;

class DrugTest extends Component
{
    public $employee_pic_id,$employee_id,$status_drug,$file;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = DrugTestModel::orderBy('id','DESC');

        return view('livewire.mobile-apps.drug-test')->with(['data'=>$data->paginate(100)]);
    }

    public function positif()
    {
        $this->status_drug = 1;
        $this->save();
    }

    public function negatif()
    {
        $this->status_drug = 2;
        $this->save();
    }

    public function save()
    {
        $this->validate([
            'employee_pic_id' => 'required',
            'employee_id' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $data = new DrugTestModel();
        $data->employee_pic_id = $this->employee_pic_id;
        $data->employee_id = $this->employee_id;
        $data->status_drug = $this->status_drug;
        $data->status = 1;
        $data->date_submited = date('Y-m-d');
        $data->save();

        $upload = new DrugTestUpload();
        $upload->drug_test_id = $data->id;
        $upload->save();

        if($this->file){
            $name = $upload->id .".".$this->file->extension();
            $this->file->storeAs("public/drug-test/{$data->id}", $name);
            $upload->image = "storage/drug-test/{$data->id}/{$name}";
            $upload->save();
        }
        
        $this->emit('message-success','Drug Test employee Added');
        $this->emit('refresh-page');
    }

    
}
