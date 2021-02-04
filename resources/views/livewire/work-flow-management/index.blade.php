@section('title', __('Dashboard'))
@section('parentPageTitle', __('Work Flow Management'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#wo-never-assigned" wire:click="$emit('chart')">{{ __('WO Never Assigned') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#assigned-never-accept-wo" wire:click="$emit('init-chart-assigned-never-accept-wo')">{{ __('Assigned Never Accept WO') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#accept-never-close-wo-manual" wire:click="$emit('init-chart-accept-never-close-wo-manual')">{{ __('Accept Never Close WO Manual') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#total-ft-never-close-manual" wire:click="$emit('init-chart-total-ft-never-close-manual')">{{ __('Total FT Never Close Manual') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wfm-internal-review">{{ __('WFM Internal Review') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="wo-never-assigned">
                    <livewire:work-flow-management.wo-never-assigned />
                </div>
                <div class="tab-pane" id="assigned-never-accept-wo">
                    <livewire:work-flow-management.assigned-never-accept-wo />
                </div>
                <div class="tab-pane" id="accept-never-close-wo-manual">
                    <livewire:work-flow-management.accept-never-close-wo-manual />
                </div>
                <div class="tab-pane" id="total-ft-never-close-manual">
                    <livewire:work-flow-management.total-ft-never-close-manual />
                </div>
                <div class="tab-pane" id="wfm-internal-review">
                    <livewire:work-flow-management.wfm-internal-review />
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
@endpush