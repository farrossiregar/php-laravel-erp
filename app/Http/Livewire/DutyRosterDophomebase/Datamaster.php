<?php
namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DophomebaseMaster;

class Datamaster extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $date, $data_id, $nama_dop, $region, $project,$selected_id,$file;
    public $is_audit=false,$is_approval=false,$is_upload_image=false;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = DophomebaseMaster::orderBy('created_at', 'desc');        
        if($this->nama_dop) $ata = $data->where('nama_dop', 'like', '%' . $this->nama_dop . '%');
        if($this->project) $ata = $data->where('project', 'like', '%' . $this->project . '%');
        if($this->region) $ata = $data->where('region', 'like', '%' . $this->region . '%');

        foreach(DophomebaseMaster::where('remarks', '1')->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
        
        return view('livewire.duty-roster-dophomebase.datamaster')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $this->is_audit = check_access('duty-roster-dophomebase.audit');
        $this->is_approval = check_access('duty-roster-dophomebase.approval');
        $this->is_upload_image = check_access('duty-roster-dophomebase.upload-image');
        $this->is_upload_dop = check_access('duty-roster-dophomebase.importsm');
    }

    public function set_selected_id(DophomebaseMaster $selected_id)
    {
        $this->selected_id = $selected_id;
    }

    public function upload_dop()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls,doc,docx,pdf,image',
        ]);

        $name = date('ymdhis').DophomebaseMaster::count() .".".$this->file->extension();
        $this->file->storeAs("public/home-base/{$this->selected_id->id}", $name);
        $this->selected_id->dop_file = "storage/home-base/{$this->selected_id->id}/{$name}";
        $this->selected_id->save();
    }

    public function checkdata($id)
    {
        $check = \App\Models\DophomebaseMaster::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save    ();
    }

    public function save()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Stalavista System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Data Member")
                                    ->setDescription("Data Member")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Member");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Nama DOP')
                    ->setCellValue('B2', 'Project')
                    ->setCellValue('C2', 'Region')
                    ->setCellValue('D2', 'Alamat DOP')
                    ->setCellValue('E2', 'Latitude')
                    ->setCellValue('F2', 'Longitude')
                    ->setCellValue('G2', 'Nama Pemilik DOP')
                    ->setCellValue('H2', 'Nomor Telepon Pemilik DOP')
                    ->setCellValue('I2', 'Opex Region/GA')
                    ->setCellValue('J2', 'Type Homebase/DOP')
                    ->setCellValue('K2', 'Expired')
                    ->setCellValue('L2', 'Budget');

        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);        
        $objPHPExcel->getActiveSheet()->setAutoFilter('A2:L2');
        $num=3;

        $data = \App\Models\DophomebaseMaster::orderBy('id', 'asc')->get();
        foreach($data as $k => $item){
            $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$num, $item->nama_dop)
                            ->setCellValue('B'.$num, $item->project)
                            ->setCellValue('C'.$num, $item->region)
                            ->setCellValue('D'.$num, $item->alamat)
                            ->setCellValue('E'.$num, $item->long)
                            ->setCellValue('F'.$num, $item->lat)
                            ->setCellValue('G'.$num, $item->pemilik_dop)
                            ->setCellValue('H'.$num, $item->telepon_pemilik)
                            ->setCellValue('I'.$num, $item->opex_region_ga)
                            ->setCellValue('J'.$num, $item->type_homebase_dop)
                            ->setCellValue('K'.$num, $item->expired)
                            ->setCellValue('L'.$num, $item->budget);

                        if($item->remarks == '1'){
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':L'.$num)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcccc');
                        }
                $num++;
        }
        

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Report-Dutyroster-Dophomebase-Master.xlsx"');
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
        },'Report-Dutyroster-Dophomebase-Master.xlsx');
    }
}