<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailimage extends Component
{
    protected $listeners = [
        'modaldetailimage'=>'detailimage',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;
    public $reference_pic, $link;

    public function render()
    {
       
       
        return view('livewire.asset-request.detailimage');
    }

    public function detailimage($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        $this->reference_pic = $data->reference_pic;
        $this->link = $data->link;
        
        
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



