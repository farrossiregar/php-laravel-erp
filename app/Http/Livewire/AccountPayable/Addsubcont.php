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


class Addsubcont extends Component
{

    protected $listeners = [
        'modaladdsubcontaccountpayable'=>'modaladdsubcontaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $project_code, $period,$rect_name, $pr_no, $nominal, $transfer_date, $cash_transaction_no, $advance, $settlement_date, $settlement_nominal;
    public $difference, $remarks, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file;

    public function render()
    {
        return view('livewire.account-payable.addsubcont');
    }

    public function modaladdsubcontaccountpayable($id)
    {
        $this->selected_id = $id;
        
        $data                           = @\App\Models\AccountPayableSubcont::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->id_master;
        $this->project_code             = @$data->project_code;
        $this->project_name             = @\App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $this->month                    = @$data->project_code;
        $this->year                     = @$data->project_code;
        $this->week                     = @$data->project_code;
        // $this->description              = @$data->description;
        $this->rect_name                = @$data->rect_name;
        $this->pr_no                    = @$data->pr_no;
        
        $this->nominal                  = @$data->nominal;
       
        $this->transfer_date            = @$data->transfer_date;
        $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->advance                  = @$data->advance;
        $this->settlement_date          = @$data->settlement_date;
        $this->settlement_nominal       = @$data->settlement_nominal;
       
        $this->difference               = @$data->difference;
        $this->remarks                  = @$data->remarks;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->doc_settlement           = @$data->doc_settlement;
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



