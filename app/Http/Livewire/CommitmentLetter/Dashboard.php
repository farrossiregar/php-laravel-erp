<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CommitmentLetter;
use Auth;
use DB;
use Session;


class Dashboard extends Component
{
    use WithPagination;
    public $date, $site_id, $employee_id, $keyword,$employees, $company_name, $dataproject, $project, $users;
    // public $month;
    // public $year;
    // public $labels;
    // public $datasets;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        
        // $this->generate_chart();
        // dd($_GET['company_id'], Session::get('company_id'));
        
        if(check_access('commitment-letter.admin') || check_access('commitment-letter.pic')){
            $data = CommitmentLetter::where('status', '1')->orderBy('id', 'desc')
                                ->groupBy('region');
            
            if($this->project){
                $data = @$data->where('project', \App\Models\ClientProject::where('name',"LIKE","%{$this->project}%")->first()->id);
            }
        }else{ // TE / CME
            $this->users = $users = Auth::user();
            
            $userproject = \App\Models\Employee::where('name', $users->name)->first();
            $data = CommitmentLetter::
                                    // ->where('employee_name', $users->name)
                                    where('project', $userproject->project)
                                    ->where('status', '1')
                                    // ->orderBy('id', 'desc')
                                    ->groupBy('region');
 
        }

        if(@$_GET['company_id']){
            $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                    // ->where('company_id', Session::get('company_id'))
                                    // ->where('company_id', $_GET['company_id'])
                                    ->where('is_project', '1')
                                    ->get();

        }else{
            $this->dataproject = [];    
        }
        
        
                        
        return view('livewire.commitment-letter.dashboard')->with(['data'=>$data->paginate(50)]);
        
    }

 

    // public function updated()
    // {
    //     // if($propertyName=='year') $this->month = '';
    //     $this->generate_chart();
    // }
    
    // public function generate_chart()
    // {
    //     $this->labels = [];
    //     $this->datasets = [];

    //     // $this->year = '2021';
    //     // $this->month = '07';


    //     foreach(\App\Models\AccidentReport::select('week')
    //                                         ->where(DB::Raw('year(date)'),$this->year)
    //                                         ->where(DB::Raw('month(date)'),$this->month)
    //                                         ->groupBy('week')
    //                                         ->orderBy('week', 'asc')->get() as $k => $item){
    //         $this->labels[] = 'Week '.$item->week;
    //     }

    //     foreach(\App\Models\AccidentReport::select('accident_report.*', DB::Raw('year(date) as year'), DB::Raw('month(date) as month'))
    //                                         ->where(DB::Raw('year(date)'),$this->year)
    //                                         ->where(DB::Raw('month(date)'),$this->month)
    //                                         ->groupBy('week')
    //                                         ->orderBy('week', 'asc')
    //                                         ->get() as $k => $item){
            
    //         // $colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    //         $colors = '#007bff';
    //         $this->datasets[] = [];
    //         // $this->datasets = [];
    //         // $weeks = $item
            
    //         foreach(\App\Models\AccidentReport::select(DB::Raw('count(id) as jumlah_accident'), 'week', 'klasifikasi_insiden')
    //                                             ->where(DB::Raw('year(date)'),$item->year)
    //                                             ->where(DB::Raw('month(date)'),$item->month)
    //                                             ->where('week', $item->week)
    //                                             ->groupBy('week')
    //                                             // ->groupBy('klasifikasi_insiden')
    //                                             ->get() as $l => $itemweek){
           

    //             $this->datasets[$k]['label'] = 'Weeks '.$item->week;
    //             $this->datasets[$k]['backgroundColor'] = $colors;
    //             $this->datasets[$k]['fill'] = 'boundary';
    //             $this->datasets[$k]['data'] = [];
    //             // $this->datasets[$k]['backgroundColor'][] = $colors;
    //             $this->datasets[$l]['data'][] = $itemweek->jumlah_accident;

                
    //         }
    //     }
       
       
    //     $this->labels = json_encode($this->labels);
    //     // dd($this->labels);

    //     $this->datasets = json_encode($this->datasets);
    //     // dd($this->datasets);

    //     $this->emit('init-chart-acc',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    // }


}



