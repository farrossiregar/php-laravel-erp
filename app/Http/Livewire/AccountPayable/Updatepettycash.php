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


class Updatepettycash extends Component
{

    protected $listeners = [
        'modalupdatepettycashaccountpayable'=>'modalupdatepettycashaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $department, $month, $year, $advance_req_no, $advance_nominal, $advance_date, $settlement_date, $settlement_nominal, $total_settlement, $cash_transaction_no;
    public $description, $id_master, $difference, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file, $doc_settlement;
    public $description1, $description2, $description3, $description4, $description5;
    public $total_settlement1, $total_settlement2, $total_settlement3, $total_settlement4, $total_settlement5;
    

    public $project, $client_project_id, $region, $employee_name, $date, $position, $request_type, $subrequest_type, $doc_name;

    public function render()
    {
        // $reqnum                                 = '003';
        $this->settlement_nominal               = @$this->total_settlement1 + @$this->total_settlement2 + @$this->total_settlement3 + @$this->total_settlement4 + @$this->total_settlement5;
        $this->difference                       = $this->advance_nominal - $this->settlement_nominal;

        return view('livewire.account-payable.updatepettycash');
    }

    public function modalupdatepettycashaccountpayable($id)
    {
        $this->selected_id              = $id;   

        $data                           = @\App\Models\AccountPayablePettycash::where('id', $this->selected_id)->first();
        // $this->selected_id                = $this->selected_id;
        $this->id_master                = @$data->id_master;
        
        $this->department               = @$data->department;
        $this->advance_req_no           = @$data->advance_req_no;
        $this->month                    = @$data->month;
        $this->year                     = @$data->year;
        $this->week                     = @$data->advance_req_no;
        $this->advance_nominal          = @$data->advance_nominal;
        $this->advance_date             = @$data->advance_date;
        $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->settlement_date          = @$data->settlement_date;
        $this->settlement_nominal       = @$data->settlement_nominal;
        $this->difference               = @$data->difference;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->doc_settlement           = @$data->doc_settlement;

        $datamaster                     = \App\Models\AccountPayable::where('id', $data->id_master)->first();
        $this->project                  = $datamaster->project;
        $this->region                   = $datamaster->region;
        $this->employee_name            = $datamaster->name;
        $this->nik                      = $datamaster->nik;
        $this->position                 = \App\Models\UserAccess::where('id', $datamaster->position)->first()->name;
        $this->doc_name                 = $datamaster->doc_name;
        $this->request_type             = $datamaster->request_type;
        $this->subrequest_type          = @\App\Models\RequestDetailOption::where('id', $datamaster->subrequest_type)->first()->request_detail_option;

        $this->settlement_nominal       = @$this->total_settlement1 + @$this->total_settlement2 + @$this->total_settlement3 + @$this->total_settlement4 + @$this->total_settlement5;

        // $detail_desc = \App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->get();
        // $this->total_settlement1              = @\App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->where('description', $detail_desc[0]->description)->first();
        // $this->total_settlement2              = @\App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->where('description', $detail_desc[1]->description)->first();
        // $this->total_settlement3              = @\App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->where('description', $detail_desc[2]->description)->first();
        // $this->total_settlement4              = @\App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->where('description', $detail_desc[3]->description)->first();
        // $this->total_settlement5              = @\App\Models\AdvanceSettlementAP::where('id_master', $this->selected_id)->where('description', $detail_desc[4]->description)->first();
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = \App\Models\AccountPayablePettycash::where('id', $this->selected_id)->first();
        
        // $data->id_master                = $this->selected_id;
        $data->department               = $this->department;
        $data->advance_req_no           = $this->advance_req_no;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        $data->week                     = $this->advance_req_no;
        $data->advance_nominal          = $this->advance_nominal;
        $data->advance_date             = $this->advance_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        $data->settlement_date          = date('Y-m-d');
        // $data->description              = $this->description;
        $data->settlement_nominal       = $this->settlement_nominal;
        $data->difference               = $this->difference;
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
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

        $detail_desc = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->get();
        // dd($detail_desc[0]->description, $this->selected_id);
        // dd($detail_desc);
        if($this->total_settlement1){
            $detaildata                             = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->where('description', $detail_desc[0]->description)->first();
            // dd($detaildata);
            $detaildata->settlement                 = $this->total_settlement1;
            $detaildata->save();
        }

        if($this->total_settlement2){
            $detaildata                             = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->where('description', $detail_desc[1]->description)->first();
            $detaildata->settlement                 = $this->total_settlement2;
            $detaildata->save();
        }

        if($this->total_settlement3){
            $detaildata                             = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->where('description', $detail_desc[2]->description)->first();
            $detaildata->settlement                 = $this->total_settlement3;
            $detaildata->save();
        }

        if($this->total_settlement4){
            $detaildata                             = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->where('description', $detail_desc[3]->description)->first();
            $detaildata->settlement                 = $this->total_settlement4;
            $detaildata->save();
        }

        if($this->total_settlement5){
            $detaildata                             = \App\Models\AdvanceSettlementAP::where('id_master', $data->id_master)->where('description', $detail_desc[0]->description)->first();
            $detaildata->settlement                 = $this->total_settlement5;
            $detaildata->save();
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

       


        session()->flash('message-success',"Request Petty Cash Berhasil diupdate");
        
        // return redirect()->route('livewire.finance.petty-cash');
        return view('livewire.finance.petty-cash');
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



