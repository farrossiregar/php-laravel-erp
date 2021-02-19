@section('title', __('Site List Tracking'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="dashboard">
                    <livewire:sitetracking.dashboard />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:sitetracking.data />
                </div>
            </div>
        </div>
    </div>
</div>