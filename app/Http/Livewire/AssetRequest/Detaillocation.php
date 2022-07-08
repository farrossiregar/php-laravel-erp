<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detaillocation extends Component
{
    protected $listeners = [
        'modaldetaillocation'=>'detaillocation',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;
    public $nama_dop, $alamat, $pemilik_dop, $telepon_pemilik;

    public function render()
    {
       
       
        return view('livewire.asset-request.detaillocation');
    }

    public function detaillocation($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\DophomebaseMaster::where('id', $this->selected_id)->first();
        $this->nama_dop = $data->nama_dop;
        $this->alamat = $data->alamat;
        $this->pemilik_dop = $data->pemilik_dop;
        $this->telepon_pemilik = $data->telepon_pemilik;
        
        
    }


}



