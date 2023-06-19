<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\CommitmentDaily as ModelsCommitmentDaily;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\ClientProjectRegion;
class CommitmentDaily extends Component
{
    public $keyword,$date_start,$date_end,$user_access_id,$region=[],$sub_region=[],$region_id,$sub_region_id;
    public $selected_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = $this->init_data();

        return view('livewire.mobile-apps.commitment-daily')->with(['data'=>$data->paginate(100)]);
    }
    
    public function clear_filter()
    {
        $this->reset(['keyword','date_start','date_end','user_access_id','region_id','sub_region_id']);
        $this->emit('clear_daterange');
    }
    
    public function init_data()
    {
        \LogActivity::add('[web] Performance KPI DC');
        $data = ModelsCommitmentDaily::with(['employee','employee.access','region','sub_region'])
                                ->select('employees.name','commitment_dailys.*')
                                ->orderBy('commitment_dailys.is_submit','DESC')
                                ->orderBy('commitment_dailys.updated_at','DESC')
                                ->join('employees','employees.id','=','employee_id');

        if($this->keyword) $data->where(function($table){
                                $table->where('employees.name',"LIKE", "%{$this->keyword}%")
                                    ->orWhere('employees.nik',$this->keyword);
                            });
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('commitment_dailys.created_at',$this->date_start);
            else
                $data->whereBetween('commitment_dailys.created_at',[$this->date_start,$this->date_end]);
        } 
        if($this->user_access_id) $data->where('employees.user_access_id',$this->user_access_id);
        if($this->region_id) {
            $data->where('commitment_dailys.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('commitment_dailys.sub_region_id',$this->sub_region_id);

        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('commitment_dailys.client_project_id',$client_project_ids);

        return $data;
    }
    
    public function set_id(ModelsCommitmentDaily $data)
    {
        $this->selected_id = $data;
    }

    public function updated($propertyName)
    {
        if($this->region_id) $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function delete()
    {
        if($this->selected_id){
            $this->selected_id->delete();;
        }

        $this->reset(['selected_id']);
        $this->emit('message-success','Data berhasil di hapus');
        $this->emit('refresh-page');
    }

    public function mount()
    {
        \LogActivity::add('[web] Performance KPI Commitment Daily');
        $this->region = ClientProjectRegion::select('region.*')
                                                ->where('client_project_id',session()->get('project_id'))
                                                ->join('region','region.id','client_project_region.region_id')
                                                ->groupBy('region.id')
                                                ->get();
    }

    public function downloadExcel()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Commitment Daily")
                                    ->setDescription("Commitment Daily")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Commitment Daily");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'COMMITMENT DAILY');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:O4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'NIK')
                    ->setCellValue('C4', 'Employee')
                    ->setCellValue('D4', 'Jobe Role/Access')
                    ->setCellValue('E4', 'Berkomitment Menggunakan PPE/APD')
                    ->setCellValue('F4', 'Bagian PPE/APD yang tidak punya')
                    ->setCellValue('G4', 'Regulasi sanksi dari management')
                    ->setCellValue('H4', 'Regulasi terhadap kecurian')
                    ->setCellValue('I4', 'Regulasi terhadap kerusakan nama baik perusahaan')
                    ->setCellValue('J4', 'Regulasi terkait minuman keras/obat terlarang')
                    ->setCellValue('K4', 'Regulasi terkait pelanggaran peraturan perusahaan')
                    ->setCellValue('L4', 'Regulasi terkait protokol kesehatan')
                    ->setCellValue('M4', 'Regulasi terkait penggunaan kendaraan')
                    ->setCellValue('N4', 'Regulasi BCG')
                    ->setCellValue('O4', 'Regulasi terkait cyber security')
                    ->setCellValue('P4', 'Date');

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
        $activeSheet->getColumnDimension('P')->setAutoSize(true);
        $num=5;

        $data = $this->init_data();
        foreach($data->get() as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,isset($i->employee->nik) ? $i->employee->nik : '-')
                ->setCellValue('C'.$num,$i->name)
                ->setCellValue('D'.$num,isset($i->employee->access->name) ? $i->employee->access->name : '');

            if($i->is_submit ==1){
                $activeSheet->setCellValue('E'.$num,$i->regulasi_terkait_ppe_apd_menggunakan==1 ? "Yes" : "No")
                            ->setCellValue('F'.$num,$i->regulasi_terkait_ppe_apd_tidak_punya)
                            ->setCellValue('G'.$num,$i->regulasi_terkait_sanksi==1 ? "Yes" : "No")
                            ->setCellValue('H'.$num,$i->regulasi_terhadap_kecurian==1 ? "Yes" : "No")
                            ->setCellValue('I'.$num,$i->regulasi_terhadap_kerusakan_nama_baik_perusahaan==1 ? "Yes" : "No")
                            ->setCellValue('J'.$num,$i->regulasi_terkait_minuman_keras_obat_terlarang==1 ? "Yes" : "No")
                            ->setCellValue('K'.$num,$i->regulasi_terkait_pelanggaran_peraturan_perusahaan==1 ? "Yes" : "No")
                            ->setCellValue('L'.$num,$i->regulasi_terkait_protokol_kesehatan==1 ? "Yes" : "No")
                            ->setCellValue('M'.$num,$i->regulasi_terkait_penggunaan_kendaraan==1 ? "Yes" : "No")
                            ->setCellValue('N'.$num,$i->regulasi_bcg==1 ? "Yes" : "No")
                            ->setCellValue('O'.$num,$i->regulasi_terkait_cyber_security==1 ? "Yes" : "No")
                            ->setCellValue('P'.$num,date('d-M-Y H:i',strtotime($i->updated_at)));
            }else{
                $activeSheet->setCellValue('D'.$num,"-")
                            ->setCellValue('E'.$num,"-")
                            ->setCellValue('F'.$num,"-")
                            ->setCellValue('G'.$num,"-")
                            ->setCellValue('H'.$num,"-")
                            ->setCellValue('I'.$num,"-")
                            ->setCellValue('J'.$num,"-")
                            ->setCellValue('K'.$num,"-")
                            ->setCellValue('L'.$num,"-")
                            ->setCellValue('M'.$num,"-")
                            ->setCellValue('N'.$num,"-")
                            ->setCellValue('O'.$num,"-")
                            ->setCellValue('P'.$num,"-");
            }
            
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Commitment Daily');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="commitment-daily.xlsx"');
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
        },'commitment-daily.xlsx');
    }
}