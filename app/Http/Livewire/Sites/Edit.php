<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use App\Models\Site;

class Edit extends Component
{
    public $data,$site_id,$name,$site_technology,$site_owner,$tlp_company,$site_category,$site_type,$regional,$region_id,$region_cluster_id,$employee_id;

    public function render()
    {
        return view('livewire.sites.edit');
    }

    public function mount(Site $id)
    {
        $this->data = $id;
        $this->site_id = $this->data->site_id;
        $this->name = $this->data->name;
        $this->site_technology = $this->data->site_technology;
        $this->site_owner = $this->data->site_owner;
        $this->tlp_company = $this->data->tlp_company;
        $this->site_category  = $this->data->site_category;
        $this->site_type = $this->data->site_type;
        $this->regional = $this->data->regional;
        $this->region_id = $this->data->region_id;
        $this->region_cluster_id = $this->data->cluster_id;
        $this->employee_id = $this->data->employee_id;
    }

    public function save()
    {
        $this->data->site_id = $this->site_id;
        $this->data->name = $this->name;
        $this->data->site_technology = $this->site_technology;
        $this->data->site_owner = $this->site_owner;
        $this->data->tlp_company = $this->tlp_company;
        $this->data->site_category  = $this->site_category;
        $this->data->site_type = $this->site_type;
        $this->data->regional = $this->regional;
        $this->data->region_id = $this->region_id;
        $this->data->cluster_id = $this->region_cluster_id;
        $this->data->employee_id = $this->employee_id;
        $this->data->save();

        session()->flash('message-success',__('Data sites saved successfully'));

        return redirect()->route('sites.index');
    }
}
