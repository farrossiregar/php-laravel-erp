<div>
    <div class=" row">
        <div class="pl-3 py-2 form-group" x-data="{open_dropdown:false}" @click.away="open_dropdown = false">
            <a href="javascript:void(0)" x-on:click="open_dropdown = ! open_dropdown" class="dropdown-toggle">
                 Searching <i class="fa fa-search-plus"></i>
            </a>
            <div class="dropdown-menu show-form-filter" x-show="open_dropdown">
                <form class="p-2">
                    <div class="form-group">
                        <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                    </div>
                    <div class="form-group" wire:ignore>
                        <input type="text" class="form-control date_health_check" placeholder="Date" />
                    </div>
                    <div class="form-group" wire:ignore>
                        <select class="form-control" wire:model="region_id">
                            <option value=""> -- Select Region -- </option>
                            @foreach($region as $item)
                                <option value="{{$item->id}}">{{$item->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" wire:model="sub_region_id">
                            <option value=""> -- Select Sub Region -- </option>
                            @foreach($sub_region as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" wire:ignore>
                        <select class="form-control" wire:model="user_access_id">
                            <option value="">-- Job Role/Access --</option>
                            @foreach(\App\Models\UserAccess::where('is_project',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="javascript:void(0)" wire:click="clear_filter()"><small>Clear filter</small></a>
                </form>
            </div>
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
                    <th style="width:50px;">No</th>      
                    <th>Region</th>              
                    <th>Sub Region</th>                                
                    <th>NIK</th> 
                    <th>Employee</th> 
                    <th>Jobe Role/Access</th>   
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
                @php($num=$data->firstItem())
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                        <td>
                            @if($item->is_submit==0)
                                <a href="javascript:void()" data-toggle="modal" class="text-danger" data-target="#modal_delete_hc" wire:click="set_id({{$item->id}})"><i class="fa fa-trash"></i></a>
                            @endif
                            {{isset($item->employee->nik) ? $item->employee->nik : ''}}
                        </td>
                        <td>{{isset($item->name) ? $item->name : ''}}</td>
                        <td>{{isset($item->employee->access->name) ? $item->employee->access->name : ''}}</td>
                        <td>{{date('d-M-Y H:i',strtotime($item->updated_at))}}</td>
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
                    @php($num++)
                @endforeach
                @if($data->count() ==0)
                <tr>
                    <td colspan="5" class="text-center"><i>empty</i></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <br />
    {{$data->links()}}
    <div class="modal fade" x-data="" wire:ignore.self id="modal_delete_hc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="delete">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <P>Apakah anda ingin menghapus data ini ?</P>
                        </div>
                    </div>
                    <div class="modal-footer" wire:loading.remove wire:target="save">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('after-scripts')
        <script>
            $('.date_health_check').daterangepicker({
                opens: 'left',
                locale: {
                    cancelLabel: 'Clear'
                },
                autoUpdateInput: false
            }, function(start, end, label) {
                // @this.set("date_start", start.format('YYYY-MM-DD'));
                // @this.set("date_end", end.format('YYYY-MM-DD'));
                // $('.date_health_check').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
            });

            $('.date_health_check').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

                @this.set("date_start", picker.startDate.format('YYYY-MM-DD'));
                @this.set("date_end", picker.endDate.format('YYYY-MM-DD'));
            });
            $('.date_health_check').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        </script>
    @endpush
</div>
