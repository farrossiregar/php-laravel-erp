<?php

namespace App\Http\Livewire\Monitoring;

use App\Models\MonitoringMobileApps;
use App\Models\MonitoringWebBased;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $web_based = MonitoringWebBased::get();
        $mobile_apps = MonitoringMobileApps::get();
        
        return view('livewire.monitoring.index')
        ->layout('layouts.blank')->with(['web_based'=> $web_based,'mobile_apps'=>$mobile_apps]);
    }
}
