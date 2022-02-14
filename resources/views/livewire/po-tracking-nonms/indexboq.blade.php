@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')
<div>
    <div class="header row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="date" />
        </div>
        @if(check_access('po-tracking-nonms.edit-boq'))
            <div class="col-md-2">
                <a href="#" data-toggle="modal" data-target="#modal-potrackingboq-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO')}}</a>
            </div>
        @endif
    </div>
    <div class="body pt-0">    
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>PO No</th>    
                        <th>WO Number</th>    
                        <th>Region</th>    
                        <th class="text-center">Status</th>    
                        <th>Transfer</th>
                        <th>Note from PMG</th>    
                        <th>Note Bast from E2E</th>
                        <th>Customer Price</th>
                        <th>PR Price</th>
                        <th>Total Profit Margin</th>
                        <th>Coordinator</th>
                        <th>Field Team</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(check_access('po-tracking-nonms.po-no'))
                                @if($item->po_no != null || $item->po_no != '')
                                    {{ $item->po_no }}
                                @else
                                    <a href="javascript:;" wire:click="$emit('modalinputpono','{{$item->id}}')" class="badge badge-info badge-active"  data-toggle="modal" data-target="#modal-potrackinginput-pono" title="Upload"> <i class="fa fa-plus"></i> {{__('PO No')}}</a>
                                @endif
                            @else
                                @if($item->po_no != null || $item->po_no != '')
                                    {{ $item->po_no }}
                                @else
                                    <span class="badge badge-danger"> Waiting PO No</span>
                                @endif
                            @endif
                        </td>    
                        <td><a href="{{ route('po-tracking-nonms.edit-boq',['id'=>$item->id]) }}">{{ $item->no_tt }}</a></td>  
                        <td>{{ $item->region }}</td>    
                        <td class="text-center">
                            @if($item->status==0 || $item->status == null || $item->status == '0')
                                <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting to Submit">Waiting to Submit</label>
                            @endif
                            @if($item->status==1)
                                <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                            @endif
                            @if($item->status==2)
                                <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                            @endif
                            @if($item->status==3)
                                <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                            @endif
                            @if($item->status==4)
                                <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                            @endif
                            @if($item->status==5)
                                <label class="badge badge-info" data-toggle="tooltip">Budget Transfer</label>
                            @endif
                            @if($item->status==6)
                                <label class="badge badge-info" data-toggle="tooltip">Proccess Field Team</label>
                            @endif
                            @if($item->status==7 && $item->bast_status == 1)
                                <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">BAST - Waiting Approval </label>
                            @endif
                            @if($item->status==7 && $item->bast_status == 2)
                                <label class="badge badge-info" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                            @endif
                            @if($item->status==7 && $item->bast_status == 3)
                                <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Revisi</label>
                            @endif
                            @if($item->status==8)
                                <label class="badge badge-info" data-toggle="tooltip" title="E2E - Upload approved BAST & GR from customer">Upload BAST & GR</label>
                            @endif
                            @if($item->status==9)
                                <label class="badge badge-danger" data-toggle="tooltip" title="Finance - Upload Approved Acceptance docs and Invoice">Finance</label>
                            @endif
                            @if($item->status==10)
                                <a href="javascript:void(0)" class="badge badge-success"  wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_end"><i class="fa fa-check-circle"></i> End</a>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(isset($item->bukti_transfer))
                                @foreach($item->bukti_transfer as $bukti_transfer)
                                    <a href="{{asset($bukti_transfer->file)}}" title="Finance - Budget Successfully Transfered" target="_blank"><i class="fa fa-image"></i> </a> 
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $item->status_note }}</td>    
                        <td>{{ $item->bast_status_note }}</td>
                        <td>Rp {{ format_idr(get_total_price($item->id)) }}</td> 
                        <td>Rp {{ format_idr(get_total_actual_price($item->id)) }}</td>                               
                        <td>
                            <?php
                                if(get_total_price($item->id) && get_total_actual_price($item->id))
                                    $total_profit = 100 - round((get_total_price($item->id) / get_total_actual_price($item->id)) * 100);
                                else
                                    $total_profit = '100';
                                
                                if($total_profit >= 30){
                                    $color = 'success';
                                }else{
                                    $color = 'danger';
                                }
                            ?>
                            <span class="text-<?php echo $color; ?>">{{ $total_profit }}%</span>
                            / Rp {{ format_idr(get_extra_budget($item->id)) }}</td>
                        <td>
                            @if($item->status==5 and $item->coordinator_id =='' and $is_service_manager)
                                <a href="javascript:void(0)" data-target="#modal_select_coordinator" wire:click="set_data({{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> coordinator</a>
                            @endif
                            {{isset($item->coordinator->name)?$item->coordinator->name : ''}}
                        </td>
                        <td>
                            @if($item->status==5 and $item->field_team_id =='' and $is_coordinator)
                                <a href="javascript:void(0)" data-target="#modal_select_field_team" wire:click="set_data({{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> field team</a>
                            @endif
                            {{isset($item->field_team->name)?$item->field_team->name : ''}}
                        </td>
                        <td>
                            @if(check_access('po-tracking-nonms.import-grcust') and $item->status==8)
                                <a href="javascript:;" class="badge badge-info badge-active" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_e2e_upload_bast_gr"><i class="fa fa-upload"></i> Upload BAST & GR</a>
                            @endif
                            @if(check_access('po-tracking-nonms.detail-photo'))
                                @if($item->bast_status == '')
                                    <a href="{{route('po-tracking-nonms.detailfoto',['id'=>$item->id]) }}" ><i class="fa fa-eye"></i> Detail Foto</a>
                                @endif
                            @endif
                            @if(check_access('po-tracking-nonms.preview-bast'))
                                @if($item->bast_status == 1 || $item->bast_status == 3)
                                    <a href="javascript:;" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_bast" wire:click="$emit('listen-bast',{{$item->id}})"><i class="fa fa-check-circle"></i> Review BAST</a>
                                @endif
                            @endif
                            @if(check_access('po-tracking-nonms.import-approvedbast') and $item->status==7 and $item->bast_status==2)
                                <a href="javascript:;" class="badge badge-info badge-active" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_e2e_review"><i class="fa fa-check-circle"></i> Review</a>
                            @endif
                            @if(check_access('po-tracking-nonms.upload-accdoc'))
                                @if($item->status == 9 and $item->bast_status==2)
                                    <a href="javascript:;" wire:click="$emit('modalimportaccdoc',{{$item->id}})"  data-toggle="modal" data-target="#modal-potrackingnonms-importaccdoc" title="Upload" class="badge badge-info badge-active"><i class="fa fa-upload"></i> {{__('Acceptance Docs & Invoice')}}</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <br />

        <div class="modal fade" wire:ignore.self id="modal_end" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="e2e_upload_bast_and_gr">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if(isset($selected_data))
                                <div class="form-group">
                                    <a href="{{asset($selected_data->approved_bast)}}" target="_blank"><i class="fa fa-download"></i> Approved BAST</a>
                                </div>
                                <div class="form-group">
                                    <a href="{{asset($selected_data->gr_cust)}}" target="_blank"><i class="fa fa-download"></i> GR From Customer</a>
                                </div>
                                <div class="form-group">
                                    <a href="{{asset($selected_data->acc_doc)}}" target="_blank"><i class="fa fa-download"></i> Acceptance</a>
                                </div>
                                <div class="form-group">
                                    <a href="{{asset($selected_data->file_invoice)}}" target="_blank"><i class="fa fa-download"></i> Invoice</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" wire:ignore.self id="modal_e2e_upload_bast_gr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="e2e_upload_bast_and_gr">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Review</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>BAST</label>
                                <span wire:loading wire:target="file_bast">
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </span>
                                <input type="file" class="form-control" wire:model="file_bast" wire:loading.remove wire:target="file_bast" />
                                @error('file_bast')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>GR</label>
                                <span wire:loading wire:target="file_gr">
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </span>
                                <input type="file" class="form-control" wire:model="file_gr" wire:loading.remove wire:target="file_gr" />
                                @error('file_gr')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                        <div wire:loading wire:target="e2e_reject_bast">
                            <div class="page-loader-wrapper" style="display:block">
                                <div class="loader" style="display:block">
                                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                    <p>Please wait...</p>
                                </div>
                            </div>
                        </div>
                        <div wire:loading wire:target="e2e_approve_bast">
                            <div class="page-loader-wrapper" style="display:block">
                                <div class="loader" style="display:block">
                                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                    <p>Please wait...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" wire:ignore.self id="modal_e2e_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <a href="{{$url_bast}}" target="_blank"><i class="fa fa-download"></i> Download BAST</a>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" wire:model="note" placeholder="Note / Remark"></textarea>
                            @error('note')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="e2e_reject_bast" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
                        <button type="button" wire:click="e2e_approve_bast" class="btn btn-success"><i class="fa fa-check-circle"></i> Approve</button>
                    </div>
                    <div wire:loading wire:target="e2e_reject_bast">
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>Please wait...</p>
                            </div>
                        </div>
                    </div>
                    <div wire:loading wire:target="e2e_approve_bast">
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>Please wait...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" wire:ignore.self id="modal_select_coordinator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="assign_coordinator">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Select Coordinator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Coordinator</label>
                                <select class="form-control" wire:model="coordinator_id" wire:ignore>
                                    <option value="">-- select --</option>
                                    @foreach($coordinators as $item)
                                        <option value="{{$item->employee_id}}">{{$item->employee_name}}</option>
                                    @endforeach
                                </select>
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

        <div class="modal fade" wire:ignore.self id="modal_select_field_team" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form wire:submit.prevent="assign_field_team">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Select Field Team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Field Team</label>
                                <select class="form-control" wire:model="field_team_id" wire:ignore>
                                    <option value="">-- select --</option>
                                    @foreach($field_teams as $item)
                                        <option value="{{$item->employee_id}}">{{$item->employee_name}}</option>
                                    @endforeach
                                </select>
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

    <!--    MODAL PO BOQ      -->
    <div class="modal fade" id="modal-potrackingboq-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:po-tracking-nonms.importboq />
            </div>
        </div>
    </div>
    <!--    MODAL PO BOQ      -->
    @section('page-script')
    <script>
        Livewire.on('modal-boq',(data)=>{
            console.log(data);
            $("#modal-potrackingboq-upload").modal('show');
        });
    </script>
    @endsection
</div>