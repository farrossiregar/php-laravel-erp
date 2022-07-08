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
use DateTime;

class Add extends Component
{
    use WithFileUploads;
    public $request_type, $subrequest_type, $file, $doc_name,$cash_transaction_no,$items=[],$item_description=[],$item_amount=[],$total=0;
    public $budget=0,$remain=0,$project_code,$project_name,$week;
    public function render()
    {
        $project_arr = [];
        foreach(\Auth::user()->employee->employee_project as  $k => $i) $project_arr[] = $i->client_project_id;

        if($this->request_type == '1') $budget = PettyCashBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>\Auth::user()->employee->department_id])->first();   
        if($this->request_type == '2') $budget = WeeklyOpexBudget::where(['company_id'=>session()->get('company_id'),'week'=>$this->weekOfMonth(date('Y-m-d')), 'region'=>\Auth::user()->employee->region_id])->whereIn('project',$project_arr)->first();
      
        if($this->request_type){
            if(isset($budget)){
                $this->budget = $budget->amount;
                $this->remain - $budget->remain;
                $this->week = $budget->week;
            }    
        }else{
            $this->budget = 0;
            $this->remain = 0;
        }

        return view('livewire.account-payable.add');
    }

    public function mount()
    {
        // if($this->request_type == '1'){
        //     $budget = PettyCashBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>\Auth::user()->employee->department_id])->first();
        // }
        
        // if($this->request_type == '2'){
        //     $budget = WeeklyOpexBudget::where(['company_id'=>session()->get('company_id'),'department_id'=>\Auth::user()->employee->department_id])->first();
        // }
      
        // if($this->request_type){
            
        //     if($budget){
        //         $this->budget = $budget->amount;
        //         $this->remain - $budget->remain;
        //     }    
        // }else{
        //     $this->budget = 0;
        //     $this->remain = 0;
        // }
        
        
        // $project = EmployeeProject::where('employee_id',\Auth::user()->employee->id)->first();
        // if(isset($project->project->name)) {
        //     $this->project_name = $project->project->name;
        //     $this->project_code = $project->project->code;
        // }

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
            $data->status = 4; // waiting approval PMG
            $data->save();

            $prev_data = AccountPayableWeeklyopex::orderBy('id', 'desc')->first();

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
            $weekly_opex->week                      = $this->week;
            $weekly_opex->company_id                = session()->get('company_id');
            $weekly_opex->status                    = 0; // Waiting AP Staff
            $weekly_opex->total_settlement          = $this->total;
            $weekly_opex->previous_balance          = isset($prev_data) ? $prev_data->budget_opex - $prev_data->total_transfer : 0;
            $weekly_opex->total_transfer           = $this->total;
            $weekly_opex->transfer_date            = date('Y-m-d');
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

        session()->flash('message-success',"Request Account Payable Berhasil diinput");
        
        return redirect()->route('account-payable.index');
    }

    public function weekOfMonth($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
}