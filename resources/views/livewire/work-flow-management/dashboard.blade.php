<div>
    <div class="header row">
        <div class="col-md-1">
            <select class="form-control" wire:model="year">
                @foreach(\App\Models\WorkFlowManagement::select(\DB::raw('YEAR(date) as tahun'))->groupBy('tahun')->get() as $item)
                <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="multiselect multiselect-custom multiselect_region" style="width:100%;" wire:model="region" multiple="multiple">
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
        <div class="col-md-7">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    @livewire("work-flow-management.{$layout_chart_parent}", key($layout_chart_parent_id))
</div>
