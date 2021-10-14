<div>
    <div class=" row">
        <div class="col-md-2 form-group">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2" wire:ignore>
            <input type="text" class="form-control date_range_commitment_daily" placeholder="Date" />
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
                    <th>Employee</th>   
                    <th>Jobe Role/Access</th>   
                    <th class="text-center">Berkomitment Menggunakan PPE/APD</th>
                    <th class="text-center">Bagian PPE/APD yang tidak punya</th>
                    <th class="text-center">Regulasi sanksi dari management</th>
                    <th class="text-center">Regulasi terhadap kecurian</th>
                    <th class="text-center">Regulasi terhadap kerusakan nama baik perusahaan</th>
                    <th class="text-center">Regulasi terkait minuman keras/obat terlarang</th>
                    <th class="text-center">Regulasi terkait pelanggaran peraturan perusahaan</th>
                    <th class="text-center">Regulasi terkait protokol kesehatan</th>
                    <th class="text-center">Regulasi terkait penggunaan kendaraan</th>
                    <th class="text-center">Regulasi BCG</th>
                    <th class="text-center">Regulasi terkait cyber security</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @php($num=$data->firstItem())
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$num}}</td>
                        <td>{{isset($item->name) ? $item->name : ''}}</td>
                        <td>{{isset($item->employee->access->name) ? $item->employee->access->name : ''}}</td>
                        @if($item->is_submit ==1)
                            <td class="text-center">{!!$item->regulasi_terkait_ppe_apd_menggunakan==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{{$item->regulasi_terkait_ppe_apd_tidak_punya !='null' ? $item->regulasi_terkait_ppe_apd_tidak_punya : '-'}}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_sanksi==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terhadap_kecurian==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terhadap_kerusakan_nama_baik_perusahaan==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_minuman_keras_obat_terlarang==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_pelanggaran_peraturan_perusahaan==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_protokol_kesehatan==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_penggunaan_kendaraan==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_bcg==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td class="text-center">{!!$item->regulasi_terkait_cyber_security==1?'<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'!!}</td>
                            <td>{{date('d-M-Y H:i',strtotime($item->updated_at))}}</td>
                        @else
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
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
                    <td colspan="9" class="text-center"><i>empty</i></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <br />
    {{$data->links()}}
    <script>
        $('.date_range_commitment_daily').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false,
        });
        $('.date_range_commitment_daily').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

            @this.set("date_start", picker.startDate.format('YYYY-MM-DD'));
            @this.set("date_end", picker.endDate.format('YYYY-MM-DD'));
        });
        $('.date_range_commitment_daily').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>
</div>