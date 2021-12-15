<?php

namespace App\Http\Livewire\Drugtest;

use Livewire\Component;
use App\Models\DrugTest as DrugTestModel;
use App\Models\DrugTestUpload;
use Livewire\WithFileUploads;
use App\Models\EmployeeProject;
use App\Models\Region;
use App\Models\SubRegion;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $employee_pic_id,$employee_id,$status_drug,$file,$title,$remark,$filter_employee_id,$region=[],$sub_region=[],$region_id,$sub_region_id;

    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        if(!check_access('drug-test.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        $data = $this->init_data();

        return view('livewire.drugtest.index')->with(['data'=>$data->paginate(100)]);
    }

    public function init_data()
    {
        $data = DrugTestModel::orderBy('id','DESC');
        if($this->filter_employee_id) $data->where('employee_id',$this->filter_employee_id);
        if($this->region_id) {
            $data->where('drug_test.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('drug_test.sub_region_id',$this->sub_region_id);

        return $data;
    }

    public function downloadExcel()
    {
        \LogActivity::add('[web] Drug Test - Download');

        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Drug Test")
                                    ->setDescription("Drug Test")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Drug Test");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'DRUG TEST');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Region')
                    ->setCellValue('C4', 'Sub Region')
                    ->setCellValue('D4', 'Employee')
                    ->setCellValue('E4', 'Title')
                    ->setCellValue('F4', 'Remark')
                    ->setCellValue('G4', 'Status')
                    ->setCellValue('H4', 'Date Submited');

        $activeSheet->getColumnDimension('A')->setWidth(5);
        $activeSheet->getColumnDimension('B')->setAutoSize(true);
        $activeSheet->getColumnDimension('C')->setAutoSize(true);
        $activeSheet->getColumnDimension('D')->setAutoSize(true);
        $activeSheet->getColumnDimension('E')->setAutoSize(true);
        $activeSheet->getColumnDimension('F')->setAutoSize(true);
        $activeSheet->getColumnDimension('G')->setAutoSize(true);
        $activeSheet->getColumnDimension('H')->setAutoSize(true);
        $num=5;

        $data = $this->init_data();
        foreach($data->get() as $k => $item){
            $status = '';
            if($item->status_drug==0) $status ='Not Submited';
            if($item->status_drug==1) $status ='Positif';
            if($item->status_drug==2) $status ='Negatif';

            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,isset($item->employee->region->region) ? $item->employee->region->region : '')
                ->setCellValue('C'.$num,isset($item->employee->sub_region->name) ? $item->employee->sub_region->name : '')
                ->setCellValue('D'.$num,isset($item->employee->name) ? $item->employee->name : '')
                ->setCellValue('E'.$num,$item->title)
                ->setCellValue('F'.$num,$item->remark)
                ->setCellValue('G'.$num,$status)
                ->setCellValue('H'.$num,$item->date_submited ? date('d-M-Y',strtotime($item->date_submited)) : '');
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Drug Test');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="drug-test-'.date('Y-m-s').'.xlsx"');
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
        },'drug-test-'.date('Y-m-s').'.xlsx');
    }

    public function mount()
    {
        \LogActivity::add('[web] Drug Test');

        $this->region  = Region::select(['id','region'])->get();
    }

    public function positif()
    {
        $this->status_drug = 2;
        $this->save();
    }

    public function negatif()
    {
        $this->status_drug = 1;
        $this->save();
    }

    public function save()
    {
        $this->validate([
            // 'employee_pic_id' => 'required',
            'employee_id' => 'required',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required'
        ]);

        $data = new DrugTestModel();
        $data->employee_pic_id = $this->employee_pic_id;
        $data->employee_id = $this->employee_id;
        $data->status_drug = $this->status_drug;
        $data->title = $this->title;
        $data->remark = $this->remark;
        $data->status = 1;
        $data->date_submited = date('Y-m-d');
        $data->sertifikat_number = "PMT/".date('dmy')."/".str_pad((DrugTestModel::count()+1),6, '0', STR_PAD_LEFT);
        $data->save();

        $data->region_id = $data->employee->region_id;
        $data->sub_region_id = $data->employee->sub_region_id;
        $project = EmployeeProject::where('employee_id',$data->employee_id)->first();
        if($project) $data->client_project_id = $project->client_project_id; 
        $data->save();

        if($this->file){
            $upload = new DrugTestUpload();
            $upload->drug_test_id = $data->id;
            $upload->save();
            $name = $upload->id .".".$this->file->extension();
            $this->file->storeAs("public/drug-test/{$data->id}", $name);
            $upload->image = "storage/drug-test/{$data->id}/{$name}";
            $upload->save();
        }
        
        $description = "Hasil : ". ($this->status_drug==1 ? 'Positif' : 'Negatif') ."\n";

        if(isset($data->employee->device_token))
            push_notification_android($data->employee->device_token,"Drug Test #".$this->title,$description,12);

        \LogActivity::add('[web] Drug Test Add');

        $this->emit('message-success','Drug Test employee Added');
        $this->emit('refresh-page');
    }
}
