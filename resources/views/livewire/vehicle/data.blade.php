<div class="clearfix">
    <div class="body pt-0">
        <div class="row">
            <div class="form-group col-md-2">
                <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-striped m-b-0 c_list table-hover">
                <thead>
                    <tr>
                        <th colspan="9" class="text-center" style="background:#ffe7e7">EPL Vehicle</th>
                        <th>
                            @if(!$is_sync)
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </span>
                            @endif
                            @if(check_access('vehicle.syncron'))
                                @if(!$is_sync)
                                    <a href="javascript:void(0)" wire:click="start_sync" title="Syncron Vehicle" class="badge badge-info badge-active"><i class="fa fa-refresh"></i> Syncron All</a>
                                @else
                                    <a href="javascript:void(0)" title="cancel" wire:click="$set('is_sync',false)" class="badge badge-info badge-active">
                                        <i class="fa fa-spinner fa-pulse fa-1x fa-fw"></i>
                                        <span class="sr-only">{{ __('Loading...') }}</span>
                                        Syncronize ({{$total}}/{{$count}})
                                    </a>
                                @endif
                            @endif
                        </th>
                        <th colspan="10" class="text-center" style="background:#00800040">ERP Vehicle</th>
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
                        <th class="text-center">Last Syncron</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Custer</th>
                        <th>NIK</th>
                        <th>Name</th>
                        <th>Type SIM</th>
                        <th>Car/Motorcycle</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
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
                            <td class="text-center">{{date('d-M-Y',strtotime($item->updated_at))}}</td>
                            <td>{{isset($item->project->name)?$item->project->name:'-'}}</td>
                            <td>{{isset($item->region->region)?$item->region->region:'-'}}</td>
                            <td>{{isset($item->sub_region->name)?$item->sub_region->region:'-'}}</td>
                            <td>{{isset($item->driver_employee->nik)?$item->driver_employee->nik:'-'}}</td>
                            <td>{{isset($item->driver_employee->name)?$item->driver_employee->name:'-'}}</td>
                            <td></td>
                            <td>
                                @if($item->car_motorcycle==1)
                                    Car
                                @endif
                                @if($item->car_motorcycle==2)
                                    Motorcycle
                                @endif
                            </td>
                            <td>
                                @if($item->status==0)
                                    <span class="badge badge-warning">Waiting Validate</span>
                                @endif
                                @if($item->status==1)
                                    <span class="badge badge-success">Valid</span>
                                @endif
                                @if($item->status==2)
                                    <span class="badge badge-danger">Not Valid</span>
                                @endif
                            </td>
                            <td>
                                {!!$item->note_psm ? '<p>Note PSM : '.$item->note_psm .'</p>'  : ''!!}
                                {!!$item->note_pmg ? '<p>Note PMG : '.$item->note_pmg .'</p>'  : ''!!}
                            </td>
                            <td>
                                @if($is_access_valid and $item->status==0)
                                    <a href="javascript:void(0)" wire:click="submit_valid({{$item->id}})" class="badge badge-success badge-active"><i class="fa fa-check-circle"></i> Valid</a>
                                    <a href="javascript:void(0)" wire:click="set_id({{$item->id}})" data-target="#modal_add_note_invalid" data-toggle="modal" class="badge badge-danger badge-active"><i class="fa fa-times-circle"></i> Invalid</a>
                                @endif
                                @if($is_access_audit and $item->status==1)
                                    <a href="javascript:void(0)" wire:click="set_id({{$item->id}})" data-target="#modal_add_audit" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-check-circle"></i> Audit</a>
                                @endif
                            </td>
                        </tr>
                        @php($number--)
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$data->links()}}
    </div>

    <div wire:ignore.self class="modal fade" id="modal_add_audit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_audit">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Audit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" wire:ignore>
                            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
                        </div>
                        @error('note')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        <button type="submit" wire:loading.remove wire:target="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_add_note_invalid" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_invalid">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Invalid</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" wire:ignore>
                            <textarea class="form-control" wire:model="note" placeholder="*Note"></textarea>
                        </div>
                        @error('note')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        <button type="submit" wire:loading.remove wire:target="submit" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script>
            Livewire.on('reload',()=>{
                $("#modal_add_note_invalid").modal('hide');
                $("#modal_add_audit").modal('hide');
            });
        </script>
    @endpush
</div>