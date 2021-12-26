<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Edit extends Component
{
    protected $listeners = [
        'modaleditassetrequest'=>'editassetrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;

    public function render()
    {
        // dd($this->dana_from);
        if($this->dana_from == '1'){
            $this->prno = '1';
        }
       
        return view('livewire.asset-request.edit');
    }

    public function editassetrequest($id)
    {
        $this->selected_id = $id;

        
    }

  
    public function save()
    {

        // $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        
        $data->dana_from                = $this->dana_from;
        $data->pr_no                    = $this->pr_no;
        $data->dana_amount              = $this->dana_amount;
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Asset Request Berhasil diinput");
        
        return redirect()->route('asset-request.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



