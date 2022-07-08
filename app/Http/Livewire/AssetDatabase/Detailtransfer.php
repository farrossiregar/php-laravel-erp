<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;
use App\Models\Employee;

class Detailtransfer extends Component
{
    protected $listeners = [
        'modaldetailtransfer'=>'modaldetailtransfer',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $selected_id, $project, $region, $nik, $pic;
    public function render()
    {
        return view('livewire.asset-database.detailtransfer');
    }
    public function modaldetailtransfer($id)
    {
        $this->selected_id = $id;
        
        $data                   = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();

        $this->pic              = $data->pic;
        $this->nik              = $data->nik;
        $this->project          = $data->project;
        $this->region           = $data->region;
    }

    public function save()
    {
        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();        
        $data->pic                      = $this->pic;
        $data->nik                      = Employee::find($this->pic)->first()->nik;
        $data->region                   = $this->region;
        $data->project                  = $this->project;
        $data->transfer_id              = 'TR'.date('ymdhis');
        $data->save();

        session()->flash('message-success',"Asset Transfer Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }
}