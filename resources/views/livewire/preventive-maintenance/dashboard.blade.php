<div class="table-responsive">
    <table class="table m-b-0 c_list">
        <thead>
            <tr style="background:#eee;">
                <th rowspan="2">Region</th>
                <th rowspan="2">Sub Region</th>   
                <th rowspan="2">Site Type</th>   
                <th rowspan="2">PM Type</th>   
                <th rowspan="2">SOW ( Monthly Target )</th>
                <th rowspan="2">Daily Target</th>
                <th colspan="3">Daily Regional Update ( As Per On That Day )</th>
                <th rowspan="2" class="text-center">Daily Achievement %</th>
                <th rowspan="2" class="text-center">Monthly Achievement %</th>
            </tr>
            <tr style="background:#eee;" class="text-center">
                <th>Open</th>
                <th>In Progress</th>
                <th>Submitted</th>
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
                    <td class="text-center">{{$item->sow}}</td>
                    <td class="text-center">{{$item->daily}}</td>
                    <td class="text-center">{{$item->open}}</td>
                    <td class="text-center">{{$item->in_progress}}</td>
                    <td class="text-center">{{$item->submitted}}</td>
                    <td class="text-center">
                        @if(!empty($item->daily) and !empty($item->submitted))
                            {{@floor(($item->submitted/$item->daily)*100)}}%
                        @else 
                            0%
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->sow and $item->total_submitted)
                            {{@floor(($item->total_submitted / $item->sow)*100)}}%
                        @else 
                            0%
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>