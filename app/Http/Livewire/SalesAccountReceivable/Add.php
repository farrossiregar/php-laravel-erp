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
    public $currency, $qty, $price_perunit, $total, $top;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;
        $this->position = \App\Models\UserAccess::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->user_access_id)->first()->name;
        $this->department = \App\Models\Department::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->department_id)->first()->name;
       

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



