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


class Addpo extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $kind_of_invoice, $project, $region, $customer_name, $month, $year, $invoice_no, $tax_invoice_no, $po_no, $po_date, $invoice_description;
    public $item_description1, $currency1, $qty1, $price_perunit1, $total1;
    public $item_description2, $currency2, $qty2, $price_perunit2, $total2;
    public $item_description3, $currency3, $qty3, $price_perunit3, $total3;
    public $item_description4, $currency4, $qty4, $price_perunit4, $total4;
    public $item_description5, $currency5, $qty5, $price_perunit5, $total5;
    public $top, $total_item, $vat, $result_vat, $amount_vat, $deduction, $art23, $art4, $net_amount, $due_date;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;
        $this->position = \App\Models\UserAccess::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->user_access_id)->first()->name;
        $this->department = \App\Models\Department::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->department_id)->first()->name;
       
        if(isset($this->top)){
            $this->due_date = date('Y-m-d', strtotime("+".$this->top." days", strtotime(date('Y-m-d'))));
        }
        
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

        $this->net_amount = $this->amount_vat - ($this->deduction + $this->art23 + $this->art4);

        return view('livewire.sales-account-receivable.addpo');
    }

    

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\SalesInvoiceListingDetails();
        // $data                           = \App\Models\SalesInvoiceListingDetails::where('id', $this->selected_id)->first();
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
        // $data->po_no                    = $this->po_no;
        // $data->po_date                  = $this->po_date;
        // $data->invoice_description      = $this->invoice_description;
        // $data->currency                 = $this->currency;
        // $data->qty                      = $this->qty;
        // $data->price_perunit            = $this->price_perunit;
        // $data->total                    = $this->total_item;
        // $data->top                      = $this->top;    
        // $data->deduction                = $this->deduction;    
        // $data->art23                    = $this->art23;    
        // $data->art4                     = $this->art4;    
        // $data->net_amount               = $this->net_amount;    
        // $data->vat                      = $this->vat;    
        // $data->due_date                 = $this->due_date;    
        // $data->credit_note_number       = $this->getNextId().'/CN'.'/'.substr(strtoupper($this->customer_name), 0, 3).'/'.$this->month.'/'.$this->year;    
        
        $data->save();


        
        // if(isset($this->item_description1) && isset($this->qty1) && isset($this->price_perunit1)){
        //     $datadetail                     = new \App\Models\SalesInvoiceListingDetaildesc();
        //     $datadetail->id_master          = $data->id;
        //     $datadetail->item_description   = $this->item_description1;
        //     $datadetail->currency           = $this->currency1;
        //     $datadetail->qty                = $this->qty1;
        //     $datadetail->price_perunit      = $this->price_perunit1;
        //     $datadetail->total              = $this->qty1 * $this->price_perunit1;
        //     $datadetail->save();
        // }

        // if(isset($this->item_description2) && isset($this->qty2) && isset($this->price_perunit2)){
        //     $datadetail                     = new \App\Models\SalesInvoiceListingDetaildesc();
        //     $datadetail->id_master          = $data->id;
        //     $datadetail->item_description   = $this->item_description2;
        //     $datadetail->currency           = $this->currency2;
        //     $datadetail->qty                = $this->qty2;
        //     $datadetail->price_perunit      = $this->price_perunit2;
        //     $datadetail->total              = $this->qty1 * $this->price_perunit2;
        //     $datadetail->save();
        // }

        // if(isset($this->item_description3) && isset($this->qty3) && isset($this->price_perunit3)){
        //     $datadetail                     = new \App\Models\SalesInvoiceListingDetaildesc();
        //     $datadetail->id_master          = $data->id;
        //     $datadetail->item_description   = $this->item_description3;
        //     $datadetail->currency           = $this->currency3;
        //     $datadetail->qty                = $this->qty3;
        //     $datadetail->price_perunit      = $this->price_perunit3;
        //     $datadetail->total              = $this->qty1 * $this->price_perunit3;
        //     $datadetail->save();
        // }

        // if(isset($this->item_description4) && isset($this->qty4) && isset($this->price_perunit4)){
        //     $datadetail                     = new \App\Models\SalesInvoiceListingDetaildesc();
        //     $datadetail->id_master          = $data->id;
        //     $datadetail->item_description   = $this->item_description4;
        //     $datadetail->currency           = $this->currency4;
        //     $datadetail->qty                = $this->qty4;
        //     $datadetail->price_perunit      = $this->price_perunit4;
        //     $datadetail->total              = $this->qty1 * $this->price_perunit4;
        //     $datadetail->save();
        // }

        // if(isset($this->item_description5) && isset($this->qty5) && isset($this->price_perunit5)){
        //     $datadetail                     = new \App\Models\SalesInvoiceListingDetaildesc();
        //     $datadetail->id_master          = $data->id;
        //     $datadetail->item_description   = $this->item_description5;
        //     $datadetail->currency           = $this->currency5;
        //     $datadetail->qty                = $this->qty5;
        //     $datadetail->price_perunit      = $this->price_perunit5;
        //     $datadetail->total              = $this->qty1 * $this->price_perunit5;
        //     $datadetail->save();
        // }
                        

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Sales PO Berhasil diinput");
        
        return redirect()->route('sales-account-receivable.index');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'sales_invoice_listing_details'");
        return $statement[0]->Auto_increment;
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



