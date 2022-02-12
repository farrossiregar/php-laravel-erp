<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;
use DB;


class Addsitekeeper extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $date, $position, $department;
    
    
    public $request_type, $subrequest_type, $file, $doc_name;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;
        $this->position = \App\Models\UserAccess::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->user_access_id)->first()->name;
        $this->department = \App\Models\Department::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->department_id)->first()->name;
       

        return view('livewire.account-payable.addsitekeeper');
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\AccountPayable();
        // $data->company_name             = Session::get('company_id');
        $data->project                  = $this->project;
        // $data->client_project_id        = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        
        
        // $dataemployee                   = explode(" - ",$this->employee_name);
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->nik                      = $user->nik;
        $data->position                 = $user->user_access_id;
        // $data->employee_id              = $dataemployee[2];
        
       
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ap_doc = 'ap_doc'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Account_Payable/',$ap_doc);

            $data->additional_doc               = $ap_doc;
            $data->doc_name                     = $this->doc_name;
        }
        
        $data->department                       = $this->department;
        $data->request_type                     = $this->request_type;
        $data->subrequest_type                  = $this->subrequest_type;
        $data->save();

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Account Payable Berhasil diinput");
        
        return redirect()->route('account-payable.index');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'account_payable'");
        return $statement[0]->Auto_increment;
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



