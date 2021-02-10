@section('title', __('Work Flow Management'))
@section('parentPageTitle', __('Work Flow Management'))
<div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#wo-never-assigned" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wfm-internal-review">{{ __('WFM Internal Review') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="wo-never-assigned">
                    <div class="header row">
                        <div class="col-md-1">
                            <select class="form-control" wire:model="year">
                                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                                <option>{{$item->tahun}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" wire:ignore>
                            <select class="multiselect multiselect-custom multiselect_region" style="width:100%;" wire:model="month" multiple="multiple">
                                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                                @if(empty($item->region))@continue @endif
                                <option>{{$item->region}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2" wire:ignore>
                            <select class="multiselect multiselect-custom multiselect_month" style="width:100%;" wire:model="month" multiple="multiple">
                                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('MONTH(date) as month'))->groupBy('month')->get() as $item)
                                @if(empty($item->month))@continue @endif
                                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-7"
                            <label wire:loading>
                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                <span class="sr-only">{{ __('Loading...') }}</span>
                            </label>
                        </div>
                    </div>
                    @livewire("work-flow-management.{$layout_chart_parent}", key($layout_chart_parent_id))
                </div>
                <div class="tab-pane" id="wfm-internal-review">
                    <livewire:work-flow-management.wfm-internal-review />
                </div>
                <div class="tab-pane" id="data">
                    <livewire:work-flow-management.data />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    @foreach($layout_chart as $id => $layout)
    <div class="col-md-4" wire:click="set_layout('{{$layout}}',{{$id}})">
        <div class="card">
            @livewire("work-flow-management.{$layout}", key($id))
        </div>
    </div>
    @endforeach
</div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
<script>
$( document ).ready(function() {
    Livewire.emit('init-chart-accept-never-close-wo-manual');
    Livewire.emit('init-chart-assigned-never-accept-wo');
    Livewire.emit('init-chart-total-ft-never-close-manual');
});
</script>
@endpush