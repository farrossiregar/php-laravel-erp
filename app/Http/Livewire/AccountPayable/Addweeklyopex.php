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


class Addweeklyopex extends Component
{
    protected $listeners = [
        'modaladdweeklyopexaccountpayable'=>'modaladdweeklyopexaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $project_code, $period, $description, $budget_opex, $previous_balance, $total_transfer, $transfer_date, $cash_transaction_no, $settlement_date, $settlement_nominal, $total_settlement;
    public $settlement_description, $admin_to_team, $difference_admin_team, $difference_hq_admin, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file;

    public function render()
    {
        return view('livewire.account-payable.addweeklyopex');
    }

    public function modaladdweeklyopexaccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = @\App\Models\AccountPayableWeeklyopex::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->id_master;
        $this->project_code             = @$data->project_code;
        $this->project_name             = @\App\Models\ClientProject::where('id', $data->project_code)->first()->name;
        $this->month                    = @$data->project_code;
        $this->year                     = @$data->project_code;
        $this->week                     = @$data->project_code;
        $this->description              = @$data->description;
        $this->budget_opex              = @$data->budget_opex;
        $this->previous_balance         = @$data->previous_balance;
        $this->total_transfer           = @$data->total_transfer;
        $this->transfer_date            = @$data->transfer_date;
        $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->settlement_date          = @$data->settlement_date;
        $this->settlement_nominal       = @$data->settlement_nominal;
        $this->total_settlement         = @$data->total_settlement;
        $this->admin_to_team            = @$data->admin_to_team;
        $this->difference_admin_team    = @$data->difference_admin_team;
        $this->difference_hq_admin      = @$data->difference_hq_admin;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->doc_settlement           = @$data->doc_settlement;
    }
  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\AccountPayableWeeklyopex();
        $data->id_master                = $this->selected_id;
        $data->project_code             = $this->project_code;
        $data->project_name             = \App\Models\ClientProject::where('id', $this->project_code)->first()->name;
        $data->month                    = $this->project_code;
        $data->year                     = $this->project_code;
        $data->week                     = $this->project_code;
        $data->description              = $this->description;
        $data->budget_opex              = $this->budget_opex;
        $data->previous_balance         = $this->previous_balance;
        $data->total_transfer           = $this->total_transfer;
        $data->transfer_date            = $this->transfer_date;
        $data->cash_transaction_no      = $this->cash_transaction_no;
        $data->settlement_date          = $this->settlement_date;
        $data->settlement_nominal       = $this->settlement_nominal;
        $data->total_settlement         = $this->total_settlement;
        $data->admin_to_team            = $this->admin_to_team;
        $data->difference_admin_team    = $this->difference_admin_team;
        $data->difference_hq_admin      = $this->difference_hq_admin;
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ap_doc = 'ap_weeklyopex'.$this->selected_id.'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Account_Payable/Weekly_Opex/',$ap_doc);

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

       


        session()->flash('message-success',"Request Weekly Opex Berhasil diinput");
        
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



