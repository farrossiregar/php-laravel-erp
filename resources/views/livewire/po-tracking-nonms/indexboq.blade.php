@section('title', __('PO Tracking Non MS'))
@section('parentPageTitle', 'Home')
<div>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tab_dashboard_ericson">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_work_order">Work Order</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_po">Purchase Order</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane show active" id="tab_dashboard_ericson">
            @livewire('po-tracking-nonms.dashboard')
        </div>
        <div class="tab-pane" id="tab_work_order">
            <div class="header row px-0">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" wire:model="date" />
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="filter_field_team_id">
                        <option value=""> -- Field Team -- </option>
                        @foreach($filter_field_teams as $item)
                            @if(!isset($item->field_team->nik)) @continue @endif
                            <option value="{{$item->field_team_id}}">{{$item->field_team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    @if($is_e2e)
                        <a href="#" data-toggle="modal" data-target="#modal-potrackingboq-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import WO')}}</a>
                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal-potrackinginput-pono"><i class="fa fa-plus"></i> Add PO</a>
                    @endif
                   @if($sum_budget_request)
                        <span class="btn btn-warning float-right">Rp. {{format_idr($sum_budget_request)}}</span>
                   @endif
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body pt-0 px-0">    
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PO Status</th>    
                                <th>WO Number</th>    
                                <th>Sub Region</th>    
                                <th class="text-center">Status</th>    
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th class="text-right">Total Price</th>                              
                                <th class="text-right">Budget Request</th>    
                                <th class="text-center">Total Gross Margin (%)</th> 
                                <th>Coordinator</th>
                                <th>Field Team</th>
                                <th>Scope of Works</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                                @php($total_actual = $item->boq_sum_total_price)
                                @php($total_price = $item->boq_sum_input_price)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if($item->po_status==0)
                                            <label class="badge badge-info">Open</label>
                                        @endif
                                        @if($item->po_status==1)
                                            <label class="badge badge-warning">Partial</label>
                                        @endif
                                        @if($item->po_status==2)
                                            <label class="badge badge-success">Complete</label>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="checkbox" wire:model="total_price_arr.{{$key}}" value="{{$item->id}}" />

                                        <a href="{{ route('po-tracking-nonms.edit-boq',['id'=>$item->id]) }}">{{ $item->no_tt }}</a>
                                    </td>  
                                    <td>{{ $item->region }}</td>    
                                    <td class="text-center">
                                        @if($item->status==0 || $item->status == null || $item->status == '0')
                                            <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting PR Submission">Waiting PR Submission</label>
                                        @endif
                                        @if($item->status==1)
                                            <label class="badge badge-warning" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                                        @endif
                                        @if($item->status==2)
                                            <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                        @endif
                                        @if($item->status==3)
                                            <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">PMG Review</label>
                                        @endif
                                        @if($item->status==4)
                                            <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                        @endif
                                        @if($item->status==5)
                                            <label class="badge badge-info" data-toggle="tooltip">Budget Transferred To Project Admin/Finance</label>
                                        @endif
                                        @if($item->status==6)
                                            <label class="badge badge-info" data-toggle="tooltip">Pending Assignment To Field Team</label>
                                        @endif
                                        @if($item->status ==7)
                                            <label class="badge badge-info">Ongoing Execution</label>
                                        @endif
                                        @if($item->status >=8)
                                            <label class="badge badge-info" data-toggle="tooltip">Field Team Submitted</label>
                                        @endif
                                    </td>
                                    <td>{{$item->site_id}}</td>
                                    <td>{{$item->site_name}}</td>
                                    <td class="text-right">Rp {{ format_idr($total_actual) }}</td>                               
                                    <td class="text-right">Rp {{ format_idr($total_price) }}</td> 
                                    <td class="text-center">
                                        <?php
                                            if($total_price && $total_actual)
                                                $total_profit = 100 - round(($total_price / $total_actual) * 100);
                                            else
                                                $total_profit = 100;
                                            
                                            if($total_profit >= 30){
                                                $color = 'success';
                                            }else{
                                                $color = 'danger';
                                            }
                                        ?>
                                        <span class="text-<?php echo $color; ?>">{{ $total_profit }}%</span>
                                    </td>
                                    <td>
                                        @if($item->status==5 and $item->coordinator_id =='' and $is_service_manager)
                                            <a href="javascript:void(0)" data-target="#modal_select_coordinator" wire:click="set_data({{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> coordinator</a>
                                        @endif
                                        {{isset($item->coordinator->name)?$item->coordinator->name : ''}}
                                    </td>
                                    <td>
                                        @if($item->status==6 and $item->field_team_id =='' and $is_coordinator)
                                            <a href="javascript:void(0)" data-target="#modal_select_field_team" wire:click="set_data({{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> field team</a>
                                        @endif
                                        {{isset($item->field_team->name)?$item->field_team->name : ''}}
                                    </td>
                                    <td>{{$item->scoope_of_works}}</td>
                                    <td class="text-center">
                                        @if($item->bast_status)
                                            <a href="{{route('po-tracking-nonms.detailfoto',['id'=>$item->id]) }}" ><i class="fa fa-image"></i> Foto</a>
                                        @endif
                                        <a href="javascript:void(0)" wire:click="delete({{$item->id}})"><i class="fa fa-trash text-danger"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
                <br />
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

                <div class="modal fade" wire:ignore.self id="modal_select_coordinator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form wire:submit.prevent="assign_coordinator">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Select Coordinator</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                                <div class="modal-body" wire:ignore>
                                    <div class="form-group">
                                        <label>Coordinator</label>
                                        <select class="form-control select-coordinator">
                                            <option value="">-- select --</option>
                                            @foreach($field_teams as $item)
                                                <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Submit</button>
                                </div>
                                <div wire:loading wire:target="assign_coordinator">
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

                <div class="modal fade" wire:ignore.self id="modal_select_field_team" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <label>Scope of Work</label>
                                        <textarea class="form-control" wire:model="scoope_of_works"></textarea>
                                    </div>
                                    <div class="form-group" wire:ignore>
                                        <label>Field Team</label>
                                        <select class="form-control select-field-team">
                                            <option value="">-- select --</option>
                                            @foreach($field_teams as $item)
                                                <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
                                </div>
                                <div wire:loading wire:target="assign_field_team">
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
        </div>
        <div class="tab-pane" id="tab_po">
            @livewire('po-tracking-nonms.index-po')
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
</div>

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
    <script>
        $(document).ready(function() {    
            $(".select-coordinator").select2();
            $('.select-coordinator').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('coordinator_id',data.id);
            });
            $(".select-field-team").select2();
            $('.select-field-team').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('field_team_id',data.id);
            });
        });
    </script>
@endpush

<!--    MODAL PO NON MS INPUT PO NO      -->
<div class="modal fade" id="modal-potrackinginput-pono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.add-po />
        </div>
    </div>
</div>
<style>
    .select2-container .select2-selection--single {height:36px !important;}
</style>
<!--    MODAL PO NON MS INPUT PO NO      -->
@livewire('po-tracking-nonms.extra-budget')
@livewire('po-tracking-nonms.process-extra-budget')
@push('after-scripts')
    <script>
        Livewire.on('modal-boq',(data)=>{
            $("#modal-potrackingboq-upload").modal('show');
        });
    </script>
@endpush