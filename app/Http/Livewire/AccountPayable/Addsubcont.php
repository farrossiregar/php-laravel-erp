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
    public $selected_id, $project_code, $contract_no, $period, $month, $year, $subcont_name, $invoice_no, $invoice_name, $invoice_date, $po_no, $pr_no, $other_cost, $total_nominal;
    public $vat, $wht, $total_transfer, $transfer_date, $cash_transaction_no, $advance, $settlement_date, $settlement_nominal;
    public $difference, $remarks, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file, $doc_settlement;

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
        $this->contract_no              = @$data->contract_no;
        $this->month                    = @$data->month;
        $this->year                     = @$data->year;
        $this->week                     = @$data->project_code;
        
        $this->subcont_name             = @$data->subcont_name;
        $this->invoice_no               = @$data->invoice_no;
        $this->invoice_date             = @$data->invoice_date;
        $this->pr_no                    = @$data->pr_no;
        $this->po_no                    = @$data->po_no;
        $this->other_cost               = @$data->other_cost;
        
        $this->total_nominal            = @$data->total_nominal;
        $this->vat                      = @$data->vat;
        $this->wht                      = @$data->wht;
       
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

        if(!@\App\Models\AccountPayableSubcont::where('id_master', $this->selected_id)->first()){
            $data                           = new \App\Models\AccountPayableSubcont();
        }else{
            $data                           = \App\Models\AccountPayableSubcont::where('id_master', $this->selected_id)->first();
        }
        $data->id_master                = $this->selected_id;
        $data->project_code             = $this->project_code;
        $data->project_name             = \App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $data->contract_no              = $this->contract_no;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        $data->week                     = $this->project_code;
        $data->subcont_name             = $this->subcont_name;
        $data->invoice_no               = $this->invoice_no;
        $data->invoice_date             = $this->invoice_date;
        $data->pr_no                    = $this->pr_no;
        $data->po_no                    = $this->po_no;
        $data->other_cost               = $this->other_cost;
        
        $data->total_nominal            = $this->total_nominal;
        $data->vat                      = $this->vat;
        $data->wht                      = $this->wht;
       
        $data->total_transfer           = $this->total_transfer;
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
        
        if(!@\App\Models\AccountPayableSubcont::where('id_master', $this->selected_id)->first()->doc_settlement){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            if($this->file){
                $ap_doc = 'ap_subcont'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Account_Payable/Subcont/',$ap_doc);

                $data->doc_settlement               = $ap_doc;
            }
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

       


        session()->flash('message-success',"Request Subcont Berhasil diinput");
        
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



