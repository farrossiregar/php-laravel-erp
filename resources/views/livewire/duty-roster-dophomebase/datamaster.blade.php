<div class="row">
    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="nama_dop" placeholder="Nama DOP" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="project" placeholder="Project" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="region" placeholder="Region" />
    </div>
    <div class="col-md-5">                    
        @if(check_access('duty-roster-dophomebase.importhrd'))
            <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('Import')}}</a>        
            <a href="#" data-toggle="modal" data-target="#modal-dutyroster-inputdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input')}}</a>
        @endif
        @if(check_access('duty-roster-dophomebase.importsm'))
            <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyrostersm" title="Add" class="btn btn-primary"><i class="fa fa-upload"></i> {{__('Import')}}</a>
        @endif
        <a wire:click="save()" href="" title="Add" class="btn btn-success"><i class="fa fa-download"></i> {{__('Export')}}</a>
    </div>
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Nama DOP</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Alamat</th>
                        <th>Long</th>
                        <th>Lat</th>
                        <th>Pemilik DOP</th>
                        <th>Telepon Pemilik</th>
                        <th>Opex Region/GA</th>
                        <th>Type Homebase/DOP</th>
                        <th>Start Date</th>
                        <th>Expired</th>
                        <th>Budget</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($is_audit)
                            <input type="checkbox"  wire:click="checkdata({{ $item->id }})" wire:model="data_id.{{ $item->id }}" />
                            @else
                                @if($item->remarks == '1')
                                    <a href="javascript:;" class="text-danger"><i class="fa fa-close"></i></a>
                                @else
                                    <a href="javascript:;" class="text-success"><i class="fa fa-check"></i></a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif

                            @if($is_approval)
                                @if($item->status == '' || $item->status == null)
                                    <a href="javascript:;" wire:click="$emit('modalapprovedutyroster','{{ $item->id }}')" class="badge badge-success badge-active"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedutyroster','{{ $item->id }}')" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Decline</a>
                                @endif

                            @endif
                        
                        </td>
                        <td>{{ $item->nama_dop }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            @if($item->status == '1')
                                {{ $item->long }}
                                <a href="javascript:void(0)" wire:click="$emit('modalupdatelong','{{ $item->id }}')" title="Add" class="badge badge-primary badge-active"><i class="fa fa-edit"></i> </a>
                            @else
                                {{ $item->long }}
                            @endif
                        </td>
                        <td>
                            @if($item->status == '1')
                                {{ $item->lat }}
                                <div wire:click="$emit('modalupdatelat','{{ $item->id }}')" title="Add" class="badge badge-primary badge-active"><i class="fa fa-edit"></i> </div>
                            @else
                                {{ $item->lat }}
                            @endif
                        </td>
                        <td>{{ $item->pemilik_dop  }}</td>
                        <td>{{ $item->telepon_pemilik }}</td>
                        <td>{{ $item->opex_region_ga }}</td>
                        <td>{{ $item->type_homebase_dop }}</td>
                        <td>{{ ($item->start_date ? date('d-m-Y',strtotime($item->start_date)) : '-') }}</td>
                        <td>
                            <?php  
                                if(substr($item->expired, 0, 11) > date('Y-m-d')){
                                    echo '<label class="badge badge-danger" data-toggle="tooltip" title="Expired"><b>'.date_format(date_create($item->expired), 'd M Y').'</b></label>';
                                }

                                if(substr($item->expired, 0, 11) < date('Y-m-d')){
                                    echo '<label class="badge badge-success" data-toggle="tooltip" title="In Progress"><b>'.date_format(date_create($item->expired), 'd M Y').'</b></label>';
                                }
                            ?>
                            @if($is_upload_image)
                                <a href="javascript:void(0)" wire:click="$emit('modaluploadimage','{{ $item->id }}')" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Image')}}</a>
                            @endif
                        </td>
                        <td>Rp. {{ format_idr((int)$item->budget) }}</td>
                        <td>
                            @if($is_upload_dop and empty($item->dop_file))
                                <a href="javascript:void(0)" wire:click="set_selected_id({{$item->id}})" data-toggle="modal" data-target="#modal_upload_dop" class="badge badge-info badge-active"><i class="fa fa-upload"></i> Upload DOP</a>
                            @endif
                            @if($item->dop_file)
                                <a href="{{asset($item->dop_file)}}"><i class="fa fa-download"></i> Download</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_upload_dop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="upload_dop">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload DOP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="file" wire:model="file" />
                            @error('file')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
                    </div>
                    <div wire:loading>
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>Please wait...</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

</div>