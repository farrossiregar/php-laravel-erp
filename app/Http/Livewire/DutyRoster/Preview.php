<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use DB;


class Preview extends Component
{
    use WithPagination;
    public $data, $data_id;
    public $idpel_pln, $site_id, $sm, $tower_owner, $selected_id, $te, $cme;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $this->selected_id); 

        if($this->site_id) $ata = $data->where('site_id', 'like', '%' . $this->site_id . '%');
        if($this->tower_owner) $ata = $data->where('tower_owner', 'like', '%' . $this->tower_owner . '%');
        if($this->sm) $ata = $data->where('sm', 'like', '%' . $this->sm . '%');
        if($this->idpel_pln) $ata = $data->where('idpel_pln', 'like', '%' . $this->idpel_pln . '%');
        if($this->te) $ata = $data->where('te', 'like', '%' . $this->te . '%');
        if($this->cme) $ata = $data->where('cme', 'like', '%' . $this->cme . '%');

        $this->data = $data->get();
        
        return view('livewire.duty-roster.preview');

        
    }

    public function mount($id){
        
        // $this->data       = \App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $id);  
        $this->selected_id = $id;
        

        foreach(\App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $id)->where('remarks', '1')->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
        
    }

    public function checkdata($id)
    {
        $check = \App\Models\DutyrosterSitelistDetail::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }

}



