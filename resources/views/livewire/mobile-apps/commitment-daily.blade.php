<div>
    <div class="header row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="user_access_id">
                <option value="">--- User Access ---</option>
                @foreach(\App\Models\UserAccess::all() as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
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
                <tr>
                    <th>No</th>                                    
                    <th>Employee</th>   
                    <th>Berkomitment Menggunakan PPE/APD</th>
                    <th>Bagian PPE/APD yang tidak punya</th>
                    <th>Regulasi sanksi dari management</th>
                    <th>Regulasi terhadap kecurian</th>
                    <th>Regulasi terhadap kerusakan nama baik perusahaan</th>
                    <th>Regulasi terkait minuman keras/obat terlarang</th>
                    <th>Regulasi terkait pelanggaran peraturan perusahaan</th>
                    <th>Regulasi terkait protokol kesehatan</th>
                    <th>Regulasi terkait penggunaan kendaraan</th>
                    <th>Regulasi BCG</th>
                    <th>Regulasi terkait cyber security</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
