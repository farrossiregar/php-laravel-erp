<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detaildana extends Component
{
    protected $listeners = [
        'modaldetaildana'=>'modaldetaildana',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount, $serial_number;
    // public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname;
    // public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $expired_date;

    public function render()
    {
      

        if($this->dana_from == '1'){
            $this->prno = '1';
        }
        return view('livewire.asset-database.detaildana');
    }

    public function modaldetaildana($id)
    {

        $this->selected_id      = $id;
        $data                   = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
      

        $this->dana_from        = $data->dana_from;
        $this->pr_no            = $data->pr_no;
        $this->dana_amount      = $data->dana_amount;
        $this->serial_number    = $data->serial_number;
        
        
    }

    public function save()
    {

        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();        
       
        $data->dana_from                = $this->dana_from;
        $data->pr_no                    = $this->pr_no;
        $data->dana_amount              = $this->dana_amount;
        $data->serial_number            = $this->serial_number;
        
        
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Dana Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }



}



