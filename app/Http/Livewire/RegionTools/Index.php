<?php

namespace App\Http\Livewire\RegionTools;

use Livewire\Component;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\RegionTools;
use App\Models\Employee;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    public $keyword,$project_id,$regions,$region_id,$sub_regions=[],$file,$date_start,$date_end;
    protected $queryString = ['project_id'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $data = RegionTools::orderBy('id')->with(['region','sm','pic'])->where('employee_id',\Auth::user()->employee->id);
        
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('created_at',$this->date_start);
            else
                $data->whereBetween('created_at',[$this->date_start,$this->date_end]);
        }
        if($this->keyword) $data->where(function($table){
                                $table
                                    ->where('tools_name',"LIKE","%{$this->keyword}%")
                                    ->orWhere('serial_number',$this->keyword)
                                    ->orWhere('condition',$this->keyword)
                                    ->orWhere('brand',"LIKE","%{$this->keyword}%")
                                    ->orWhere('remark',"LIKE","%{$this->keyword}%")
                                    ->orWhere('current_position',"LIKE","%{$this->keyword}%");
                            });

        return view('livewire.region-tools.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        \LogActivity::add('[web] Region Tools');

        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        $this->project_id = session()->get('project_id');

        if($this->project_id){
            $this->regions = Region::join('client_project_region','client_project_region.region_id','=','region.id')
                                    ->select('region.id','region.region')
                                    ->where('client_project_region.client_project_id',$this->project_id)
                                    ->groupBy('region.id')
                                    ->get();
        }
    }   

    public function updated($propertyName)
    {
        if($propertyName == 'region_id') $this->sub_regions = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function delete(RegionTools $item)
    {
        $this->emit('message-success','Deleted.');
        $item->delete();
    }

    public function import()
    {
        \LogActivity::add('[web] Region Tools Import');
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
                
                $sm_id = $i[1];
                $region_id = $i[2];
                $tools = $i[3];
                $qty = $i[4];
                $brand = $i[5];
                $condition = $i[6];
                $serial_number = $i[7];
                $nik = $i[9];
                $remark = $i[10];
                $current_position = $i[11];
                $status_asset = $i[12];

                if($tools=="") continue;

                $data = new RegionTools();
                
                if($sm_id){
                    $sm = Employee::where('nik',$sm_id)->first();
                    if($sm) $data->sm_id = $sm->id;
                }
                
                $region = Region::where('region',$region_id)->first();
                if($region) $data->region__id = $region->id;
                
                $data->tools_name = $tools;
                $data->qty = $qty;
                $data->brand = $brand;
                $data->condition = $condition;
                $data->serial_number = $serial_number;
                
                if($nik){
                    $pic = Employee::where('nik',$nik)->first();
                    if($pic) $data->pic_id = $pic->id;
                }
                
                $data->remark = $remark;
                $data->current_position = $current_position;
                $data->status_asset = $status_asset;
                $data->employee_id = \Auth::user()->employee->id;
                $data->save();
            }
        }

        $this->emit('modal','hide');
        $this->emit('message-success','Upload success.');
    }
}