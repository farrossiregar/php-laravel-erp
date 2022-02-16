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


class Addhqadministration extends Component
{
    protected $listeners = [
        'modaladdhqadministrationaccountpayable'=>'modaladdhqadministrationaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $department, $month, $year, $transfer_to, $description, $request_type, $invoice_no, $invoice_date, $total_transfer, $transfer_date, $cash_transaction_no, $advance, $settlement_date, $settlement_nominal;
    public $difference, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file;

    public function render()
    {

        return view('livewire.account-payable.addhqadministration');
    }

    public function modaladdhqadministrationaccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = @\App\Models\AccountPayableHqadministration::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->id_master;
        $this->department               = @$data->department;
        $this->request_type             = @$data->request_type;
        $this->month                    = @$data->month;
        $this->year                     = @$data->year;
        // $this->week                     = @$data->project_code;
        $this->transfer_to              = @$data->transfer_to;
        $this->invoice_no               = @$data->invoice_no;
        $this->invoice_date             = @$data->invoice_date;
        $this->total_transfer           = @$data->total_transfer;
        $this->transfer_date            = @$data->transfer_date;
        $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->advance                  = @$data->advance;
        $this->settlement_date          = @$data->settlement_date;
        $this->settlement_nominal       = @$data->settlement_nominal;
        $this->difference               = @$data->difference;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\AccountPayableHqadministration();
        $data->id_master                = $this->selected_id;
        $data->department               = $this->department;
        $data->request_type             = $this->request_type;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        // $data->week                     = $this->project_code;
        $data->transfer_to              = $this->transfer_to;
        $data->invoice_no               = $this->invoice_no;
        $data->invoice_date             = $this->invoice_date;
        $data->total_transfer           = $this->total_transfer;
        $data->transfer_date            = $this->transfer_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        $data->advance                  = $this->advance;
        $data->settlement_date          = $this->settlement_date;
        $data->settlement_nominal       = $this->settlement_nominal;
        $data->difference               = $this->difference;
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ap_doc = 'ap_hqadministration'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Account_Payable/HQ_Administration/',$ap_doc);

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

       


        session()->flash('message-success',"Request HQ Administration Berhasil diinput");
        
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



