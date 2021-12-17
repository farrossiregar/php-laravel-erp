<div class="clearfix">
    <div class="body pt-0">
        <div class="table-responsive mt-3">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th colspan="9" class="text-center" style="background:#ffe7e7">EPL Vehicle</th>
                        <th></th>
                        <th colspan="8" class="text-center" style="background:#00800040">ERP Vehicle</th>
                    </tr>
                    <tr style="background:#eee">
                        <th>No</th>
                        <th>No Polisi</th>
                        <th>Vendor</th>
                        <th>Brand</th>
                        <th>Type</th>
                        <th>Merk</th>
                        <th>Tahun</th>
                        <th>STNK No</th>
                        <th>End Date Pajak</th>
                        <th class="text-info">
                                <a href="javascript:void(0)" wire:click="syncron" title="Syncron Vehicle" class="badge badge-info badge-active"><i class="fa fa-refresh"></i> Syncron</a>
                            
                                <a href="javascript:void(0)" wire:loading class="badge badge-info badge-active">
                                    <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                    ({{$total}}/{{$count}})
                                </a>
                            
                        </th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Custer</th>
                        <th>Sub Cluster</th>
                        <th>PIC</th>
                        <th>NIK</th>
                        <th>Type SIM</th>
                        <th>Car/Motorcycle</th>
                    </tr>
                </thead>
                <tbody>
                    @php($number= $data->total() - (($data->currentPage() -1) * $data->perPage()) )
                    @foreach($data as $k=>$item)
                        <tr>
                            <td>{{$number}}</td>
                            <td>{{isset($item->epl_vehicle->no_polisi)?$item->epl_vehicle->no_polisi:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->vendor->name)?$item->epl_vehicle->vendor->name:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->vehicle->brand)?$item->epl_vehicle->vehicle->brand:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->vehicle->type)?$item->epl_vehicle->vehicle->type:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->vehicle->merk)?$item->epl_vehicle->vehicle->merk:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->vehicle->tahun)?$item->epl_vehicle->vehicle->tahun:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->stnk_no)?$item->epl_vehicle->stnk_no:'-'}}</td>
                            <td>{{isset($item->epl_vehicle->stnk_end_date)?$item->epl_vehicle->stnk_end_date:'-'}}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        @php($number--)
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$data->links()}}
    </div>
</div>