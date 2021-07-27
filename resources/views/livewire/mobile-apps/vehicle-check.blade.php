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
                    @if($item->is_submit==1)
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
                                Tidak {{$item->sticker_note!="" ? "( ".$item->sticker_note .")" : ''}}
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
                            @if($item->accident_report_id)
                                <a href="javascript:;" wire:click="set_accident_report({{$item->accident_report_id}})" data-toggle="modal" data-target="#modal_detail_accident_report"><i class="fa fa-warning text-warning"></i> view</a>
                            @endif
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

<div wire:ignore.self class="modal fade" id="modal_detail_accident_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" x-data>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning text-warning"></i> Accident Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Site ID</th>
                            <td x-text="$wire.site_id"></td>
                        </tr>
                        <tr>
                            <th>Hari Kejadian</th>
                            <td x-text="$wire.date"></td>
                        </tr>
                        <tr>
                            <th>Klasifikasi Insiden</th>
                            <td x-text="$wire.klasifikasi_insiden"></td>
                        </tr>
                        <tr>
                            <th>Jenis Insiden</th>
                            <td x-text="$wire.jenis_insiden"></td>
                        </tr>
                        <tr>
                            <th>Rincian/Kronologis Kejadian</th>
                            <td x-text="$wire.rincian_kronologis"></td>
                        </tr>
                        <tr>
                            <th>NIK dan Nama Orang Yg Terlibat ( Orang Perusahaan Sendiri Saja )</th>
                            <td x-text="$wire.nik_and_nama"></td>
                        </tr>
                        <tr>
                            <th colspan="2">Foto Foto Insiden </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row">
                                    @foreach($foto_insiden as $img)
                                    <div class="col-md-6"><img src="{{asset($img->image)}}" style="width:100%;" /></div>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
