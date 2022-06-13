<?php

namespace App\Http\Livewire\AccountPayable;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use App\Models\AccountPayablePettycash;
use App\Models\AccountPayable;
use App\Models\PettyCashItem;
use App\Models\PettyCashBudget;
use App\Models\AccountPayableWeeklyopex;
use App\Models\EmployeeProject;
use App\Models\WeeklyOpexItem;
use App\Models\WeeklyOpexBudget;

class Add extends Component
{
    use WithFileUploads;
    public $request_type, $subrequest_type, $file, $doc_name,$cash_transaction_no,$items=[],$item_description=[],$item_amount=[],$total=0;
    public $budget=0,$remain=0,$project_code,$project_name;
    public function render()
    {
        
        return view('livewire.account-payable.add');
    }

    public function mount()
    {
        $budget = PettyCashBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>\Auth::user()->employee->department_id])->first();
      
        if($budget){
            $this->budget = $budget->amount;
            $this->remain - $budget->remain;
        }
        
        $project = EmployeeProject::where('employee_id',\Auth::user()->employee->id)->first();
        if(isset($project->project->name)) {
            $this->project_name = $project->project->name;
            $this->project_code = $project->project->code;
        }

        $this->cash_transaction_no = str_pad((AccountPayable::count()+1),6, '0', STR_PAD_LEFT).'/'.date('d').'/'.date('m').'/'.date('Y').'/CashOut';
    }

    public function updated($propertyName)
    {
        $this->total=0;
        foreach($this->item_amount as $val) if(is_numeric($val)) $this->total += $val;
    }
    
    public function add_item()
    {
        $this->items[] = '';$this->item_description[] = '';$this->item_amount[] = '';
    }

    public function delete_item($k)
    {
        unset($this->items[$k],$this->item_description[$k],$this->item_amount[$k]);
    }

    public function save()
    {
        $this->validate([
            'request_type' => 'required',
            'subrequest_type' => 'required',
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        $data                           = new AccountPayable();
        $data->cash_transaction_no = $this->cash_transaction_no;
        $data->region                   = isset(\Auth::user()->employee->region->region) ? \Auth::user()->employee->region->region : '-';
        $data->name                     = \Auth::user()->employee->name;
        $data->nik                      = \Auth::user()->employee->nik;
        $data->position = \Auth::user()->employee->access->name;
        $data->department = isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '';;
        $data->request_type                     = $this->request_type;
        $data->subrequest_type                  = $this->subrequest_type;
        $data->employee_id = \Auth::user()->employee->id;
        $data->status = 0;
        $data->save();
        
        if($this->file){
            $ap_doc = 'ap_doc'.date('Ymd').'.'.$this->file->extension();
            $this->file->storeAs("public/account-payable/{$data->id}", $ap_doc);
            $data->additional_doc               = "storage/account-payable/{$data->id}/".$ap_doc;
            $data->doc_name                     = $this->doc_name;
        }
        $data->save();

        // Petty Cash
        if($this->request_type==1){
            $petty_cash = new AccountPayablePettycash();
            $petty_cash->budget = $this->budget;
            $petty_cash->remain = $this->budget - $this->total;
            $petty_cash->employee_id = \Auth::user()->employee->id;
            $petty_cash->cash_transaction_no = $this->cash_transaction_no;
            $petty_cash->advance_nominal = $this->total;
            $petty_cash->advance_date = date('Y-m-d');
            $petty_cash->id_master = $data->id;
            $petty_cash->department = isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '';
            $petty_cash->advance_req_no = (isset(\Auth::user()->employee->department->name) ? \Auth::user()->employee->department->name : '').'/'.date('ym').'/'.(AccountPayablePettycash::count()+1);
            $petty_cash->month = date('M');
            $petty_cash->year = date('Y');
            $petty_cash->company_id = session()->get('company_id');
            $petty_cash->status=0; // Waiting AP Staff
            $petty_cash->total_settlement         = $this->total;
            $petty_cash->save();

            if($this->items){
                foreach($this->items as $k => $val){
                    $item = new PettyCashItem;
                    $item->petty_cash_id = $petty_cash->id;
                    $item->amount = $this->item_amount[$k];
                    $item->description = $this->item_description[$k];
                    $item->save();
                }
            }
        }

        // Weekly Opex
        if($this->request_type==2){
           
            $weekly_opex = new AccountPayableWeeklyopex();
            $weekly_opex->budget_opex               = $this->budget;//$this->budget_opex;
            $weekly_opex->employee_id               = \Auth::user()->employee->id;
            $weekly_opex->id_master                 = $data->id;
            $weekly_opex->region                    = isset(\Auth::user()->employee->region->region) ? \Auth::user()->employee->region->region : '-';
            $weekly_opex->subregion                 = isset(\Auth::user()->employee->subregion->name) ? \Auth::user()->employee->subregion->name : '-';

            $weekly_opex->project_code              = isset(\Auth::user()->employee->employee_project->client_project_id) ? \App\Models\ClientProject::where('id', \Auth::user()->employee->employee_project->client_project_id)->id : '';
            $weekly_opex->project_name              = isset(\Auth::user()->employee->employee_project->client_project_id) ? \App\Models\ClientProject::where('id', \Auth::user()->employee->employee_project->client_project_id)->name : '';
            $weekly_opex->cash_transaction_no       = $this->cash_transaction_no;
            $weekly_opex->month                     = date('M');//$this->month;
            $weekly_opex->year                      = date('Y');//$this->year;
            $weekly_opex->week                      = '';
            
            // $weekly_opex->company_id                = session()->get('company_id');
            // $weekly_opex->status                    = 0; // Waiting AP Staff
            $weekly_opex->total_settlement          = $this->total;
            // $weekly_opex->previous_balance         = $this->previous_balance;
            $weekly_opex->total_transfer           = $this->total;
            // $weekly_opex->total_transfer           = $this->total_transfer;
            // $weekly_opex->transfer_date            = $this->transfer_date;
            
            // $weekly_opex->settlement_date          = $this->settlement_date;
            // $weekly_opex->settlement_nominal       = $this->settlement_nominal;
            // $weekly_opex->total_settlement         = $this->total_settlement;


            // $weekly_opex->admin_to_team            = $this->admin_to_team;
            // $weekly_opex->difference_admin_team    = $this->difference_admin_team;
            // $weekly_opex->difference_hq_admin      = $this->difference_hq_admin;
            // $weekly_opex->account_no_recorded      = $this->account_no_recorded;
            // $weekly_opex->account_name_recorded    = $this->account_name_recorded;
            // $weekly_opex->nominal_recorded         = $this->nominal_recorded;
            
            // if(!@\App\Models\AccountPayableWeeklyopex::where('id_master', $this->selected_id)->first()->doc_settlement){
            //     $this->validate([
            //         'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
            //     ]);
            // }

            // if($this->file){
            //     $ap_doc = 'ap_weeklyopex'.$this->selected_id.'.'.$this->file->extension();
            //     $this->file->storePubliclyAs('public/Account_Payable/Weekly_Opex/',$ap_doc);

            //     $data->doc_settlement               = $ap_doc;
            // }
            
            
        
            // $data->save();
            $weekly_opex->save();

            if($this->items){
                foreach($this->items as $k => $val){
                    $item = new WeeklyOpexItem;
                    $item->weekly_opex_id = $weekly_opex->id;
                    $item->amount = $this->item_amount[$k];
                    $item->description = $this->item_description[$k];
                    $item->save();
                }
            }
        }

        $budget = PettyCashBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>\Auth::user()->employee->department_id])->first();
        if($budget){
            // $budget->amount = $budget->amount - $this->total;
            // $budget->remain = $budget->remain + $this->total;
            $budget->save();
        }   

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
}