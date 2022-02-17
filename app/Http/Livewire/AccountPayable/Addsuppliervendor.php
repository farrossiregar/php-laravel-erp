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


class Addsuppliervendor extends Component
{
    protected $listeners = [
        'modaladdsuppliervendoraccountpayable'=>'modaladdsuppliervendoraccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $request_detail_option, $project_code, $project_name, $month, $year, $invoice_no, $invoice_date, $top;
    public $due_date, $supplier_vendor_name, $pr_no, $po_no, $description, $qty, $unit_price, $shipping_price, $total_price, $other_cost;
    public $vat, $wht, $total_payment, $actual_payment, $advance, $percentage_actual_payment, $actual_transfer_date, $cash_transaction_no;
    public $tgl_narik_data, $ap_amount, $request_doc, $payment_voucher_doc, $settlement_doc;
    public $account_no_recorded, $account_name_recorded, $nominal_recorded, $file;


    public function render()
    {

        return view('livewire.account-payable.addsuppliervendor');
    }

    public function modaladdsuppliervendoraccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = @\App\Models\AccountPayableSuppliervendor::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->selected_id;
        $this->request_detail_option    = @$data->request_detail_option;
        $this->project_code             = @$data->project_code;
        $this->project_name             = @\App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $this->invoice_no               = @$data->invoice_no;
        $this->invoice_date             = @$data->invoice_date;
        $this->top                      = @$data->top;
        $this->due_date                 = @$data->due_date;
        $this->supplier_vendor_name     = @$data->supplier_vendor_name;
        $this->pr_no                    = @$data->pr_no;
        $this->po_no                    = @$data->po_no;
        $this->description              = @$data->description;
        $this->qty                      = @$data->qty;
        $this->unit_price               = @$data->unit_price;
        $this->shipping_price           = @$data->shipping_price;
        $this->total_price              = @$data->total_price;
        // $this->other_cost               = @$data->other_cost;
        $this->vat                      = @$data->vat;
        $this->wht                      = @$data->wht;
        $this->total_payment            = @$data->total_payment;
        $this->actual_payment           = @$data->actual_payment;
        $this->advance                  = @$data->advance;
        $this->percentage_actual_payment   = @$data->percentage_actual_payment;
        $this->actual_transfer_date     = @$data->actual_transfer_date;
        $this->cash_transaction_no      = @$data->cash_transaction_no;
        
        $this->tgl_narik_data           = @$data->tgl_narik_data;
       
        $this->ap_amount                = @$data->ap_amount;
        
        $this->request_doc              = @$data->request_doc;
        $this->payment_voucher_doc      = @$data->payment_voucher_doc;
        // $this->settlement_doc           = @$data->settlement_doc;
        
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->settlement_doc           = @$data->settlement_doc;
    }


  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        if(!@\App\Models\AccountPayableSuppliervendor::where('id_master', $this->selected_id)->first()->settlement_doc){
            $data                           = new \App\Models\AccountPayableSuppliervendor();
        }else{
            $data                           = \App\Models\AccountPayableSuppliervendor::where('id_master', $this->selected_id)->first();
        }
        $data->id_master                = $this->selected_id;
        $data->request_detail_option    = $this->request_detail_option;
        $data->project_code             = $this->project_code;
        $data->project_name             = \App\Models\ClientProject::where('id', $this->project_code)->first()->name;
        $data->invoice_no               = $this->invoice_no;
        $data->invoice_date             = $this->invoice_date;
        $data->top                      = $this->top;
        $data->due_date                 = $this->due_date;
        $data->supplier_vendor_name     = $this->supplier_vendor_name;
        $data->pr_no                    = $this->pr_no;
        $data->po_no                    = $this->po_no;
        $data->description              = $this->description;
        $data->qty                      = $this->qty;
        $data->unit_price               = $this->unit_price;
        $data->shipping_price           = $this->shipping_price;
        $data->total_price              = $this->total_price;
        // $data->other_cost               = $this->other_cost;
        $data->vat                      = $this->vat;
        $data->wht                      = $this->wht;
        $data->total_payment            = $this->total_payment;
        $data->actual_payment           = $this->actual_payment;
        $data->advance                  = $this->advance;
        $data->percentage_actual_payment   = $this->percentage_actual_payment;
        $data->actual_transfer_date     = $this->actual_transfer_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        
        $data->tgl_narik_data           = $this->tgl_narik_data;
       
        $data->ap_amount                = $this->ap_amount;
        
        $data->request_doc              = $this->request_doc;
        $data->payment_voucher_doc      = $this->payment_voucher_doc;
        // $data->settlement_doc           = $this->settlement_doc;
        
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        

        if(!@\App\Models\AccountPayableSuppliervendor::where('id_master', $this->selected_id)->first()->request_doc){
            $this->validate([
                'request_doc'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            if($this->request_doc){
                $req_doc = 'ap_suppliervendor_reqdoc'.$this->selected_id.'.'.$this->request_doc->extension();
                $this->request_doc->storePubliclyAs('public/Account_Payable/Supplier_Vendor/',$req_doc);

                $data->request_doc               = $req_doc;
            }
        }

        if(!@\App\Models\AccountPayableSuppliervendor::where('id_master', $this->selected_id)->first()->settlement_doc){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            if($this->file){
                $ap_doc = 'ap_suppliervendor'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Account_Payable/Supplier_Vendor/',$ap_doc);

                $data->settlement_doc               = $ap_doc;
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



