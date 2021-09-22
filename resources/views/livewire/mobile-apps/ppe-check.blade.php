<div>
    <div class="form-group row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2" wire:ignore>
            <input type="text" class="form-control date_ppe_check" placeholder="Date" />
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
                    <td>
                        {{$item->sertifikasi_alasan_tidak_lengkap}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @push('after-scripts')
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
    @endpush
</div>
