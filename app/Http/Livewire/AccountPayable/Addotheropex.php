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


class Addotheropex extends Component
{
    protected $listeners = [
        'modaladdotheropexaccountpayable'=>'modaladdotheropexaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $project_code, $period, $description, $pr_no, $po_no, $nominal, $transfer_date, $cash_transaction_no, $advance, $settlement_date, $settlement_nominal;
    public $difference, $remarks, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file;


    public function render()
    {

       
        return view('livewire.account-payable.addotheropex');
    }

    public function modaladdotheropexaccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = @\App\Models\AccountPayableOtheropex::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->id_master;
        $this->project_code             = @$data->project_code;
        $this->project_name             = @\App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $this->month                    = @$data->project_code;
        $this->year                     = @$data->project_code;
        $this->week                     = @$data->project_code;
        $this->description              = @$data->description;
        $this->pr_no                    = @$data->pr_no;
        $this->po_no                    = @$data->po_no;
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

        $data                           = new \App\Models\AccountPayableOtheropex();
        $data->id_master                = $this->selected_id;
        $data->project_code             = $this->project_code;
        $data->project_name             = \App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $data->month                    = $this->project_code;
        $data->year                     = $this->project_code;
        $data->week                     = $this->project_code;
        $data->description              = $this->description;
        $data->pr_no                    = $this->pr_no;
        $data->po_no                    = $this->po_no;
        $data->nominal                  = $this->nominal;
       
        $data->transfer_date            = $this->transfer_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        $data->advance                  = $this->advance;
        $data->settlement_date          = $this->settlement_date;
        $data->settlement_nominal       = $this->settlement_nominal;
       
        $data->difference               = $this->difference;
        $data->remarks                  = $this->remarks;
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        
        
        if($this->file){
            $ap_doc = 'ap_otheropex'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Account_Payable/Other_Opex/',$ap_doc);

            $data->doc_settlement               = $ap_doc;
        }
        
        $data->save();

        $datamaster                           = \App\Models\AccountPayable::where('id', $this->selected_id)->first();
        $datamaster->update_req               = '1';
        $datamaster->save();

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Other Opex Berhasil diinput");
        
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



