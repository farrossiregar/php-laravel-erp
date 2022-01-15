<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;


class Setlimit extends Component
{
    use WithPagination;
    public $project, $date, $year, $user_access, $claim_category;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = \App\Models\ClaimingProcessLimit::orderBy('created_at', 'desc');
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->year) $data->where('year', $this->year);                        
        if($this->claim_category) $data->where('claim_category', $this->claim_category);                        
        if($this->user_access) $data->where('user_access', $this->user_access);                                    
        
        return view('livewire.claiming-process.setlimit')->with(['data'=>$data->paginate(50)]);   
    }
}