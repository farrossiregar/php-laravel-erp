<div>
    <div class="form-group row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-1" wire:ignore>
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
        <div class="col-md-2" wire:ignore>
            <select class="form-control" wire:model="user_access_id">
                <option value="">-- Job Role/Access --</option>
                @foreach(\App\Models\UserAccess::where('is_project',1)->get() as $item)
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
                    <th>NIK</th> 
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
                    <td>
                        @if($item->is_submit==0)
                            <a href="javascript:void()" data-toggle="modal" class="text-danger" data-target="#modal_delete_pc" wire:click="set_id({{$item->id}})"><i class="fa fa-trash"></i></a>
                        @endif
                        {{isset($item->employee->nik) ? $item->employee->nik : ''}}</td>
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

    <div class="modal fade" x-data="" wire:ignore.self id="modal_delete_pc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            Livewire.on('refresh-page',()=>{
                $("#modal_delete_pc").modal('hide');
            });
        </script>
    @endpush
    <script>
        $('.date_ppe_check').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false,
        });
        $('.date_ppe_check').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

            @this.set("date_start", picker.startDate.format('YYYY-MM-DD'));
            @this.set("date_end", picker.endDate.format('YYYY-MM-DD'));
        });
        $('.date_ppe_check').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
</div>
