@section('title', __('Site List Tracking'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                @if(check_access('site-tracking.dashboard'))
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                @endif
                @if(check_access('site-tracking.data'))
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                @endif
            </ul>
            <div class="tab-content">
                @if(check_access('site-tracking.dashboard'))
                <div class="tab-pane show active" id="dashboard">
                    <livewire:sitetracking.dashboard />
                </div>
                @endif
                @if(check_access('site-tracking.data'))
                <div class="tab-pane" id="data">
                    <livewire:sitetracking.data />
                </div>
                @endif
            </div>
        </div>
    </div>
</div>