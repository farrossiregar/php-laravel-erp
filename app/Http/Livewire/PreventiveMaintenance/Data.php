<?php

namespace App\Http\Livewire\PreventiveMaintenance;

use Livewire\Component;
use App\Models\PreventiveMaintenance as PreventiveMaintenanceModel;
use App\Models\PreventiveMaintenanceUpload;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\PreventiveMaintenancePunchlist;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Data extends Component
{
    use WithFileUploads;
    public $keyword,$site_id,$description,$due_date,$project_id,$site_report,$site_owner,$regions=[],$sub_regions=[],$employees;
    public $site_category,$site_type,$site_name,$region_id,$pm_type,$cluster,$sub_cluster,$sub_region_id,$employee_id,$file,$selected,$file_report=[],$description_report;
    public $reports=[];
    public $date_start,$date_end,$change_pic_id,$is_punch_list=false;
    protected $listeners = ['refresh-page'=>'$refresh'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = $this->init_data();

        return view('livewire.preventive-maintenance.data')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        if(isset($_GET['project_id'])) session()->put('project_id',$_GET['project_id']);
        
        $this->project_id = session()->get('project_id');
        if($this->project_id){
            $this->regions = Region::join('client_project_region','client_project_region.region_id','=','region.id')
                                    ->select('region.id','region.region')
                                    ->where('client_project_region.client_project_id',$this->project_id)
                                    ->groupBy('region.id')
                                    ->get();
        }
        
        // TE Engineer & CME Engineer
        $this->employees = EmployeeProject::select('employees.*')->where('employee_projects.client_project_id',$this->project_id)
                                        ->join('employees','employees.id','=','employee_projects.employee_id')
                                        ->whereIn('user_access_id',[85,84])
                                        ->groupBy('employees.id')
                                        ->where(function($table){
                                            if($this->region_id)  $data->where('employees.region_id',$this->region_id);
                                            if($this->sub_region_id)  $data->where('employees.sub_region_id',$this->sub_region_id);
                                            })
                                        ->get();
    }

    public function updated($propertyName)
    {
        if($propertyName == 'region_id') $this->sub_regions = SubRegion::where('region_id',$this->region_id)->get();
        // TE Engineer & CME Engineer
        $this->employees = EmployeeProject::select('employees.*')->where('employee_projects.client_project_id',$this->project_id)
                                        ->join('employees','employees.id','=','employee_projects.employee_id')
                                        ->whereIn('user_access_id',[85,84])
                                        ->groupBy('employees.id')
                                        ->where(function($table){
                                            if($this->region_id)  $table->where('employees.region_id',$this->region_id);
                                            if($this->sub_region_id)  $table->where('employees.sub_region_id',$this->sub_region_id);
                                            })
                                        ->get();
        $this->emit('set-pic');
    }

    public function upload_with_punch_list()
    {
        $this->is_punch_list = true;
        $this->upload_report();
    }

    public function updatedFileReport()
    {
        $this->validate([
            'file_report.*' => 'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image|max:51200', // 50MB Max
        ]);
    }

    public function submit_justification_complete()
    {
        $this->selected->tt_number_created = date('Y-m-d');
        $this->selected->status_punch_list_tlp = 1;
        $this->selected->save();

        $this->emit('message-success','TT Number/Laporan PLN submitted');
        $this->emit('refresh-page');

        \LogActivity::add('[web] PM Submitted TT Number');
    }

    public function submit_feat()
    {
        $this->selected->status_punch_list_tmg = 4;
        $this->selected->boq_created = date('Y-m-d');
        $this->selected->save();

        if(isset($this->selected->employee->device_token)){
            $message = "Site ID : {$this->selected->site_id}\nSite Name : {$this->selected->site_name}\n";
            $message .= "Description : {$this->selected->description}\n";
            $message .= "Site Category : {$this->selected->site_category}\n";
            $message .= "Site Type : {$this->selected->site_type}\n";
            $message .= "Region : ".(isset($this->selected->region->region) ? $this->selected->region->region : '')."\n";
            
            push_notification_android($this->selected->employee->device_token,'Punch List - Rectification Approved',$message,7);
        }

        \LogActivity::add('[web] Punch List Submit Rectification #ID:'. $this->selected->id);

        $this->emit('message-success','Rectification submitted');
        $this->emit('refresh-page');
    }

    public function  submit_boq()
    {
        $this->selected->status_punch_list_tmg = 2;
        $this->selected->boq_created = date('Y-m-d');
        $this->selected->save();

        if(isset($this->selected->employee->device_token)){
            $message = "Site ID : {$this->selected->site_id}\nSite Name : {$this->selected->site_name}\n";
            $message .= "Description : {$this->selected->description}\n";
            $message .= "Site Category : {$this->selected->site_category}\n";
            $message .= "Site Type : {$this->selected->site_type}\n";
            $message .= "Region : ".(isset($this->selected->region->region) ? $this->selected->region->region : '')."\n";
            
            push_notification_android($this->selected->employee->device_token,'Punch List - BoQ Approved by EID',$message,7);
        }

        \LogActivity::add('[web] Punch List Submit BOQ #ID:'. $this->selected->id);

        $this->emit('message-success','BOQ submitted');
        $this->emit('refresh-page');
    }

    public function delete_punch_list(PreventiveMaintenancePunchlist $data)
    {
        $data->delete();

        $this->emit('message-success','Image deleted');
        $this->selected = PreventiveMaintenanceModel::find($this->selected->id);

        \LogActivity::add('[web] Punch List deleted image');
    }

    public function submit_tt_number()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image|max:51200', // 50MB Max
            'description' => 'required'
        ]);

        $upload = new PreventiveMaintenancePunchlist();
        $upload->preventive_maintenance_id = $this->selected->id;
        $upload->save();

        if($this->file){
            $name = "tt_file_".$upload->id .".".$this->file->extension();
            $this->file->storeAs("public/preventive-maintenance/{$this->selected->id}/punch-list", $name);
            $upload->file = "storage/preventive-maintenance/{$this->selected->id}/punch-list/{$name}";
            $upload->note = $this->description;
            $upload->type = 3;
            $upload->save();
        }
        
        $this->emit('message-success','TT Number/Laporan PLN submitted');
        $this->emit('refresh-page');

        \LogActivity::add('[web] PM Submitted TT Number');
    }

    public function init_data()
    {
        $data = PreventiveMaintenanceModel::with(['employee','region','sub_region','punch_list_evidence'])->orderBy('updated_at','DESC');
        if(!check_access('preventive-maintenance.show-all-region')) $data->where('admin_project_id',\Auth::user()->employee->id);
        if($this->keyword) {
            $data->where(function($table){
                foreach(\Illuminate\Support\Facades\Schema::getColumnListing('preventive_maintenance') as $column){
                    $table->orWhere("preventive_maintenance.".$column,'LIKE',"%{$this->keyword}%");
                }
                $table->orWhereRelation('employee','name','LIKE',"%{$this->keyword}%")
                        ->orWhereRelation('employee','nik','LIKE',"%{$this->keyword}%");
            });
        }

        if($this->region_id) $data->where('region_id',$this->region_id);
        if($this->sub_region_id) $data->where('sub_region_id',$this->sub_region_id);
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('created_at',$this->date_start);
            else
                $data->whereBetween('created_at',[$this->date_start,$this->date_end]);
        }
        
        return $data;
    }

    public function submit_change_pic()
    {
        $this->validate([
            'change_pic_id' => 'required'
        ]);

        $this->selected->employee_id = $this->change_pic_id;
        $this->selected->save();
        if(isset($this->selected->employee->device_token)){
            $message = "Site ID : {$this->selected->site_id}\nSite Name : {$this->selected->site_name}\n";
            $message .= "Description : {$this->selected->description}\n";
            $message .= "Site Category : {$this->selected->site_category}\n";
            $message .= "Site Type : {$this->selected->site_type}\n";
            $message .= "PM Type : {$this->selected->pm_type}\n";
            $message .= "Region : ".(isset($this->selected->region->region) ? $this->selected->region->region : '')."\n";
            $message .= "Admin Project : ".(isset($this->selected->admin->name) ? $this->selected->admin->name : '')."\n";
            push_notification_android($this->selected->employee->device_token,'Preventive Maintenance Open',$message,7);
        }
        // insert history
        table_history('employee_id',$this->selected->id,'preventive_maintenance',$this->selected->employee);
        table_history('admin_project_id',$this->selected->id,'preventive_maintenance',\Auth::user()->employee);

        $this->reset(['change_pic_id']);
        $this->emit('message-success','Dispatch Successfully');
        $this->emit('refresh-page');

        \LogActivity::add('[web] PM Change PIC');
    }

    public function set_report(PreventiveMaintenanceModel $id,$site_owner)
    {
        $this->site_report = $id;
        $this->site_owner = $site_owner;
    }

    public function set_data(PreventiveMaintenanceModel $selected)
    {   
        $this->selected = $selected; 
        $this->reports = PreventiveMaintenanceUpload::where('preventive_maintenance',$this->selected->id)->get();
        $this->emit('set-pic');
    }

    public function pm_reject()
    {
        \LogActivity::add('[web] PM Reject Report');
        $this->validate([
            'description_report' => 'required'
        ]);

        $this->selected->note_reject = $this->description_report;
        $this->selected->is_reject = 1;
        $this->selected->status = 0;
        $this->selected->save();

        session()->flash('message-success','PM Report Rejected.');

        return redirect()->route('preventive-maintenance.index');
    }

    public function upload_report()
    {
        \LogActivity::add('[web] PM Upload Report');
        $this->validate([
            'file_report.*' => 'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image',
            'description_report' => 'required'
        ]);
        foreach($this->file_report as $file){
            $name = date('ymdhis').PreventiveMaintenanceUpload::count() .".".$file->extension();
            $data = new PreventiveMaintenanceUpload();
            $file->storeAs("public/preventive-maintenance/{$this->selected->id}", $name);
            $data->image = "storage/preventive-maintenance/{$this->selected->id}/{$name}";
            $data->description = $this->description_report;
            $data->preventive_maintenance = $this->selected->id;
            $data->save();
            if($this->selected->is_upload_report==0){
                $this->selected->is_upload_report = 1;
                $this->selected->upload_report_date = $this->selected->end_date;
                $this->selected->save();
            }
        }
        
        if($this->is_punch_list){

            if($this->selected->site_type=='TMG' and isset($this->selected->employee->device_token)){
                $message = "Site ID : {$this->selected->site_id}\nSite Name : {$this->selected->site_name}\n";
                $message .= "Description : {$this->selected->description}\n";
                $message .= "Site Category : {$this->selected->site_category}\n";
                $message .= "Site Type : {$this->selected->site_type}\n";
                $message .= "Region : ".(isset($this->selected->region->region) ? $this->selected->region->region : '')."\n";
                
                push_notification_android($this->selected->employee->device_token,'Punch List - Take Evidence',$message,7);
            }

            $this->selected->open_punch_list_created = date('Y-m-d');
            $this->selected->is_punch_list = 1;
            $this->selected->save();
        }

        session()->flash('message-success','Report Uploaded.');

        return redirect()->route('preventive-maintenance.index');
    }

    public function store()
    {
        \LogActivity::add('[web] PM Store');
        $this->validate([
            'site_id' => 'required',
            'description' => 'required'
        ]);

        $data = new PreventiveMaintenanceModel();
        $data->site_id = $this->site_id;
        $data->site_name = $this->site_name;
        $data->description  = $this->description;
        $data->site_category  = $this->site_category;
        $data->site_type  = $this->site_type;
        $data->pm_type  = $this->pm_type;
        $data->region_id  = $this->region_id;
        $data->sub_region_id  = $this->sub_region_id;
        $data->cluster  = $this->cluster;
        $data->sub_cluster  = $this->sub_cluster;
        $data->employee_id  = $this->employee_id;
        $data->admin_project_id = \Auth::user()->employee->id;
        if($this->project_id) $data->project_id = $this->project_id;
        $data->status = 0;
        $data->save();

        if(isset($data->employee->device_token)){
            $message = "Site ID : {$data->site_id}\nSite Name : {$data->site_name}\n";
            $message .= "Description : {$data->description}\n";
            $message .= "Site Category : {$data->site_category}\n";
            $message .= "Site Type : {$data->site_type}\n";
            $message .= "PM Type : {$data->pm_type}\n";
            $message .= "Region : ".(isset($data->region->region) ? $data->region->region : '')."\n";
            $message .= "Admin Project : ".(isset($data->admin->name) ? $data->admin->name : '')."\n";
            push_notification_android($data->employee->device_token,'Preventive Maintenance Open',$message,7);
        }
        // insert history
        table_history('employee_id',$data->id,'preventive_maintenance',$data->employee);
        table_history('admin_project_id',$data->id,'preventive_maintenance',\Auth::user()->employee);

        $this->reset(['site_id','description','due_date','project_id']);
        $this->emit('message-success','Preventive Maintenance Added');
        $this->emit('refresh-page');
    }

    public function import()
    {
        \LogActivity::add('[web] PM Import');
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);
        
        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key==0) continue;
                if($i[1]=="") continue;
                $site_id = $i[1];
                $site_name = $i[2];
                $description = $i[3];
                $site_category = $i[4];
                $site_type = $i[5];
                $pm_type = $i[6];
                $region = $i[7];
                $sub_region = $i[8];
                $cluster = $i[9];
                $sub_cluster = $i[10];
                $nik = $i[11];
                #$assign_date = $i[12];
                #$pickup_date = $i[13];
                #$submit_date = $i[14];
                #$status = strtolower($i[15]);
                #$note = $i[16];
                if($site_id=="" || $nik == "") continue;

                $employee = Employee::where(['nik'=>$nik])->first(); 
                if($employee){
                    $data = new PreventiveMaintenanceModel();
                    $data->site_id = $site_id;
                    $data->site_name = $site_name;
                    $data->description  = $description;
                    $data->site_category  = $site_category;
                    $data->site_type  = $site_type;
                    $data->pm_type  = $pm_type;
                    
                    // find region
                    $region_id = Region::where('region',$region)->orWhere('region_code',$region)->first();
                    if($region_id) {
                        $data->region_id  = $region_id->id;
                        $sub_region_id = SubRegion::where('region_id',$region_id->id)->where(function($table) use($sub_region){
                            $table->where('sub_region_code',$sub_region)->orWhere('name',$sub_region);
                        })->first();
                        if($sub_region_id) $data->sub_region_id = $sub_region_id->id;
                    }
                    
                    $data->cluster  = $cluster;
                    $data->sub_cluster  = $sub_cluster;
                    $data->employee_id  = $employee->id;
                    $data->admin_project_id = \Auth::user()->employee->id;
                    $data->status = 0;

                    if($this->project_id) $data->project_id = $this->project_id;

                    // if($assign_date) $data->created_at =  date('Y-m-d',strtotime($assign_date));
                    // if($pickup_date) $data->start_date =  date('Y-m-d',strtotime($pickup_date));
                    // if($submit_date) $data->end_date =  date('Y-m-d',strtotime($submit_date));
                    
                    // if($status=='open'){
                    //     $data->status = 0;
                    // }
                    // if($status=='on progress'){
                    //     $data->status = 1;
                    // }
                    // if($status=='submitted'){
                    //     $data->status = 2;
                    // }
                    // $data->note = $note;
                    // $data->save(['timestamps' => false]);
                    $data->save();

                    if(isset($data->employee->device_token)){
                        $message = "Site ID : {$data->site_id}\nSite Name : {$data->site_name}\n";
                        $message .= "Description : {$data->description}\n";
                        $message .= "Site Category : {$data->site_category}\n";
                        $message .= "Site Type : {$data->site_type}\n";
                        $message .= "PM Type : {$data->pm_type}\n";
                        $message .= "Region : ".(isset($data->region->region) ? $data->region->region : '')."\n";
                        $message .= "Admin Project : ".(isset($data->admin->name) ? $data->admin->name : '')."\n";
                        push_notification_android($data->employee->device_token,'Preventive Maintenance Open',$message,7);
                    }
                    //insert history
                    table_history('employee_id',$data->id,'preventive_maintenance',$data->employee);
                    table_history('admin_project_id',$data->id,'preventive_maintenance',\Auth::user()->employee);
                }
            }
        }

        session()->flash('message-success','Upload success.');

        return redirect()->route('preventive-maintenance.index');
    }

    public function downloadExcel()
    {
        \LogActivity::add('[web] PM Download');

        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Preventive Maintenance")
                                    ->setDescription("Preventive Maintenance")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Preventive Maintenance");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'PREVENTIVE MAINTENANCE');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:S4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Site ID')
                    ->setCellValue('C4', 'Site Name')
                    ->setCellValue('D4', 'Task Description')
                    ->setCellValue('E4', 'Site Category')
                    ->setCellValue('F4', 'Site Type')
                    ->setCellValue('G4', 'PM Type')
                    ->setCellValue('H4', 'Region')
                    ->setCellValue('I4', 'Sub Region')
                    ->setCellValue('J4', 'Cluster')
                    ->setCellValue('K4', 'Sub Cluster')
                    ->setCellValue('L4', 'NIK Karyawan')
                    ->setCellValue('M4', 'Nama Karyawan')
                    ->setCellValue('N4', 'Assign Date')
                    ->setCellValue('O4', 'Pickup Date')
                    ->setCellValue('P4', 'Submitted Date')
                    ->setCellValue('Q4', 'Status')
                    ->setCellValue('R4', 'Approved EID')
                    ->setCellValue('S4', 'Note');

        $activeSheet->getColumnDimension('A')->setWidth(5);
        $activeSheet->getColumnDimension('B')->setAutoSize(true);
        $activeSheet->getColumnDimension('C')->setAutoSize(true);
        $activeSheet->getColumnDimension('D')->setAutoSize(true);
        $activeSheet->getColumnDimension('E')->setAutoSize(true);
        $activeSheet->getColumnDimension('F')->setAutoSize(true);
        $activeSheet->getColumnDimension('G')->setAutoSize(true);
        $activeSheet->getColumnDimension('H')->setAutoSize(true);
        $activeSheet->getColumnDimension('I')->setAutoSize(true);
        $activeSheet->getColumnDimension('J')->setAutoSize(true);
        $activeSheet->getColumnDimension('K')->setAutoSize(true);
        $activeSheet->getColumnDimension('L')->setAutoSize(true);
        $activeSheet->getColumnDimension('M')->setAutoSize(true);
        $activeSheet->getColumnDimension('N')->setAutoSize(true);
        $activeSheet->getColumnDimension('O')->setAutoSize(true);
        $activeSheet->getColumnDimension('Q')->setAutoSize(true);
        $activeSheet->getColumnDimension('R')->setAutoSize(true);
        $activeSheet->getColumnDimension('S')->setAutoSize(true);
        $num=5;

        $data = $this->init_data();
        foreach($data->get() as $k => $i){
            $status = '';
            if($i->status==0) $status ='Open';
            if($i->status==1) $status ='On Progress';
            if($i->status==2) $status ='Submitted';
            if($i->is_upload_report==1) $status = 'Approved EID';

            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,$i->site_id)
                ->setCellValue('C'.$num,$i->site_name)
                ->setCellValue('D'.$num,$i->description)
                ->setCellValue('E'.$num,$i->site_category)
                ->setCellValue('F'.$num,$i->site_type)
                ->setCellValue('G'.$num,$i->pm_type)
                ->setCellValue('H'.$num,isset($i->region->region) ? $i->region->region : '-')
                ->setCellValue('I'.$num,isset($i->sub_region->name) ? $i->sub_region->name : '-')
                ->setCellValue('J'.$num,$i->cluster)
                ->setCellValue('K'.$num,$i->sub_cluster)
                ->setCellValue('L'.$num,isset($i->employee->nik) ? $i->employee->nik : '')
                ->setCellValue('M'.$num,isset($i->employee->name) ? $i->employee->name : '')
                ->setCellValue('N'.$num,isset($i->created_at) ? date('d-M-Y',strtotime($i->created_at)) : '-')
                ->setCellValue('O'.$num,isset($i->start_date) ? date('d-M-Y',strtotime($i->start_date)) : '-')
                ->setCellValue('P'.$num,isset($i->end_date) ? date('d-M-Y',strtotime($i->end_date)) : '-')
                ->setCellValue('Q'.$num,$status)
                ->setCellValue('R'.$num,($i->is_upload_report==1 ? 'Approved EID' : '-'))
                ->setCellValue('S'.$num,$i->note);
            
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Preventive Maintenance');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="preventive-maintenance.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        //header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        return response()->streamDownload(function() use($writer){
            $writer->save('php://output');
        },'preventive-maintenance.xlsx');
    }
}