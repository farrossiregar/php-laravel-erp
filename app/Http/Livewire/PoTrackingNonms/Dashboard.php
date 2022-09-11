<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsPo;
use \Carbon\Carbon;

class Dashboard extends Component
{
    public $waiting_pr_submission=0,$pmg_review=0,$finance_in_review=0,$budget_transfered=0,$pending_assign=0;
    public $on_going=0,$field_team_submitted=0,$bast_regional=0,$bast_e2e=0,$finance_to_invoice=0,$invoiced=0;
    public $days_30=0,$days_3055=0,$days_55120=0,$days_120180=0,$days_180360=0,$days_360=0;
    public function render()
    {
        return view('livewire.po-tracking-nonms.dashboard');
    }

    public function mount()
    {
        $temp = PoTrackingNonms::where(function($table){$table->where('status',0)->orWhereNull('status');})->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->waiting_pr_submission += $item->boq_sum_total_price;   
        
        $temp = PoTrackingNonms::where('status',3)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->pmg_review += $item->boq_sum_total_price;

        $temp = PoTrackingNonms::where('status',1)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->finance_in_review += $item->boq_sum_total_price;

        $temp = PoTrackingNonms::where('status',5)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->budget_transfered += $item->boq_sum_total_price;

        $temp = PoTrackingNonms::where('status',6)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->pending_assign += $item->boq_sum_total_price;

        $temp = PoTrackingNonms::where('status',7)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->on_going += $item->boq_sum_total_price;

        $temp = PoTrackingNonms::where('status',8)->withSum('boq','total_price')->get();
        foreach($temp as $item) $this->field_team_submitted += $item->boq_sum_total_price;

        $this->bast_regional = PoTrackingNonmsPo::where('status',0)->sum('payment_amount');
        $this->bast_e2e = PoTrackingNonmsPo::where('status',1)->sum('payment_amount');
        $this->finance_to_invoice = PoTrackingNonmsPo::where('status',3)->sum('payment_amount');
        $this->invoiced = PoTrackingNonmsPo::where('status',5)->sum('payment_amount');

        $from=Carbon::now()->subDays(30)->toDateString();
        $current=Carbon::now()->toDateString();
        $this->days_30= PoTrackingNonms::whereBetween('created_at',array($from,$current))->count();

        $from=Carbon::now()->subDays(55)->toDateString();
        $current=Carbon::now()->subDays(30)->toDateString();
        $this->days_3055 = PoTrackingNonms::whereBetween('created_at',array($from,$current))->count();

        $from=Carbon::now()->subDays(120)->toDateString();
        $current=Carbon::now()->subDays(55)->toDateString();
        $this->days_55120 = PoTrackingNonms::whereBetween('created_at',array($from,$current))->count();

        $from=Carbon::now()->subDays(180)->toDateString();
        $current=Carbon::now()->subDays(120)->toDateString();
        $this->days_120180 = PoTrackingNonms::whereBetween('created_at',array($from,$current))->count();

        $from=Carbon::now()->subDays(360)->toDateString();
        $current=Carbon::now()->subDays(180)->toDateString();
        $this->days_180360 = PoTrackingNonms::whereBetween('created_at',array($from,$current))->count();

        $current=Carbon::now()->subDays(360)->toDateString();
        $this->days_360 = PoTrackingNonms::whereDate('created_at','>',$current)->count();
    }
}
