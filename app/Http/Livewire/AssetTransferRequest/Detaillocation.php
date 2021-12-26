<?php

namespace App\Http\Livewire\AssetTransferRequest;

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

  
    // public function save()
    // {

    //     // $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
    //     $data                           = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        
    //     $data->dana_from                = $this->dana_from;
    //     $data->pr_no                    = $this->pr_no;
    //     $data->dana_amount              = $this->dana_amount;
    //     $data->save();

      

    //     session()->flash('message-success',"Asset Request Berhasil diinput");
        
    //     return redirect()->route('asset-request.index');
    // }

    // public function weekOfMonth3($strDate) {
	// 	$dateArray = explode("-", $strDate);
	// 	$date = new DateTime();
	// 	$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
	// 	return floor((date_format($date, 'j') - 1) / 7) + 1;  
	//   }


}



