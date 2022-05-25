<div class="card">
    <div class="row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-1 form-group">
            <input type="text" class="form-control date_created" placeholder="Date" />
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" wire:model="region_id">
                <option value=""> -- Region -- </option>
                @foreach($regions as $item)
                    <option value="{{$item->id}}">{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="sub_region_id">
                <option value=""> -- Sub Region -- </option>
                @foreach($sub_regions as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @if(check_access('preventive-maintenance.insert'))
                        <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#modal_add_preventive_maintenance"><i class="fa fa-plus"></i> Preventive Maintenance</a>
                    @endif
                    @if(check_access('preventive-maintenance.import'))
                        <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#modal_import_pm"><i class="fa fa-upload"></i> Import</a>
                    @endif
                    @if(check_access('preventive-maintenance.download'))
                        <a href="javascript:void(0)" wire:click="downloadExcel" class="dropdown-item"><i class="fa fa-download"></i> Download</a>
                    @endif
                </div>
            </div>    
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
                    <th style="width:50px;" rowspan="2">No</th>    
                    <th rowspan="2">Site ID</th>
                    <th rowspan="2">Site Name</th>   
                    <th rowspan="2">Task Description</th>   
                    <th rowspan="2">Site Category</th>   
                    <th rowspan="2">Site Type</th>   
                    <th rowspan="2">PM Type</th>
                    <th rowspan="2">Region</th>
                    <th rowspan="2">Sub Region</th>
                    <th rowspan="2">Cluster</th>
                    <th rowspan="2">Sub Cluster</th>
                    <th rowspan="2">NIK Karyawan</th>
                    <th rowspan="2">Nama Karyawan</th>
                    <th rowspan="2">Admin Project</th>
                    <th rowspan="2">Assign Date</th>
                    <th rowspan="2">Pickup Date</th>
                    <th rowspan="2">Submitted Date</th>
                    <th rowspan="2" class="text-center">Status PM</th>
                    <th rowspan="2" class="text-center">Status Punch List</th>
                    <th colspan="7" class="text-center">Document Tracking</th>
                    <th rowspan="2"></th>
                </tr>
                <tr style="background:#eee;">
                    {{-- <th class="text-center">TMG</th> --}}
                    {{-- <th class="text-center">TLP</th> --}}
                    <th>PM Report</th>
                    <th>Open Punch List</th>
                    <th>TT Number/Laporan PLN</th>
                    <th>BOQ Evidence</th>
                    <th class="text-center">Submit BOQ</th>
                    <th>Rect. Evidence</th>
                    <th>Submit Rect. FEAT</th>
                </tr>
            </thead>
            <tbody>
                @php($is_upload_report = check_access('preventive-maintenance.upload-report'))
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$item->site_id}}</td>
                        <td>{{$item->site_name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->site_category}}</td>
                        <td>{{$item->site_type}}</td>
                        <td>{{$item->pm_type}}</td>
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : '-'}}</td>
                        <td>{{ $item->cluster }}</td>
                        <td>{{ $item->sub_cluster }}</td>
                        <td>
                            {{ isset($item->employee->nik) ? $item->employee->nik : '' }}
                            @if($item->status==0)
                                <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_change_pic" title="Change PIC"><i class="fa fa-edit"></i></a>
                            @endif
                        </td>
                        <td>{{ isset($item->employee->name) ? $item->employee->name : '' }}</td>
                        <td>{{ isset($item->admin->name) ? $item->admin->name : '' }}</td>
                        <td>{{ isset($item->created_at) ? date('d-M-Y',strtotime($item->created_at)) : '-' }}</td>
                        <td>{{ isset($item->start_date) ? date('d-M-Y',strtotime($item->start_date)) : '-' }}</td>
                        <td>{{ isset($item->end_date) ? date('d-M-Y',strtotime($item->end_date)) : '-' }}</td>
                        <td class="text-center" title="{{$item->note}}">
                            @if($item->is_reject==1)
                                <span class="badge badge-danger" onclick="alert('{{$item->note_reject}}')" title="{{$item->note_reject}}">Reject</span>
                            @elseif($item->status==0)
                                <span class="badge badge-info">Open</span>
                            @elseif($item->status==1)
                                <span class="badge badge-warning">In Progress</span>
                            @endif
                            @if($item->status==2 and $item->is_upload_report==null)
                                <span class="badge badge-success">Submitted</span>
                            @elseif($item->is_upload_report==1)
                                @if($item->is_punch_list==1)
                                    <span class="badge badge-warning">Approved with Punch List</span>
                                @else
                                    <span class="badge badge-success">Approved EID</span>
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->is_punch_list==1)
                                @if($item->site_type=='TLP')    
                                    @if($item->status_punch_list_tlp==0)
                                        <span class="badge badge-warning">Open</span>
                                    @endif
                                    @if($item->status_punch_list_tlp==1)
                                        <span class="badge badge-success">Approved EID</span>
                                    @endif
                                @endif
                                @if($item->site_type=='TMG')
                                    @if($item->status_punch_list_tmg==0)
                                        <span class="badge badge-warning">Open</span>
                                    @endif
                                    @if($item->status_punch_list_tmg==1)
                                        <span class="badge badge-warning">BOQ Submitted</span>
                                    @endif
                                    @if($item->status_punch_list_tmg==2)
                                        <span class="badge badge-warning">BOQ Approved by EID</span>
                                    @endif
                                    @if($item->status_punch_list_tmg==3)
                                        <span class="badge badge-warning">Rect FEAT Submitted</span>
                                    @endif
                                    @if($item->status_punch_list_tmg==4)
                                        <span class="badge badge-success"><i class="fa fa-check-circle"></i> Approved EID</span>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td class="text-center" title="{{$item->note}}">
                            @if($item->status==2 and $is_upload_report and $item->is_upload_report==0)
                                <a href="javascript:void(0)" class="text-warning" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_upload_report"><i class="fa fa-upload"></i></a>
                            @else
                                @if($item->is_upload_report==1)
                                    <a href="javascript:void(0)" class="text-success" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_upload_report"><i class="fa fa-check-circle"></i></a>
                                @endif
                            @endif
                        </td>
                        <td>{{$item->open_punch_list_created?date('d-M-Y',strtotime($item->open_punch_list_created)) : '-'}}</td>
                        <td class="text-center">
                            @if($item->is_punch_list==1)
                                @if($item->site_type=='TLP')
                                    @if($item->status_punch_list_tlp==0)
                                        <a href="javascript:void(0)" class="text-warning" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_upload_laporan_pln"><i class="fa fa-upload"></i></a>
                                    @else
                                        <a href="javascript:void(0)" class="text-success"  wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_upload_laporan_pln"><i class="fa fa-check-circle"></i></a>
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->is_punch_list==1)
                                @if($item->site_type=='TMG')
                                    @if(isset($item->punch_list_evidence) and $item->punch_list_evidence->count()>0)
                                        <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" data-target="#modal_view_evidence" data-toggle="modal"><i class="fa fa-image"></i></a>
                                    @else
                                        -
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status_punch_list_tmg==1)
                                <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" class="badge badge-active badge-success" data-toggle="modal" data-target="#modal_view_boq"><i class="fa fa-check-circle"></i> Review BoQ</a>
                            @elseif($item->boq_created)
                                {{date('d-M-Y',strtotime($item->boq_created))}}
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->is_punch_list==1)
                                @if($item->site_type=='TMG')
                                    @if(isset($item->punch_list_rectification) and $item->punch_list_rectification->count()>0)
                                        <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" data-target="#modal_view_evidence" data-toggle="modal"><i class="fa fa-image"></i></a>
                                    @else
                                        -
                                    @endif
                                @endif
                            @endif
                            {{$item->rec_evidence_created ? date('d-M-Y',strtotime($item->rec_evidence_created)) : ''}}
                        </td>
                        <td class="text-center">
                            @if($item->status_punch_list_tmg==3)
                                @if($item->site_type=='TMG')
                                    <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" class="badge badge-success badge-active" data-toggle="modal" data-target="#modal_review_feat"><i class="fa fa-check-circle"></i> Review FEAT</a>
                                @endif
                            @endif
                            {{$item->rec_feat_created ? date('d-M-Y',strtotime($item->rec_feat_created)) : '-'}}
                        </td>
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
    {{$data->links()}}

    <div wire:ignore.self class="modal fade" id="modal_review_feat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_feat">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-image"></i> Review FEAT Rectification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix file_manager">
                            @if(isset($selected->punch_list_evidence))
                                @foreach($selected->punch_list_evidence as $img)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                            <div class="card">
                                                <div class="file">
                                                    <a href="javascript:void(0)">
                                                        <div class="hover">
                                                            @if($selected->status_punch_list_tmg==3)
                                                                <button type="button" wire:click="delete_punch_list({{$img->id}})" class="btn btn-icon btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                        <div class="image">
                                                            <img src="{{asset($img->file)}}" alt="img" class="img-fluid">
                                                        </div>
                                                        <div class="file-name">
                                                            <p class="m-b-5 text-muted">{{$img->note}}</p>
                                                            <small><span class="date text-muted">{{date('M d, Y',strtotime($img->created_at))}}</span></small>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit FEAT Rectification</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="modal_view_boq" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_boq">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-image"></i> Review BOQ</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix file_manager">
                            @if(isset($selected->punch_list_evidence))
                                @foreach($selected->punch_list_evidence as $img)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0)">
                                                    <div class="hover">
                                                        @if($selected->status_punch_list_tmg==1)
                                                            <button type="button" wire:click="delete_punch_list({{$img->id}})" class="btn btn-icon btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="image">
                                                        <img src="{{asset($img->file)}}" alt="img" class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">{{$img->note}}</p>
                                                        <small><span class="date text-muted">{{date('M d, Y',strtotime($img->created_at))}}</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit BOQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_view_evidence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-image"></i> BOQ Evidence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix file_manager">
                            @if(isset($selected->punch_list_evidence))
                                @foreach($selected->punch_list_evidence as $img)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0)">
                                                    <div class="hover">
                                                        @if($selected->status_punch_list_tmg==0)
                                                            <button type="button" wire:click="delete_punch_list({{$img->id}})" class="btn btn-icon btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="image">
                                                        <img src="{{asset($img->file)}}" alt="img" class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">{{$img->note}}</p>
                                                        <small><span class="date text-muted">{{date('M d, Y',strtotime($img->created_at))}}</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_view_rectification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-image"></i> Rectification</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix file_manager">
                            @if(isset($selected->punch_list_rectification))
                                @foreach($selected->punch_list_rectification as $img)
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="card">
                                            <div class="file">
                                                <a href="javascript:void(0)">
                                                    <div class="hover">
                                                        @if($selected->status_punch_list_tmg==2)
                                                            <button type="button" wire:click="delete_punch_list({{$img->id}})" class="btn btn-icon btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div class="image">
                                                        <img src="{{asset($img->file)}}" alt="img" class="img-fluid">
                                                    </div>
                                                    <div class="file-name">
                                                        <p class="m-b-5 text-muted">{{$img->note}}</p>
                                                        <small><span class="date text-muted">{{date('M d, Y',strtotime($img->created_at))}}</span></small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_upload_laporan_pln" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_tt_number">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> TT Number/Laporan PLN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(isset($selected))
                            @if(isset($selected->punch_list_laporan_pln))
                                <ul class="list-group">
                                    @foreach($selected->punch_list_laporan_pln as $img)
                                        <li class="list-group-item">
                                            {{$img->note}} 
                                            @if($img->file)
                                                <a href="{{asset($img->file)}}" target="_blank"><i class="fa fa-download"></i> File</a><br />
                                            @endif
                                            <small>Created at : {{date('d-M-Y H:i',strtotime($img->created_at))}}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if(isset($selected) and $selected->status_punch_list_tlp==0)
                                <hr />
                                <div class="form-group">
                                    <label>File (xlsx,csv,xls,doc,docx,pdf,image) max:50mb</label>
                                    <input type="file" class="form-control" wire:model="file" />
                                    @error('file')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" wire:model="description"></textarea>
                                    @error('description')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" wire:loading.remove class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        @if(isset($selected) and $selected->status_punch_list_tlp==0)
                            <button type="button" wire:click="submit_justification_complete" wire:loading.remove class="btn btn-warning"><i class="fa fa-check-circle"></i> Justification Complete</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_change_pic" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_change_pic">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Dispatch PIC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" wire:ignore>
                            <select class="form-control select2_pic">
                                <option value=""> -- Select Employee --- </option>
                                @foreach($employees as $item)
                                    <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('change_pic_id')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        <button type="submit" wire:loading.remove wire:target="change_pic_id" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_upload_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="upload_report">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($reports)
                            @foreach($reports as $item)
                                <a href="{{asset($item->image)}}" target="_blank" class="badge badge-info"> <i class="fa fa-paperclip"></i> {{$item->description}}</a>        
                            @endforeach
                            <hr />
                        @endif
                        @if(isset($selected) and $selected->is_upload_report==0)
                            <div class="form-group">
                                <label>File (xlsx, csv, xls, doc, docs, pdf, image)</label>
                                <input type="file" class="form-control" wire:model="file_report" multiple />
                                @error('file_report')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" wire:model="description_report"></textarea>
                                @error('description_report')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <span wire:loading wire:target="upload_report">
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        <span wire:loading wire:target="file_report">
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        @if(isset($selected) and $selected->is_upload_report ==0)
                            <button type="button" wire:click="pm_reject" wire:loading.remove wire:target="file_report" class="btn btn-danger"><i class="fa fa-close"></i> Reject</button>
                            <button type="submit" wire:loading.remove wire:target="file_report" class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
                            <button type="button" wire:loading.remove wire:target="file_report" wire:click="upload_with_punch_list" class="btn btn-info"><i class="fa fa-check-circle"></i> Upload with Punch List</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_import_pm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="import">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Preventive Maintenance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File (xlsx)</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                            <a href="{{asset('template/preventive-maintenance.xlsx')}}"><i class="fa fa-download"></i> Template Uploader</a> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="submit" wire:loading.remove class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_add_preventive_maintenance" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Preventive Maintenance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Site ID</label>
                                <input type="text" class="form-control" wire:model="site_id" />
                            </div>
                            <div class="form-group col-md-8">
                                <label>Site Name</label>
                                <input type="text" class="form-control" wire:model="site_name" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Site Category</label>
                                <select class="form-control" wire:model="site_category">
                                    <option value="">-- Select --</option>
                                    <option>BIG HUB</option>
                                    <option>END SITE</option>
                                    <option>MEDIUM HUB</option>
                                    <option>RAN</option>
                                    <option>RAN 3M</option>
                                    <option>RAN 6M</option>
                                    <option>SMALL HUB</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Site Type</label>
                                <select class="form-control" wire:model="site_type">
                                    <option value="">-- Select --</option>
                                    <option>TLP</option>
                                    <option>TMG</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>PM Type</label>
                                <select class="form-control" wire:model="pm_type">
                                    <option value="">-- Select --</option>
                                    @if($site_type=='TLP')
                                        <option>3M</option>
                                        <option>6M</option>
                                    @endif
                                    @if($site_type=='TMG')
                                        <option>TMG 1M</option>
                                        <option>TMG 3M</option>
                                        <option>TMG 6M</option>
                                        <option>RAN 3M</option>
                                        <option>RAN 6M</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Region</label>
                                <select class="form-control" wire:model="region_id">
                                    <option value="">-- Select --</option>
                                    @foreach($regions as $item)
                                        <option value="{{$item->id}}">{{$item->region}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Sub Region</label>
                                <select class="form-control" wire:model="sub_region_id">
                                    <option value="">-- Select --</option>
                                    @foreach($sub_regions as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Cluster</label>
                                <input type="text" class="form-control" wire:model="cluster" />
                            </div>    
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Sub Cluster</label>
                                <input type="text" class="form-control" wire:model="sub_cluster" />
                            </div>
                            <div wire:ignore class="form-group col-md-6">
                                <label>Employee (TE Only)</label>
                                <select class="form-control select2">
                                    <option value="">-- Select --</option>
                                    @foreach($employees as $item)
                                        <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="button" class="btn btn-light close-btn" data-dismiss="modal">Cancel</button>
                        <button type="submit" wire.loading.remove class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
        <script>
            Livewire.on('set-pic',()=>{
                $(".select2_pic").select2();
                $('.select2_pic').on('select2:select', function (e) {
                    var data = e.params.data;
                    @this.set('change_pic_id',data.id);
                });
            });

            $(document).ready(function() {    
                $(".select2").select2();
                $('.select2').on('select2:select', function (e) {
                    var data = e.params.data;
                    @this.set('employee_id',data.id);
                });
                
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
                Livewire.on('refresh-page',()=>{
                    $(".modal").modal("hide");
                });
            });
        </script>
    @endpush
</div>