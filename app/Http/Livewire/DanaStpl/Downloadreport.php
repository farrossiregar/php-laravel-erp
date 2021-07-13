<?php

namespace App\Http\Livewire\DanaStpl;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// use Maatwebsite\Excel\Concerns\Exportable;
// use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromView;


class Downloadreport extends Component
{

    use WithFileUploads;
    public $month_from;
    public $month_to;
    public $year_from;
    public $year_to;
    

    
    public function render()
    {
        // dd(env('DB_DATABASE_EPL_PMT'));
        // $data = \App\Models\Project::select('env("DB_DATABASE_EPL_PMT").projects.*', 'region.region_code as region_name')
        //                             ->join('region', 'region.id', 'projects.region_id')
        //                             ->get();
        
        // $data = \App\Models\Project::select('projects.*', 'region_code as region_name', 'employees.name as sm_name')
        //                 ->join('epl.region as region', 'region.id', 'projects.region_id')
        //                 ->leftjoin('pmt.employees as employees', 'employees.id', 'projects.project_manager_id')
        //                 // ->where('projects.id', '24')
        //                 ->get();
                                
        // dd($data);
        
        return view('livewire.dana-stpl.downloadreport');
    }

    public function downloadreport($id)
    {
        $this->selected_id = $id;
        // $this->detaildana = \App\Models\DanaStpl::select('dana_stpl_master.*', 'region.region_code', 'employees.name')
        //                                         ->join('epl.region as region', 'region.id', 'dana_stpl_master.region_id')
        //                                         ->leftjoin('pmt.employees as employees', 'employees.id', 'dana_stpl_master.sm_id')
        //                                         ->where('dana_stpl_master.id', $this->selected_id)
        //                                         ->first();
        
    }
  
    public function download()
    {
        $download = \App\Models\DanaStpl::select('dana_stpl_master.*', DB::Raw('sum(danastpl) as jumlah'))
                                    ->where('created_at', '>=', $this->year_from.'-'.$this->month_from.'-01')
                                    ->where('created_at', '<=', $this->year_to.'-'.$this->month_to.'-31')
                                    ->where('status','3')
                                    ->groupBy(DB::Raw('month(created_at)'))
                                    ->groupBy('region_id')
                                    ->orderBy('project_id', 'desc')
                                    ->get();

        // session()->flash('message-success',"Insiden Report Berhasil diupload");
        // require 'vendor/autoload.php';


        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');


        // $filename = 'export.xlsx';
        // // here is generated a "normal" file download response of Laravel
        // return Excel::download(new CustomExcelExport(), $filename);
        // // return redirect()->route('dana-stpl.index');
        // // dd('download');

        // return Storage::disk('exports')->download('export.csv');

        // Excel::create('Filename', function($excel) {

        // })->download('xls');

        // return response()->download('export.csv');

        return (new \App\Models\DanaStplReport($download))->download('EPL.DanaStplReport.xlsx');
    }

}
