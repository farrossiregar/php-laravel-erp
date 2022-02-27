<?php

namespace App\Http\Livewire\SalesAccountReceivable;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use Auth;
use PDF;

class Data extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name, $cust_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        
        // if(check_access('account-payable.fin-spv')){
        //     // $data = \App\Models\AccountPayable::where('status', '1')->where('request_type', '1')->where('request_type', '2')->where('request_type', '3')->orderBy('created_at', 'desc');
        //     $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
        //                     $query->where('request_type', '=', '1')
        //                         ->orWhere('request_type', '=', '2')
        //                         ->orWhere('request_type', '=', '3');
        //                 })->orderBy('created_at', 'desc');
        // }elseif(check_access('account-payable.fin-mngr')){
        //     $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
        //                     $query->where('request_type', '=', '4')
        //                         ->orWhere('request_type', '=', '5')
        //                         ->orWhere('request_type', '=', '6');
        //                 })->orderBy('created_at', 'desc');
        // }elseif(check_access('account-payable.sr-fin-acc-mngr')){
        //     $data = \App\Models\AccountPayable::whereIn('status', ['1', '2'])->where(function ($query) {
        //                     $query->where('request_type', '=', '7')
        //                         ->orWhere('request_type', '=', '8')
        //                         ->orWhere('request_type', '=', '9');
        //                 })->orderBy('created_at', 'desc');
        // }elseif(check_access('account-payable.pmg')){
        //     $data = \App\Models\AccountPayable::orderBy('created_at', 'desc');
        // }else{
        //     $user = Auth::user();
        //     $data = \App\Models\AccountPayable::where('nik', $user->nik)->orderBy('created_at', 'desc');
        // }

        $data = \App\Models\SalesInvoiceListingDetails::orderBy('created_at', 'desc');

        if($this->filteryear) $data->whereYear('created_at',$this->filteryear);
        if($this->filtermonth) $data->whereMonth('created_at',$this->filtermonth);                
        if($this->filterproject) $data->where('project_name',\App\Models\ClientProject::where('id', $this->filterproject)->first()->name);                        
        if($this->cust_name) $data->where('cust_name', 'Like', '%'.$this->cust_name.'%');                        
        
        return view('livewire.sales-account-receivable.data')->with(['data'=>$data->paginate(50)]);   
    }


    public function exportsalesinvoice($id){
        // dd($id);
        // $pdf = \App::make('dompdf.wrapper');
        // // $pdf->loadView('livewire.po-tracking-nonms.generate-bast',['data'=>'']);
        // $pdf->loadView('livewire.vendor-management.downloadscoring',['vendor_management'=>'1']);
        
        // return $pdf->stream();


        $pdf = \App::make('dompdf.wrapper');
        $this->data = \App\Models\SalesInvoiceListingDetails::where('id', $id)->first();
        $pdf->loadView('livewire.sales-account-receivable.exportsalesinvoice',['sales_invoice'=>$this->data]);
        // $pdf->stream();
        $filename = 'exportsalesinvoice'.$id.'.pdf';
        // return $pdf->download($filename);
        
        $output = $pdf->output();
        
        
        // $destinationPath = public_path($filename);
        \Storage::put($filename .'.pdf',$output);
    }

    public function exportcreditnote($id){

        $pdf = \App::make('dompdf.wrapper');
        $this->data = \App\Models\SalesInvoiceListingDetails::where('id', $id)->first();
        $pdf->loadView('livewire.sales-account-receivable.exportcreditnote',['credit_note'=>$this->data]);
        // $pdf->stream();
        $filename = 'exportcreditnote'.$id;
        // return $pdf->download($filename);
        
        $output = $pdf->output();
        
        
        // $destinationPath = public_path($filename);
        \Storage::put($filename .'.pdf',$output);
    }
}