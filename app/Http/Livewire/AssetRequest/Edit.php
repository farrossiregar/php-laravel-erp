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
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount, $location, $insert=false;

    public function render()
    {
        // dd($this->dana_from);
        if($this->dana_from == '1'){
            $this->prno = '1';
        }else{
            $this->prno = '0';
        }

        $this->location                           = @\App\Models\AssetDatabase::where('id', $this->selected_id)->first()->location;

        $data = \App\Models\AssetDatabasePoprnumber::where('asset_id', $this->selected_id)->orderBy('id','DESC');

        return view('livewire.asset-request.edit')->with(['data'=>$data->get()]);
    }

    public function editassetrequest($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        // $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
        $data->dana_from                = $this->dana_from;
        $data->dana_amount              = $this->dana_amount;
        // $data->serial_number            = 'ar'.date('ymd').$this->selected_id;
        $data->save();

        $datapo                             = new \App\Models\AssetDatabasePoprnumber();
        $datapo->asset_id                   = $this->selected_id;
        $datapo->pr_po_number               = $this->pr_no;
        $datapo->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Dana Asset Request Berhasil diinput");
        
        $this->insert = false;
        $this->reset(['pr_no']);
        // $this->emit('reload');

        return redirect()->route('asset-request.index');

        
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



