@section('title', __('Customer Asset Management'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wfm-internal-review">{{ __('Raw Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="dashboard">
                    <livewire:customer-asset-management.dashboard />
                </div>
                <div class="tab-pane" id="wfm-internal-review">
                    <livewire:customer-asset-management.data />
                </div>
            </div>
        </div>
    </div>
</div>