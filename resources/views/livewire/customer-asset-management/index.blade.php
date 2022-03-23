@section('title', __('Customer Asset Management'))
<div class="row clearfix">
    @push('after-scripts')
        <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
        <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    @endpush
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wfm-internal-review">{{ __('Data') }}</a></li>
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