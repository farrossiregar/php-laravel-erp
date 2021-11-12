<div>
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
