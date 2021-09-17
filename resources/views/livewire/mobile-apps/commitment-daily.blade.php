<div>
    <div class=" row">
        <div class="col-md-2 form-group">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
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
                        <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
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
                            <td>{{date('d-M-Y H:i',strtotime($item->created_at))}}</td>
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
</div>
