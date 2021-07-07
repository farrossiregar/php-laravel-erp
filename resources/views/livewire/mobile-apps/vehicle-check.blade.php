<div>
    <div class="form-group row">
        <div class="col-md-2">
            <select class="form-control" wire:model="employee_id">
                <option value=""> --- Employee --- </option>
                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
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
                    <th>No</th>                                    
                    <th>Employee</th> 
                    <th>Date</th>
                    <th>Plat Nomor</th>
                    <th>Kendaran & Plat Nomor</th>
                    <th>Stiker Safety Driving</th>
                    <th>Photo Stiker Safety Driving</th>
                    <th>Vehicle Cleanliness</th>
                    <th>Accident Report</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
                    <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                    @if($item->is_submite==1)
                        <td>{{$item->plat_nomor}}</td>
                        <td>
                            @if($item->foto_mobil_plat_nomor)
                                <a href="{{asset($item->foto_mobil_plat_nomor)}}" target="_blank"><i class="fa fa-image"></i></a>
                            @endif
                        </td>
                        <td>
                            @if($item->stiker_safety_driving==1)
                                Ya
                            @else
                                Tidak
                            @endif
                        </td>
                        <td>
                            @if($item->stiker_safety_driving)
                                <a href="{{asset($item->stiker_safety_driving)}}" target="_blank"><i class="fa fa-image"></i></a>
                            @endif
                        </td>
                        <td>
                            @foreach(\App\Models\VehicleCheckCleanliness::where('vehicle_check_id',$item->id)->get() as $img)
                                <a href="{{asset($img->image)}}" target="_blank"><i class="fa fa-image"></i></a>
                            @endforeach
                        </td>
                        <td>
                            @foreach(\App\Models\VehicleCheckAccidentReport::where('vehicle_check_id',$item->id)->get() as $img)
                                <a href="{{asset($img->image)}}" target="_blank"><i class="fa fa-image"></i></a>
                            @endforeach
                        </td>
                    @else
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
