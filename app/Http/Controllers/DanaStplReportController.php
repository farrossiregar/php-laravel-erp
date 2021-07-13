<?php

namespace App\Http\Controllers;

use App\Models\DanaStpl;
use DB;

class DanaStplReportController extends Controller
{
    // use Exportable;
    // protected $danastpl;
    
    // public function __construct(array $danastpl)
    // {
        
    //     $this->data = $danastpl;
    // }

    // public function view(): View
    // {
    //     return view('livewire.dana-stpl.reportdanastpl', [
    //         'data' => $this->data
    //     ]);
    // }
    public function downloadreport(DanaStpl $danastpl)
    {
        $month_from = '06';
        $month_to = '07';
        $year_from = '2020';
        $year_to = '2021';

        $jumlahtahun = $year_to - $year_from;
        
        $yeartotal = \App\Models\DanaStpl::select(DB::Raw('year(dana_stpl_master.created_at) as year'), DB::Raw('sum(cmi) as cmi'), DB::Raw('sum(h3i) as h3i'), DB::Raw('sum(isat) as isat'), DB::Raw('sum(stp) as stp'), DB::Raw('sum(xl) as xl'))
                                                ->where(DB::Raw('year(created_at)'), $year_from)
                                                ->where('status','3')
                                                ->groupBy(DB::Raw('year(created_at)'))
                                                ->get();

        // dd($yeartotal);

        $datayear = \App\Models\DanaStpl::select(DB::Raw('year(dana_stpl_master.created_at) as year'),DB::Raw('month(dana_stpl_master.created_at) as month'),)
                                        ->where('created_at', '>=', $year_from.'-'.$month_from.'-01')
                                        ->where('created_at', '<=', $year_to.'-'.$month_to.'-31')
                                        ->groupBy(DB::Raw('month(created_at)'))
                                        ->groupBy(DB::Raw('year(created_at)'))
                                        ->orderBy(DB::Raw('month(created_at)'), 'asc')
                                        ->orderBy(DB::Raw('year(created_at)'), 'asc')
                                        ->get();

        dd($datayear);

        foreach($datayear as $item){
            dd($item->month);
            $monthtotal = [];
            $monthtotal = \App\Models\DanaStpl::select(DB::Raw('year(dana_stpl_master.created_at) as year'), DB::Raw('month(dana_stpl_master.created_at) as month'), DB::Raw('sum(cmi) as cmi'), DB::Raw('sum(h3i) as h3i'), DB::Raw('sum(isat) as isat'), DB::Raw('sum(stp) as stp'), DB::Raw('sum(xl) as xl'))
                                                ->where(DB::Raw('month(created_at)'), $item->month)
                                                ->where(DB::Raw('year(created_at)'), $item->year)
                                                ->where('status','3')
                                                ->groupBy(DB::Raw('year(created_at)'))
                                                ->get();
            foreach($monthtotal as $itemmonth){
                dd($monthtotal);
            }
            
        }
        

        // dd($datayear);

        // 
        
       
        
       
        return view('livewire.dana-stpl.reportdanastpl', [
            'data' => $download
        ]);

        // $pdf = \App::make('dompdf.wrapper');

        // $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$po_tracking]);
        
        // return $pdf->stream();

        // require 'vendor/autoload.php';

        // use PhpOffice\PhpSpreadsheet\Spreadsheet;
        // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');
    }


    // public function view(): View
    // {
    //     return view('livewire.dana-stpl.reportdanastpl', [
    //         'data' => $this->data
    //     ]);
    // }
}
