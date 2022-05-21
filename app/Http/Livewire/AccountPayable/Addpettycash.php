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


class Addpettycash extends Component
{

    protected $listeners = [
        'modaladdpettycashaccountpayable'=>'modaladdpettycashaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $department, $month, $year, $advance_req_no, $advance_nominal, $advance_date, $settlement_date, $settlement_nominal, $total_settlement, $cash_transaction_no;
    public $description, $difference, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file, $doc_settlement;
    public $description1, $description2, $description3, $description4, $description5;

    public function render()
    {
        $reqnum                                 = '003';
        
        if($this->department){
            $this->advance_req_no               = \App\Models\Department::where('id', $this->department)->first()->name.'/'.date('Ym').'/'.$reqnum;
        }else{
            $this->advance_req_no               = '';
        }
        return view('livewire.account-payable.addpettycash');
    }

    public function modaladdpettycashaccountpayable($id)
    {
        $this->selected_id = $id;

        $reqnum                         = '003';
        // dd(\App\Models\AccountPayablePettycash::orderBy('id', 'desc')->first());
        $data                           = @\App\Models\AccountPayablePettycash::where('id_master', $this->selected_id)->first();
        $this->id_master                = $this->selected_id;

        $this->department               = @$data->department;
        if($this->department){
            $this->advance_req_no               = $this->department.'/'.date('YM').'/'.$reqnum;
        }else{
            $this->advance_req_no               = '';
        }
        
        $this->advance_req_no           = @$data->advance_req_no;
        $this->month                    = @$data->month;
        $this->year                     = @$data->year;
        $this->week                     = @$data->advance_req_no;
        $this->advance_nominal          = @$data->advance_nominal;
        $this->advance_date             = @$data->advance_date;
        // $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->cash_transaction_no      = $reqnum.'/'.date('d').'/'.date('m').'/'.date('Y').'/CashOut';
        $this->settlement_date          = @$data->settlement_date;
        $this->description              = @$data->description;
        $this->settlement_nominal       = @$data->settlement_nominal;
        $this->total_settlement         = @$data->total_settlement;
        $this->difference               = @$data->difference;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->doc_settlement           = @$data->doc_settlement;

        
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        if(!@\App\Models\AccountPayablePettycash::where('id_master', $this->selected_id)->first()){
            $data                           = new \App\Models\AccountPayablePettycash();
        }else{
            $data                           = \App\Models\AccountPayablePettycash::where('id_master', $this->selected_id)->first();
        }
        $data->id_master                = $this->selected_id;
        $data->department               = $this->department;
        $data->advance_req_no           = $this->advance_req_no;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        $data->week                     = $this->advance_req_no;
        $data->advance_nominal          = $this->advance_nominal;
        $data->advance_date             = $this->advance_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        // $data->settlement_date          = $this->settlement_date;
        // $data->description              = $this->description;
        // $data->settlement_nominal       = $this->settlement_nominal;
        // $data->difference               = $this->difference;
        // $data->account_no_recorded      = $this->account_no_recorded;
        // $data->account_name_recorded    = $this->account_name_recorded;
        // $data->nominal_recorded         = $this->nominal_recorded;
        
        
       
        if(!@\App\Models\AccountPayablePettycash::where('id_master', $this->selected_id)->first()->doc_settlement){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            if($this->file){
                $ap_doc = 'ap_pettycash'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Account_Payable/Petty_Cash/',$ap_doc);

                $data->doc_settlement               = $ap_doc;
            }
        }
        
        $data->save();

        if($this->description1){
            $data                           = new \App\Models\AdvanceSettlementAP();
            $data->description              = $this->description1;
            $data->save();
        }

        if($this->description2){
            $data                           = new \App\Models\AdvanceSettlementAP();
            $data->description              = $this->description2;
            $data->save();
        }

        if($this->description3){
            $data                           = new \App\Models\AdvanceSettlementAP();
            $data->description              = $this->description3;
            $data->save();
        }

        if($this->description4){
            $data                           = new \App\Models\AdvanceSettlementAP();
            $data->description              = $this->description4;
            $data->save();
        }

        if($this->description5){
            $data                           = new \App\Models\AdvanceSettlementAP();
            $data->description              = $this->description5;
            $data->save();
        }

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

       


        session()->flash('message-success',"Request Petty Cash Berhasil diinput");
        
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



