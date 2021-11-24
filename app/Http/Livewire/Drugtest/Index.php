<?php

namespace App\Http\Livewire\Drugtest;

use Livewire\Component;
use App\Models\DrugTest as DrugTestModel;
use App\Models\DrugTestUpload;
use Livewire\WithFileUploads;
use App\Models\EmployeeProject;
use App\Models\Region;
use App\Models\SubRegion;

class Index extends Component
{
    use WithFileUploads;

    public $employee_pic_id,$employee_id,$status_drug,$file,$title,$remark,$filter_employee_id,$region=[],$sub_region=[],$region_id,$sub_region_id;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        if(!check_access('drug-test.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        $data = DrugTestModel::orderBy('id','DESC');
        if($this->filter_employee_id) $data->where('employee_id',$this->filter_employee_id);
        if($this->region_id) {
            $data->where('drug_test.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('drug_test.sub_region_id',$this->sub_region_id);

        return view('livewire.drugtest.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        \LogActivity::add('[web] Drug Test');

        $this->region  = Region::select(['id','region'])->get();
    }

    public function positif()
    {
        $this->status_drug = 2;
        $this->save();
    }

    public function negatif()
    {
        $this->status_drug = 1;
        $this->save();
    }

    public function save()
    {
        $this->validate([
            // 'employee_pic_id' => 'required',
            'employee_id' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required'
        ]);

        $data = new DrugTestModel();
        $data->employee_pic_id = $this->employee_pic_id;
        $data->employee_id = $this->employee_id;
        $data->status_drug = $this->status_drug;
        $data->title = $this->title;
        $data->remark = $this->remark;
        $data->status = 1;
        $data->date_submited = date('Y-m-d');
        $data->sertifikat_number = "PMT/".date('dmy')."/".str_pad((DrugTestModel::count()+1),6, '0', STR_PAD_LEFT);
        $data->save();

        $data->region_id = $data->employee->region_id;
        $data->sub_region_id = $data->employee->sub_region_id;
        $project = EmployeeProject::where('employee_id',$data->employee_id)->first();
        if($project) $data->client_project_id = $project->client_project_id; 
        $data->save();

        if($this->file){
            $upload = new DrugTestUpload();
            $upload->drug_test_id = $data->id;
            $upload->save();
            $name = $upload->id .".".$this->file->extension();
            $this->file->storeAs("public/drug-test/{$data->id}", $name);
            $upload->image = "storage/drug-test/{$data->id}/{$name}";
            $upload->save();
        }
        
        $description = "Hasil : ". ($this->status_drug==1 ? 'Positif' : 'Negatif') ."\n";

        if(isset($data->employee->device_token))
            push_notification_android($data->employee->device_token,"Drug Test #".$this->title,$description,12);

        \LogActivity::add('[web] Drug Test Add');

        $this->emit('message-success','Drug Test employee Added');
        $this->emit('refresh-page');
    }
}
