@section('title', __('PO Tracking'))
{{-- @section('parentPageTitle', 'Home') --}}
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
            {{-- <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li> --}}
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#data-po-tracking">{{ __('Data PO Tracking') }}</a></li>
            </ul>
            <div class="tab-content">
            {{-- <div class="tab-pane show active" id="dashboard">@livewire('p-o-tracking.dashboard')</div> --}}
                <div class="tab-pane show active" id="data-po-tracking">@livewire('p-o-tracking.data')</div>
            </div>
        </div>
    </div>
</div>