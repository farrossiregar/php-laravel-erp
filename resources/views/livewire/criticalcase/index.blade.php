@section('title', __('Critical Case Data Master'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard-critical-case" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data-critical-case">{{ __('Data Critical Case') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="dashboard-critical-case">
                    <livewire:criticalcase.dashboard />
                </div>
                <div class="tab-pane" id="data-critical-case">
                    <livewire:criticalcase.data />
                </div>
            </div>
        </div>
    
        <div class="card">
            

        </div>
    </div>
</div>











