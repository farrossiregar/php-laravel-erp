<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;
use DB;


class Add extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $kind_of_invoice, $project, $region, $customer_name, $month, $year, $invoice_no, $tax_invoice_no, $po_no, $po_date, $invoice_description;
    public $currency1, $qty1, $price_perunit1, $total1;
    public $currency2, $qty2, $price_perunit2, $total2;
    public $currency3, $qty3, $price_perunit3, $total3;
    public $currency4, $qty4, $price_perunit4, $total4;
    public $currency5, $qty5, $price_perunit5, $total5;
    public $top, $total_item, $vat, $result_vat, $amount_vat;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;
        $this->position = \App\Models\UserAccess::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->user_access_id)->first()->name;
        $this->department = \App\Models\Department::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->department_id)->first()->name;
       
        if(isset($this->qty1) && isset($this->price_perunit1)){
            $this->total1 = $this->qty1 * $this->price_perunit1;
        }

        if(isset($this->qty2) && isset($this->price_perunit2)){
            $this->total2 = $this->qty2 * $this->price_perunit2;
        }

        if(isset($this->qty3) && isset($this->price_perunit3)){
            $this->total3 = $this->qty3 * $this->price_perunit3;
        }

        if(isset($this->qty4) && isset($this->price_perunit4)){
            $this->total4 = $this->qty4 * $this->price_perunit4;
        }

        if(isset($this->qty5) && isset($this->price_perunit5)){
            $this->total5 = $this->qty5 * $this->price_perunit5;
        }

        $this->total_item = $this->total1 + $this->total2 + $this->total3 + $this->total4 + $this->total5;

        if(isset($this->total_item)){
            if($this->vat == '1'){
                $this->result_vat = ($this->total_item * 10) / 100;
                $this->amount_vat = $this->result_vat + $this->total_item;
            }else{
                $this->result_vat = 0;
                $this->amount_vat = $this->result_vat + $this->total_item;
            }
        }

        return view('livewire.sales-account-receivable.add');
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\SalesInvoiceListingDetails();
        $data->kind_of_invoice          = $this->kind_of_invoice;
        $data->project_name             = $this->project;
        $data->project_code             = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        $data->region                   = $this->region;
        $data->cust_name                = $this->customer_name;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        $data->invoice_no               = $this->invoice_no;
        $data->tax_invoice_no           = $this->tax_invoice_no;
        $data->invoice_date             = date('Y-m-d');
        $data->po_no                    = $this->po_no;
        $data->po_date                  = $this->po_date;
        $data->invoice_description      = $this->invoice_description;
        $data->currency                 = $this->currency;
        $data->qty                      = $this->qty;
        $data->price_perunit            = $this->price_perunit;
        $data->total                    = $this->total;
        $data->top                      = $this->top;    
        
        $data->save();

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Sales Invoice Listing Details Berhasil diinput");
        
        return redirect()->route('sales-account-receivable.index');
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



