<div class="card">
    <div class="header row">
        <div class="pl-3">
            <select class="form-control" wire:model="perpage">
                <option>100</option>
                <option>200</option>
                <option>300</option>
                <option>400</option>
                <option>500</option>
                <option>600</option>
                <option>700</option>
                <option>800</option>
                <option>900</option>
                <option>1000</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" wire:model="keyword" placeholder="{{ __('Searching...') }}" />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="region">
                <option value=""> --- {{ __('Region') }} --- </option>
                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                <option>{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="created_at" placeholder="Date Uploaded" onfocus="(this.type='date')" />
        </div>
        <div class="col-md-4">
            <a href="javascript:;" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> {{ __('Upload') }}</a>
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="body pt-0">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>{{ __('NO') }}</th>
                        <th>{{ __('UPLOADED') }}</th>                                    
                        <th>{{ __('TANGGAL SUBMISSION') }}</th>                                    
                        <th>{{ __('NAMA') }}</th>                                    
                        <th>{{ __('NIK') }}</th>                                    
                        <th>{{ __('TOWER INDEX') }}</th>
                        <th>{{ __('SITE ID') }}</th>
                        <th>{{ __('SITE NAME') }}</th>
                        <th>{{ __('CLUSTER') }}</th>
                        <th>{{ __('REGION') }}</th>
                        <th>{{ __('REGION1') }}</th>
                        <th>{{ __('APAKAH DI SITE INI ADA BATTERY') }}</th>
                        <th>{{ __('BERAPA UNIT') }}</th>
                        <th>{{ __('MEREK BATERAI') }}</th>
                        <th>{{ __('KAPASITAS BATERAI (AH)') }}</th>
                        <th>{{ __('KAPAN BATERAI DILAPORKAN HILANG?') }}</th>
                        <th>{{ __('APAKAH BATERAI PERNAH DI RELOKASI?') }}</th>
                        <th>{{ __('DI RELOKASI KE SITE ID') }}</th>
                        <th>{{ __('DI RELOKASI KE SITE NAME') }}</th>
                        <th>{{ __('APAKAH CABINET BATERAI DIPASANG GEMBOK?') }}</th>
                        <th>{{ __('APAKAH  DIPASANG BATERAI CAGE?') }}</th>
                        <th>{{ __('APAKAH DIPASANG CABINET BELTING?') }}</th>
                        <th>{{ __('CATATAN') }}</th>
                        <th>{{ __('CHECK') }}</th>
                        <th>{{ __('SMARTSHEET DONE SUBMIT') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                    <tr>
                        <td style="width: 50px;">{{$k+1}}</td>
                        <td>{{date('d M Y',strtotime($item->created_at))}}</td> 
                        <td>
                            {{$item->tanggal_submission}}
                        </td> 
                        <td>{{isset($item->employee->name)?$item->employee->name : ''}}</td> 
                        <td>{{isset($item->employee->nik)?$item->employee->nik : ''}}</td>
                        <td>{{isset($item->tower->name)?$item->tower->name : ''}}</td> 
                        <td>{{isset($item->site->site_id)?$item->site->site_id : ''}}</td> 
                        <td>{{isset($item->site->name)?$item->site->name : ''}}</td> 
                        <td>{{isset($item->cluster->name)?$item->cluster->name : ''}}</td> 
                        <td>{{isset($item->region->region)?$item->region->region : ''}}</td> 
                        <td>{{isset($item->region_name)?$item->region_name : ''}}</td> 
                        <td>{{isset($item->region_name)?$item->region_name : ''}}</td>
                        <td>{{$item->apakah_di_site_ini_ada_battery	==1 ?'YES':'NO'}}</td>
                        <td>{{$item->berapa_unit}}</td> 
                        <td>{{$item->merk_baterai}}</td> 
                        <td>{{$item->kapasitas_baterai}}</td> 
                        <td>{{$item->kapan_baterai_dilaporkan_hilang}}</td> 
                        <td>{{$item->apakah_baterai_pernah_direlokasi	==1 ?'YES':'NO'}}</td>
                        <td>{{isset($item->relokasi_site->site_id)?$item->relokasi_site->site_id : ''}}</td> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:customer-asset-management.upload />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:customer-asset-management.confirm-delete />
        </div>
    </div>
</div>
@section('page-script')
Livewire.on('confirm-delete',(data)=>{
    $("#modal_confirm_delete").modal("show");
});
@endsection