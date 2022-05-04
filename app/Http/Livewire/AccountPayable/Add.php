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
use App\Models\AccountPayablePettycash;

class Add extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $date, $position, $department;
    
    public $request_type, $subrequest_type, $file, $doc_name;

    public function render()
    {
        return view('livewire.account-payable.add');
    }

    public function mount()
    {
        $this->employee_name    = isset(Auth::user()->employee->name)?Auth::user()->employee->name : '-';
        $this->project    = isset(Auth::user()->employee->region->region)?Auth::user()->employee->region->region : '-';
        $this->position    = isset(Auth::user()->employee->access->name)?Auth::user()->employee->access->name : '-';
        $this->department    = isset(Auth::user()->employee->department->name)?Auth::user()->employee->department->name : '-';
    }
  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\AccountPayable();
        $data->project                  = $this->project;
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->nik                      = $user->nik;
        $data->position                 = $user->user_access_id;
        
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
        $selected_id = $data->id;

        if($this->request_type==1){
            $data                           = new AccountPayablePettycash();
            $data->id_master                = $selected_id;
            $data->department               = isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '';
            $data->advance_req_no           = (isset(\Auth::user()->employee->department->name) ? substr(\Auth::user()->employee->department->name,0,1) : '').date('ym').(AccountPayablePettycash::count()+1);
            $data->month                    = date('M');
            $data->year                     = date('Y');
            // $data->nominal_recorded = $data->
            // $data->week                     = $this->advance_req_no;
            // $data->advance_nominal          = $this->advance_nominal;
            // $data->advance_date             = $this->advance_date;
            // $data->cash_transaction_no      = $this->cash_transaction_no;
            // $data->settlement_date          = $this->settlement_date;
            $data->description = $this->subrequest_type;
            // $data->settlement_nominal       = $this->settlement_nominal;
            // $data->difference               = $this->difference;
            // $data->account_no_recorded      = $this->account_no_recorded;
            // $data->account_name_recorded    = $this->account_name_recorded;
            // $data->nominal_recorded         = $this->nominal_recorded;
            $data->save();
        }

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



