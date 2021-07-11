<div>
    <div class=" row">
        <div class="col-md-2">
            <select class="form-control" wire:model="employee_id">
                <option value=""> --- Employee --- </option>
                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 form-group">
            <input type="text" class="form-control date_created" placeholder="Date" />
        </div>
        <div class="col-md-5">
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
                    <th style="width:50px;">No</th>                                    
                    <th>Employee</th> 
                    <th>Date</th> 
                    <th>Perusahaan</th> 
                    <th>Lokasi Kantor</th> 
                    <th>Department</th> 
                    <th>Status Bekerja Hari ini</th> 
                    <th>Kondisi Badan</th> 
                    <th>Tinggal Dengan Keluarga Terkonfirmasi Covid 19</th> 
                    <th>Apakah anda bepergian keluar kota</th> 
                    <th>Apakah anda ada mengunjungi keluarga yang sedang dirawat di rumah sakit dalam 3 hari terakhir</th> 
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>
                            {{isset($item->employee->name) ? $item->employee->name : ''}}
                        </td>
                        <td>{{date('d-F-Y',strtotime($item->created_at))}}</td>
                        @if($item->is_submit==1)
                            <td>{{isset($item->company) ? $item->company : ''}}</td>
                            <td>{{isset($item->lokasi_kantor) ? $item->lokasi_kantor : ''}}</td>
                            <td>{{isset($item->department) ? $item->department : ''}}</td>
                            <td class="text-center" title="{{$item->status_bekerja=="WFH (Others)" ? $item->status_bekerja_others : "" }}">{{$item->status_bekerja}}</td>
                            <td class="text-center" title="{{$item->kondisi_badan==2?$item->kondisi_badan_sakit : ''}}">{{$item->kondisi_badan==1?"Sehat" : "Sakit"}}</td>
                            <td class="text-center" title="{{$item->tinggal_serumah_covid==1 ? $item->tinggal_serumah_covid_ya : "" }}">{{$item->tinggal_serumah_covid==1?"Ya":"Tidak"}}</td>
                            <td class="text-center" title="{{$item->bepergian_keluar_kota==1?$item->bepergian_keluar_kota_ya : ''}}">{{$item->bepergian_keluar_kota==1?"Ya":"Tidak"}}</td>
                            <td class="text-center" title="{{$item->mengunjungi_keluarga==1?$item->mengunjungi_keluarga_ya:''}}">{{$item->mengunjungi_keluarga==1?"Ya":"Tidak"}}</td>
                        @else
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                        @endif
                    </tr>
                @endforeach
                @if($data->count() ==0)
                <tr>
                    <td colspan="5" class="text-center"><i>empty</i></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    @push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
    <script>
        $('.date_created').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false,
        }, function(start, end, label) {
            @this.set("date_start", start.format('YYYY-MM-DD'));
            @this.set("date_end", end.format('YYYY-MM-DD'));
            $('.date_created').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
        });
    </script>
    @endpush
</div>
