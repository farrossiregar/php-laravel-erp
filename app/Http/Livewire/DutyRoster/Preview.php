<?php

namespace App\Http\Livewire\DutyRoster;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use DB;


class Preview extends Component
{
    use WithPagination;
    public $data, $data_id;
    public $idpel_pln, $site_id, $sm, $tower_owner, $selected_id, $te, $cme;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $this->selected_id); 

        if($this->site_id) $ata = $data->where('site_id', 'like', '%' . $this->site_id . '%');
        if($this->tower_owner) $ata = $data->where('tower_owner', 'like', '%' . $this->tower_owner . '%');
        if($this->sm) $ata = $data->where('sm', 'like', '%' . $this->sm . '%');
        if($this->idpel_pln) $ata = $data->where('idpel_pln', 'like', '%' . $this->idpel_pln . '%');
        if($this->te) $ata = $data->where('te', 'like', '%' . $this->te . '%');
        if($this->cme) $ata = $data->where('cme', 'like', '%' . $this->cme . '%');

        $this->data = $data->get();
        
        return view('livewire.duty-roster.preview');

        
    }

    public function mount($id){
        
        // $this->data       = \App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $id);  
        $this->selected_id = $id;
        

        foreach(\App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', $id)->where('remarks', '1')->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
        
    }

    public function checkdata($id)
    {
        $check = \App\Models\DutyrosterSitelistDetail::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }

    public function save()
    {
        // dd("download");
        $id = $this->selected_id;
       

        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Stalavista System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Data Member")
                                    ->setDescription("Data Member")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Member");

        // $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');

        // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Project')
                    ->setCellValue('B2', 'Tower Index')
                    ->setCellValue('C2', 'Site ID')
                    ->setCellValue('D2', 'Site Name')
                    ->setCellValue('E2', 'NE System')
                    ->setCellValue('F2', 'Site Address ')
                    ->setCellValue('G2', 'Cluster')
                    ->setCellValue('H2', 'Sub Cluster')
                    ->setCellValue('I2', 'Region')
                    ->setCellValue('J2', 'Sub Region')
                    ->setCellValue('K2', 'Idpel PLN')

                    ->setCellValue('L2', 'Lat')
                    ->setCellValue('M2', 'Long ')
                    ->setCellValue('N2', 'Category Site')
                    ->setCellValue('O2', 'Depedency')
                    ->setCellValue('P2', 'PM Category')
                    ->setCellValue('Q2', 'Macro/Ibc/Mcp/Repeater')
                    ->setCellValue('R2', 'Site Type')
                    ->setCellValue('S2', 'Permanent Genset ')
                    ->setCellValue('T2', 'Tower Owner')
                    ->setCellValue('U2', 'Id TOCO')
                    ->setCellValue('V2', 'Service Manager')
                    ->setCellValue('W2', 'No HP Service Manager #1')
                    ->setCellValue('X2', 'No HP Service Manager #2')
                    ->setCellValue('Y2', 'Coordinator')
                    ->setCellValue('Z2', 'No HP Coordinator #1')
                    ->setCellValue('AA2', 'No HP Coordinator #2')
                    ->setCellValue('AB2', 'TE')
                    ->setCellValue('AC2', 'No HP TE #1')
                    ->setCellValue('AD2', 'No HP TE #2')
                    ->setCellValue('AE2', 'CME')
                    ->setCellValue('AF2', 'No HP CME #1')

                    ->setCellValue('AG2', 'No HP CME #1')
                    ->setCellValue('AH2', 'Collo Type')
                    ->setCellValue('AI2', 'Rectifikasi 1 ')
                    ->setCellValue('AJ2', 'No HP Rectifikasi 1 #1')
                    ->setCellValue('AK2', 'No HP Rectifikasi 1 #2')
                    ->setCellValue('AL2', 'Rectifikasi 2')
                    ->setCellValue('AM2', 'No HP Rectifikasi 2 #1')
                    ->setCellValue('AN2', 'No HP Rectifikasi 2 #2')
                    ->setCellValue('AO2', 'Rainy Session 1')
                    ->setCellValue('AP2', 'No HP Rainy Session 1 #1')

                    ->setCellValue('AQ2', 'No HP Rainy Session 1 #2')
                    ->setCellValue('AR2', 'Rainy Session 2')
                    ->setCellValue('AS2', 'No HP Rainy Session 2 #1')
                    ->setCellValue('AT2', 'No HP Rainy Session 2 #2')
                    ->setCellValue('AU2', 'Digger')
                    ->setCellValue('AV2', 'No HP Digger #1')
                    ->setCellValue('AW2', 'No HP Digger #2')
                    ->setCellValue('AX2', 'Waspanp')
                    ->setCellValue('AY2', 'No HP Waspang #1')
                    ->setCellValue('AZ2', 'No HP Waspang #2')

                    ->setCellValue('BA2', 'Vehicle (Car/Motorcycle)')
                    ->setCellValue('BB2', 'Splicer')
                    ->setCellValue('BC2', 'OTDR ')
                    ->setCellValue('BD2', 'OPM')
                    ->setCellValue('BE2', 'FO Cable Single 72')
                    ->setCellValue('BF2', 'FO Cable Single 36')
                    ->setCellValue('BG2', 'Cable Fig-8')
                    ->setCellValue('BH2', 'Cable 72 Ribbon')
                    ->setCellValue('BI2', 'Closure (PCS)')
                    ->setCellValue('BJ2', 'HDPE 16 (m)')

                    ->setCellValue('BK2', 'Protection Sleeve (PCS)')
                    ->setCellValue('BL2', 'Bamboo')
                    ->setCellValue('BM2', 'PO (In PO/Out PO)')
                    ->setCellValue('BN2', 'Entity')
                    ->setCellValue('BO2', 'Project Code ');
        // $objPHPExcel->setActiveSheetIndex(0)
        //             ->setCellValue('A4', 'Row Labels')
        //             ->setCellValue('B4', 'CMI')
        //             ->setCellValue('C4', 'H3I')
        //             ->setCellValue('D4', 'ISAT')
        //             ->setCellValue('E4', 'STPL')
        //             ->setCellValue('F4', 'XL')
        //             ->setCellValue('G4', 'Grand Total');
                    

        $objPHPExcel->getActiveSheet()->getStyle('A2:BO2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->getStyle('A2:BO2')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        //$objPHPExcel->getActiveSheet()->freezePane('A4');
        
        $objPHPExcel->getActiveSheet()->setAutoFilter('A2:BO2');
        $num=3;

        $data = \App\Models\DutyrosterSitelistDetail::where('id_master_dutyroster', '4')
                                        ->orderBy('id', 'asc')
                                        ->get();

        // dd($data);
        foreach($data as $k => $item){
            $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$num, $item->project)
                            ->setCellValue('B'.$num, $item->tower_index)
                            ->setCellValue('C'.$num, $item->site_id)
                            ->setCellValue('D'.$num, $item->site_name)
                            ->setCellValue('E'.$num, $item->ne_system)
                            ->setCellValue('F'.$num, $item->site_address )
                            ->setCellValue('G'.$num, $item->cluster)
                            ->setCellValue('H'.$num, $item->sub_cluster)
                            ->setCellValue('I'.$num, $item->region)
                            ->setCellValue('J'.$num, $item->sub_region)
                            ->setCellValue('K'.$num, $item->idpel_pln)

                            ->setCellValue('L'.$num, $item->lat)
                            ->setCellValue('M'.$num, $item->long )
                            ->setCellValue('N'.$num, $item->category_site)
                            ->setCellValue('O'.$num, $item->depedency)
                            ->setCellValue('P'.$num, $item->pm_category)
                            ->setCellValue('Q'.$num, $item->macro_ibc_mcp_repeater)
                            ->setCellValue('R'.$num, $item->site_type)
                            ->setCellValue('S'.$num, $item->permanent_genset )
                            ->setCellValue('T'.$num, $item->tower_owner)
                            ->setCellValue('U'.$num, $item->Id_toco)
                            ->setCellValue('V'.$num, $item->sm)
                            ->setCellValue('W'.$num, $item->sm_no1)
                            ->setCellValue('X'.$num, $item->sm_no2)
                            ->setCellValue('Y'.$num, $item->coordinator)
                            ->setCellValue('Z'.$num, $item->coordinator_no1)
                            ->setCellValue('AA'.$num, $item->coordinator_no2)
                            ->setCellValue('AB'.$num, $item->te)
                            ->setCellValue('AC'.$num, $item->te_no1)
                            ->setCellValue('AD'.$num, $item->te_no2)
                            ->setCellValue('AE'.$num, $item->cme)
                            ->setCellValue('AF'.$num, $item->cme_no1)

                            ->setCellValue('AG'.$num, $item->cme_no2)
                            ->setCellValue('AH'.$num, $item->collo_type)
                            ->setCellValue('AI'.$num, $item->rectifikasi1)
                            ->setCellValue('AJ'.$num, $item->rectifikasi1_no1)
                            ->setCellValue('AK'.$num, $item->rectifikasi1_no2)
                            ->setCellValue('AL'.$num, $item->rectifikasi2)
                            ->setCellValue('AM'.$num, $item->rectifikasi2_no1)
                            ->setCellValue('AN'.$num, $item->rectifikasi2_no2)
                            ->setCellValue('AO'.$num, $item->rainy_session1)
                            ->setCellValue('AP'.$num, $item->rainy_session1_no1)

                            ->setCellValue('AQ'.$num, $item->rainy_session1_no2)
                            ->setCellValue('AR'.$num, $item->rainy_session2)
                            ->setCellValue('AS'.$num, $item->rainy_session2_no1)
                            ->setCellValue('AT'.$num, $item->rainy_session2_no2)
                            ->setCellValue('AU'.$num, $item->digger)
                            ->setCellValue('AV'.$num, $item->digger_no1)
                            ->setCellValue('AW'.$num, $item->digger_no2)
                            ->setCellValue('AX'.$num, $item->waspan)
                            ->setCellValue('AY'.$num, $item->waspan_no1)
                            ->setCellValue('AZ'.$num, $item->waspan_no2)

                            ->setCellValue('BA'.$num, $item->vehicle)
                            ->setCellValue('BB'.$num, $item->splicer)
                            ->setCellValue('BC'.$num, $item->otdr)
                            ->setCellValue('BD'.$num, $item->opm)
                            ->setCellValue('BE'.$num, $item->fo_cable_single72)
                            ->setCellValue('BF'.$num, $item->fo_cable_single36)
                            ->setCellValue('BG'.$num, $item->cable_fig8)
                            ->setCellValue('BH'.$num, $item->cable_72ribbon)
                            ->setCellValue('BI'.$num, $item->closure)
                            ->setCellValue('BJ'.$num, $item->hdpe)

                            ->setCellValue('BK'.$num, $item->protection_sleeve)
                            ->setCellValue('BL'.$num, $item->bamboo)
                            ->setCellValue('BM'.$num, $item->po_in_out)
                            ->setCellValue('BN'.$num, $item->entity)
                            ->setCellValue('BO'.$num, $item->project_code);

                        if($item->remarks == '1'){
                            $objPHPExcel->getActiveSheet()->getStyle('AB'.$num.':AG'.$num)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcccc');
                        }
                // $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFont()->setBold( true );


                // $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('D'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('E'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('F'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('G'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                
                $num++;
        }
        

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Report-Dutyroster-Sitelist.xlsx"');
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
        },'Report-Dutyroster-Sitelist.xlsx');

    }

}



