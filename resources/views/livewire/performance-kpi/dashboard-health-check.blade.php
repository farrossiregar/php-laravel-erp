<div class="table-responsive">
    <table class="table m-b-0 c_list table-bordered table-dasboard">
        <thead>
            <tr style="background:#eee;">                      
                <th>Project</th>   
                <th class="text-center">Quantity</th>
                <th class="text-center">Done</th>
                @foreach(config('vars.health_check_status_bekerja') as $field)
                    <th class="text-center">{{$field}}</th>
                @endforeach
                <th class="text-center">Percentage</th>
            </tr>
        </thead> 
        <tbody> 
            @foreach($projects as $k => $p)
                @php($done = \App\Models\HealthCheck::where(['client_project_id'=>$p->id,'is_submit'=>1])->whereDate('created_at',date('Y-m-d'))->count())
                @php($qty = \App\Models\HealthCheck::where(['client_project_id'=>$p->id])->whereDate('created_at',date('Y-m-d'))->count())
                @php($persen = @floor($done / $qty * 100))
                <tr>
                    <td>{{$p->name}}</td>
                    <td class="text-center">{{$qty}}</td>
                    <td class="text-center">{{$done}}</td>
                    @foreach(config('vars.health_check_status_bekerja') as $field)
                        <td class="text-center">{{\App\Models\HealthCheck::where('client_project_id',$p->id)->where('status_bekerja',$field)->whereDate('created_at',date('Y-m-d'))->count()}}</td>
                    @endforeach
                    @if($done ==0) 
                        <td class="bg-danger text-center" style="color:white;">0%</td> 
                    @else
                        @php($persen  = floor($done/$qty*100))
                        @if($persen < 50)
                            <td class="bg-danger text-center" style="color:white;">{{$persen}}%</td>
                        @elseif($persen >= 50 and $persen <=99)
                            <td class="bg-warning text-center" style="color:white;">{{$persen}}%</td>
                        @elseif($persen ==100)
                            <td class="bg-success text-center" style="color:white;">{{$persen}}%</td>
                        @endif
                    @endif
                </tr>  
            @endforeach
        </tbody>
    </table>
</div>