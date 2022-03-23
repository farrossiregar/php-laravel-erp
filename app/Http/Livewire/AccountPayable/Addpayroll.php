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


class Addpayroll extends Component
{
    protected $listeners = [
        'modaladdpayrollaccountpayable'=>'modaladdpayrollaccountpayable',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $project_code, $project_name, $month, $year, $employee_number, $basic_salary, $pulse_allowance, $position_allowance, $homebase_allowance;
    public $transport_allowance, $motor_allowance, $overtime_allowance, $refund_pph21, $staff_claim, $incentive, $jamsostek_payable, $jamsostek_payable_jp, $bpjs_kesehatan;
    public $pph21, $piutang, $own_risk, $unpaid_leave, $pinalty, $thp, $cash_transaction_no, $advance, $settlement_date, $settlement_nominal;
    public $account_no_recorded, $account_name_recorded, $nominal_recorded, $file, $attachment_hr;

    public function render()
    {

        return view('livewire.account-payable.addpayroll');
    }


    public function modaladdpayrollaccountpayable($id)
    {
        $this->selected_id = $id;

        $data                           = @\App\Models\AccountPayablePayroll::where('id_master', $this->selected_id)->first();
        $this->id_master                = @$data->id_master;
        $this->project_code             = @$data->project_code;
        $this->project_name             = @\App\Models\ClientProject::where('id', $this->project_code)->first()->name;
        $this->month                    = @$data->month;
        $this->year                     = @$data->year;
        // $this->week                     = @$data->project_code;
        $this->employee_number          = @$data->employee_number;
        $this->basic_salary             = @$data->basic_salary;
        $this->pulse_allowance          = @$data->pulse_allowance;
        $this->position_allowance       = @$data->position_allowance;
        $this->homebase_allowance       = @$data->homebase_allowance;
        $this->transport_allowance      = @$data->transport_allowance;
        $this->motor_allowance          = @$data->motor_allowance;
        $this->overtime_allowance       = @$data->overtime_allowance;

        $this->refund_pph21             = @$data->refund_pph21;
        $this->staff_claim              = @$data->staff_claim;
        $this->incentive                = @$data->incentive;
        $this->jamsostek_payable        = @$data->jamsostek_payable;
        $this->jamsostek_payable_jp     = @$data->jamsostek_payable_jp;
        $this->bpjs_kesehatan           = @$data->bpjs_kesehatan;
        $this->pph21                    = @$data->pph21;
        $this->piutang                  = @$data->piutang;
        $this->own_risk                 = @$data->own_risk;
        $this->unpaid_leave             = @$data->unpaid_leave;
        $this->pinalty                  = @$data->pinalty;
        $this->thp                      = @$data->thp;

        $this->cash_transaction_no      = @$data->cash_transaction_no;
        $this->account_no_recorded      = @$data->account_no_recorded;
        $this->account_name_recorded    = @$data->account_name_recorded;
        $this->nominal_recorded         = @$data->nominal_recorded;
        $this->attachment_hr            = @$data->attachment_hr;
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        if(!@\App\Models\AccountPayablePayroll::where('id_master', $this->selected_id)->first()){
            $data                           = new \App\Models\AccountPayablePayroll();
        }else{
            $data                           = \App\Models\AccountPayablePayroll::where('id_master', $this->selected_id)->first();
        }
        $data->id_master                = $this->selected_id;
        $data->project_code             = $this->project_code;
        $data->project_name             = @\App\Models\ClientProject::where('id', $this->project_code)->first()->name;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        // $data->week                     = $this->project_code;
        $data->employee_number          = $this->employee_number;
        $data->basic_salary             = $this->basic_salary;
        $data->pulse_allowance          = $this->pulse_allowance;
        $data->position_allowance       = $this->position_allowance;
        $data->homebase_allowance       = $this->homebase_allowance;
        $data->transport_allowance      = $this->transport_allowance;
        $data->motor_allowance          = $this->motor_allowance;
        $data->overtime_allowance       = $this->overtime_allowance;

        $data->refund_pph21             = $this->refund_pph21;
        $data->staff_claim              = $this->staff_claim;
        $data->incentive                = $this->incentive;
        $data->jamsostek_payable        = $this->jamsostek_payable;
        $data->jamsostek_payable_jp     = $this->jamsostek_payable_jp;
        $data->bpjs_kesehatan           = $this->bpjs_kesehatan;
        $data->pph21                    = $this->pph21;
        $data->piutang                  = $this->piutang;
        $data->own_risk                 = $this->own_risk;
        $data->unpaid_leave             = $this->unpaid_leave;
        $data->pinalty                  = $this->pinalty;
        $data->thp                      = $this->thp;

        $data->cash_transaction_no      = $this->cash_transaction_no;
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        
        if(!@\App\Models\AccountPayablePayroll::where('id_master', $this->selected_id)->first()->attachment_hr){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            if($this->file){
                $ap_doc = 'ap_payroll'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Account_Payable/Payroll/',$ap_doc);

                $data->attachment_hr               = $ap_doc;
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



