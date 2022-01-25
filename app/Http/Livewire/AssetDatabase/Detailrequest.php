<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailrequest extends Component
{
    protected $listeners = [
        'modaldetailrequest'=>'modaldetailrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;

    public function render()
    {
       
        if($this->dana_from == '1'){
            $this->prno = '1';
        }
        return view('livewire.asset-database.detailrequest');
    }

    public function modaldetailrequest($id)
    {
        $this->selected_id = $id;
        
    }

    public function save()
    {

        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();        
        $data->dana_from                = $this->dana_from;
        $data->pr_no                    = $this->pr_no;
        $data->dana_amount              = $this->dana_amount;
        $data->request_id               = 'REQ'.date('ymdhis');
        // $data->serial_number            = 'ar'.date('ymd').$this->selected_id;
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Asset Request Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }



}



