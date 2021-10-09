<div>
    <div class="form-group row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2" wire:ignore>
            <input type="text" class="form-control date_ppe_check" placeholder="Date" />
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" wire:model="region_id" wire:change="$set('sub_region_id',null)">
                <option value=""> -- Select Region -- </option>
                @foreach($region as $item)
                    <option value="{{$item->id}}">{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="sub_region_id">
                <option value=""> -- Select Sub Region -- </option>
                @foreach($sub_region as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0)" class="btn btn-sm btn-info" wire:click="downloadExcel"><i class="fa fa-download"></i> Download</a>
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
                    <!-- <th>Site ID</th>
                    <th>Site Name</th> -->
                    <th class="text-center">Employee & PPE</th>
                    <th class="text-center">Banner</th>
                    <th class="text-center">Sertifikasi WAH</th>
                    <th class="text-center">Electrical</th>
                    <th class="text-center">First Aid</th>
                    <th class="text-center">Alasan Sertifikat Tidak Lengkap</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $k => $item)
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                    <!-- <td>{{$item->site_id}}</td>
                    <td>{{$item->site_name}}</td> -->
                    <td class="text-center">
                        @if($item->ppe_lengkap ==2)
                            <span class="badge badge-warning">Tidak Lengkap</span>
                            <p>{{$item->ppe_alasan_tidak_lengkap}}</p>
                        @endif
                        @if($item->ppe_lengkap ==1)
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                        @if($item->foto_dengan_ppe)
                            <a href="{{asset($item->foto_dengan_ppe)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->banner_lengkap == 2)
                            <span class="badge badge-warning">Tidak Lengkap</span>
                            <p>{{$item->banner_alasan_tidak_lengkap}}</p>
                        @endif
                        @if($item->banner_lengkap == 1)
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                        @if($item->foto_banner)
                            <a href="{{asset($item->foto_banner)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_wah)
                            <a href="{{asset($item->foto_wah)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_elektrikal)
                            <a href="{{asset($item->foto_elektrikal)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_first_aid)
                            <a href="{{asset($item->foto_first_aid)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td>{{$item->sertifikasi_alasan_tidak_lengkap}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div><br />
    {{$data->links()}}
    <script>
        $('.date_ppe_check').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false,
        }, function(start, end, label) {
            @this.set("date_start", start.format('YYYY-MM-DD'));
            @this.set("date_end", end.format('YYYY-MM-DD'));
            $('.date_ppe_check').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
        });
    </script>
</div>
