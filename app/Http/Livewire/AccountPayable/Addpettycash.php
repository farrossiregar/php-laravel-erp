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
use App\Models\EmployeeProject;

class Addpettycash extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $department, $month, $year, $advance_req_no, $advance_nominal, $advance_date, $settlement_date, $settlement_nominal, $total_settlement, $cash_transaction_no;
    public $description, $difference, $account_no_recorded, $account_name_recorded, $nominal_recorded, $file, $doc_settlement;
    public $description1, $description2, $description3, $description4, $description5;

    public $project, $client_project_id, $region, $employee_name, $date, $position, $request_type, $subrequest_type, $doc_name;

    public function render()
    {
        // $reqnum                                 = '003';

        $this->employee_name                    = isset(Auth::user()->employee->name)?Auth::user()->employee->name : '-';
        // $this->project                          = isset(Auth::user()->employee->region->region)?Auth::user()->employee->region->region : '-';
        $this->position                         = isset(Auth::user()->employee->access->name)?Auth::user()->employee->access->name : '-';
        $this->department                       = isset(Auth::user()->employee->department->name)?Auth::user()->employee->department->name : '-';
        $this->advance_req_no                   = $this->department.'/'.date('Ym').'/'.$this->getNextId();
        $this->cash_transaction_no              = $this->getNextId().'/'.date('d').'/'.date('m').'/'.date('Y').'/CashOut';


        $projects = EmployeeProject::select('client_projects.*')
                                        ->join('employees','employees.id','=','employee_projects.employee_id')
                                        ->join('client_projects','client_projects.id','=','employee_projects.client_project_id')
                                        ->where('employees.id',\Auth::user()->employee->id)
                                        ->get();
        foreach($projects as $item){
            $this->project .= $item->name ."";
        }

        $this->project .= isset(\Auth::user()->employee->region->region) ? " / ".\Auth::user()->employee->region->region : '-';

        // if($this->department){
        //     $this->advance_req_no               = \App\Models\Department::where('id', $this->department)->first()->name.'/'.date('Ym').'/'.$reqnum;
        // }else{
        //     $this->advance_req_no               = '';
        // }
        return view('livewire.account-payable.addpettycash');
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $datamaster                           = new \App\Models\AccountPayable();
        $datamaster->project                  = $this->project;
        $datamaster->region                   = $this->region;
        $datamaster->name                     = $this->employee_name;
        $datamaster->nik                      = $user->nik;
        $datamaster->position                 = $user->user_access_id;
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $ap_doc = 'ap_doc'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Account_Payable/',$ap_doc);

            $datamaster->additional_doc               = $ap_doc;
            $datamaster->doc_name                     = $this->doc_name;
        }
        
        $datamaster->department                       = $this->department;
        $datamaster->request_type                     = $this->request_type;
        $datamaster->subrequest_type                  = $this->subrequest_type;
        $datamaster->update_req                       = '1';
        $datamaster->save();



        
        $data                           = new \App\Models\AccountPayablePettycash();
        $data->id_master                = $datamaster->id;
        $data->department               = $this->department;
        $data->advance_req_no           = $this->advance_req_no;
        $data->month                    = $this->month;
        $data->year                     = $this->year;
        $data->week                     = $this->advance_req_no;
        $data->advance_nominal          = $this->advance_nominal;
        $data->advance_date             = date('Y-m-d');
        $data->cash_transaction_no      = $this->cash_transaction_no;
       
        $data->account_no_recorded      = $this->account_no_recorded;
        $data->account_name_recorded    = $this->account_name_recorded;
        $data->nominal_recorded         = $this->nominal_recorded;
        
        
       
        // if(!@\App\Models\AccountPayablePettycash::where('id_master', $this->selected_id)->first()->doc_settlement){
            $this->validate([
                'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            ]);

            // if($this->file){
                $ap_doc = 'ap_pettycash'.$this->selected_id.'.'.$this->file->extension();
                $this->file->storePubliclyAs('public/Account_Payable/Petty_Cash/',$ap_doc);

                $data->doc_settlement               = $ap_doc;
            // }
        // }
        
        $data->save();

        if(@$this->description1){
            $detaildata                           = new \App\Models\AdvanceSettlementAP();
            $detaildata->id_master                = $datamaster->id;
            $detaildata->description              = @$this->description1;
            $detaildata->save();
        }

        if(@$this->description2){
            $detaildata                           = new \App\Models\AdvanceSettlementAP();
            $detaildata->id_master                = $datamaster->id;
            $detaildata->description              = @$this->description2;
            $detaildata->save();
        }

        if(@$this->description3){
            $detaildata                           = new \App\Models\AdvanceSettlementAP();
            $detaildata->id_master                = $datamaster->id;
            $detaildata->description              = @$this->description3;
            $detaildata->save();
        }

        if(@$this->description4){
            $detaildata                           = new \App\Models\AdvanceSettlementAP();
            $detaildata->id_master                = $datamaster->id;
            $detaildata->description              = @$this->description4;
            $detaildata->save();
        }

        if(@$this->description5){
            $detaildata                           = new \App\Models\AdvanceSettlementAP();
            $detaildata->id_master                = $datamaster->id;
            $detaildata->description              = @$this->description5;
            $detaildata->save();
        }

        // $datamaster                           = \App\Models\AccountPayable::where('id', $this->selected_id)->first();
        // $datamaster->update_req               = '1';
        // $datamaster->save();

        

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Petty Cash Berhasil diinput");
        
        return redirect()->route('finance-petty-cash.index');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'account_payable_pettycash'");
        return $statement[0]->Auto_increment;
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



