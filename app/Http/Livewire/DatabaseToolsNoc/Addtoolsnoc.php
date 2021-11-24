<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use DateTime;

class Addtoolsnoc extends Component
{
    protected $listeners = [
        'modalapprovedatabasenoc'=>'approvenoc',
    ];

    use WithFileUploads;
    public $name, $nik, $tools, $software;

    
    public function render()
    {
        if($this->name){
            $this->nik = \App\Models\Employee::where('name', $this->name)->first()->nik;
        }
        return view('livewire.database-tools-noc.addtoolsnoc');
    }

    public function approvenoc($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        
        $data               = new \App\Models\ToolsNoc();
        $data->name         = $this->name;
        $data->nik          = $this->nik;
        $data->tools        = $this->tools;
        $data->software     = $this->software;
        $pubdate            = date('Y-m-d');
        $data->week         = $this->weekOfMonth($pubdate);
        $data->month         = date('m');
        $data->year         = date('Y');
        
        $data->save();

    
        // $notif_user_psm = check_access_data('database-noc.notif-psm', '');
        // $nameuser_psm = [];
        // $emailuser_psm = [];
        // $phoneuser_psm = [];
        // foreach($notif_user_psm as $no => $itemuser){
        //     $nameuser_psm[$no] = $itemuser->name;
        //     $emailuser_psm[$no] = $itemuser->email;
        //     $phoneuser_psm[$no] = $itemuser->telepon;

        //     $message = "*Dear PSM *\n\n";
        //     $message .= "*Database Tools NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
        //     send_wa(['phone'=> $phoneuser_psm[$no],'message'=>$message]);    

        //     // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        // }


       
        session()->flash('message-success',"Berhasil, Database Tools NOC berhasil ditambahkan!!!");
        
        return redirect()->route('database-tools-noc.index');
    }

    public function weekOfMonth($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
}
