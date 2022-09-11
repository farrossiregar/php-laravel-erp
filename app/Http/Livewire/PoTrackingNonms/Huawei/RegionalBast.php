<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuawei;

class RegionalBast extends Component
{
    public $data,$bast_number,$bast_date,$works,$client_project_id,$save_as_draft=false;
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.regional-bast');
    }

    public function mount(PoTrackingNonmsHuawei $id)
    {
        $this->data = $id;
    }

    public function save()
    {
        $this->save_as_draft=true;
        $this->submit();
    }

    public function submit()
    {
        $this->validate([
            'bast_number'=>'required',
            'bast_date'=>'required',
            'works'=>'required',
            'client_project_id'=>'required'
        ]);

        $this->data->bast_number = $this->bast_number;
        $this->data->bast_date = $this->bast_date;
        $this->data->works = $this->works;
        $this->data->client_project_id = $this->client_project_id;
        if($this->save_as_draft==false) $this->data->status = 10;
        $this->data->save();

        session()->flash('message-success',"Success!, BAST submitted");

        return redirect()->route('po-tracking-nonms.huawei');
    }
}
