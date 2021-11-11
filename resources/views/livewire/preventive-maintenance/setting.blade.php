<div>
    <div class="row mb-3">
        <div class="col-md-2">
            <a href="" class="btn btn-info"><i class="fa fa-plus"></i> SOW</a>
        </div>
        <div>
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table m-b-0 c_list">
            <thead>
                <tr style="background:#eee;">
                    <th>Region</th>
                    <th>Sub Region</th>   
                    <th>Site Type</th>   
                    <th>PM Type</th>   
                    <th>SOW ( Monthly Target )</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    @if(!isset($item->region->region)) @continue @endif
                    <tr>
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                        <td>{{$item->site_type}}</td>
                        <td>{{$item->pm_type}}</td>
                        <td>@livewire('preventive-maintenance.insert-sow', ['item' => $item], key($item->id))</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
