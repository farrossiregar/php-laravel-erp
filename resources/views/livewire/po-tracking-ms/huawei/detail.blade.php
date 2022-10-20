@section('title', $po_no)
@section('parentPageTitle', __('PO Tracking MS'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
                </div>
                <div class="col-md-10">
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body">    
                <div class="table-responsive" style="min-height:200px;">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>PO Line Shipment</th>  
                                <th>Site ID</th>    
                                <th>Site Name</th>       
                                <th>Item Description</th>    
                                <th>UOM</th>    
                                <th>QTY</th>    
                                <th>Unit Price</th>    
                                <th>Total Amount</th>    
                                <th>BOS Approved</th>    
                                <th>GM Approved</th>    
                                <th>GH Approved</th>    
                                <th>Director Approved</th>    
                                <th>Verification</th>    
                                <th>Acceptance Submit</th>    
                                <th>Acceptance Complete Approval</th>    
                                <th>Deduction (%)</th>    
                                <th>EHS Deduction / Other Deduction</th>    
                                <th class="text-right">RP Deduction</th>    
                                <th>Scar No</th>    
                                <th>Have Deduction</th>
                                <th>Regional Reconciliation</th>
                                <th>BOS Approval</th>
                                <th>Customer GM Approval</th>
                                <th>Customer GH Approval</th>
                                <th>Customer OD (Operation Director) Approval</th>
                                <th>Verification</th>
                                <th>Approval and Verification Docs</th>
                                <th>Acceptance Docs</th>
                                <th>Invoice Docs</th>
                                <th>VAT (%)</th>
                                <th class="text-right">Total Price</th>
                                <th>Total WHT (%)</th>
                                <th class="text-right">Invoice Amount</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td class="text-center">
                                        @if($item->status_==1 || $item->status_=="")
                                            @if($item->pds_amount)
                                                <span class="badge badge-warning">Regional</span>
                                            @else
                                                <span class="badge badge-info">Regional</span>
                                            @endif
                                        @endif
                                        @if($item->status_==2)
                                            <span class="badge badge-info">E2E Review</span>
                                        @endif
                                        @if($item->status_==3)
                                            <span class="badge badge-info">E2E Upload PDS</span>
                                        @endif
                                        @if($item->status_==4)
                                            <span class="badge badge-info" title="Finance Upload Acceptance Docs & Invoice">Finance</span>
                                        @endif
                                        @if($item->status_==5)
                                            <span class="badge badge-success"><i class="fa fa-check-circle"></i> Done</span>
                                        @endif
                                    </td>
                                    </td>
                                    <td>{{ $item->po_line_shipment }}</td>
                                    <td>{{ $item->site_id }}</td>
                                    <td>{{ $item->site_name }}</td>
                                    <td>{{ $item->item_description }}</td>
                                    <td class="text-center">{{ $item->uom }}</td>
                                    <td class="text-center">@livewire('po-tracking-ms.huawei.editable',['data'=>$item,'field'=>'qty','value'=>$item->qty],key('qty'.$item->id))</td>
                                    <td class="text-right">{{ format_idr($item->unit_price) }}</td>
                                    <td class="text-right">{{ format_idr($item->total_amount) }}</td>
                                    <td>{{ $item->bos_approved }}</td>
                                    <td>{{ $item->gm_approved }}</td>
                                    <td>{{ $item->gh_approved }}</td>
                                    <td>{{ $item->director_approved }}</td>
                                    <td>{{ $item->verification }}</td>
                                    <td>{{ $item->acceptance }}</td>
                                    <td></td>
                                    <td class="text-center">@livewire('po-tracking-ms.huawei.editable',['data'=>$item,'field'=>'deduction','value'=>$item->deduction],key('deduction'.$item->id))</td>
                                    <td>@livewire('po-tracking-ms.huawei.editable',['data'=>$item,'field'=>'ehs_other_deduction','value'=>$item->ehs_other_deduction],key('ehs_other_deduction'.$item->id))</td>
                                    <td class="text-right">{{ format_idr($item->rp_deduction,2) }}</td>
                                    <td>@livewire('po-tracking-ms.huawei.editable',['data'=>$item,'field'=>'scar_no','value'=>$item->scar_no],key('scar_no'.$item->id))</td>
                                    <td class="text-center">
                                        @if($item->is_have_deduction==NULL)
                                            <a href="javascript:void" wire:loading.remove wire:target="set_have_deduction({{$item->id}},1)" wire:click="set_have_deduction({{$item->id}},1)" class="badge badge-success">Yes</a>
                                            <a href="javascript:void" wire:loading.remove wire:target="set_have_deduction({{$item->id}},2)" wire:click="set_have_deduction({{$item->id}},2)" class="badge badge-danger">No</a>
                                            <span wire:loading wire:target="set_have_deduction({{$item->id}},1)">
                                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                                <span class="sr-only">{{ __('Loading...') }}</span>
                                            </span>
                                            <span wire:loading wire:target="set_have_deduction({{$item->id}},2)">
                                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                                <span class="sr-only">{{ __('Loading...') }}</span>
                                            </span>
                                        @endif
                                        @if($item->is_have_deduction==1)
                                            <span class="text-success">Yes</span>
                                        @endif
                                        @if($item->is_have_deduction==2)
                                            <span class="text-danger">No</span>
                                        @endif
                                    </td>
                                    </td>
                                    <td class="text-center">
                                        @if($item->is_regional_reconciliation)
                                            <a href="{{asset($item->is_regional_reconciliation_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-target="#modal_upload_progress_huawei" data-toggle="modal" wire:click="set_selected({{$item->id}},'is_regional_reconciliation')" class="text-danger"><i class="fa fa-times"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->bos_approval_file)
                                            <a href="{{asset($item->bos_approval_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-target="#modal_upload_bos" data-toggle="modal" wire:click="set_selected({{$item->id}},'is_regional_reconciliation')" class="text-danger"><i class="fa fa-times"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->is_customer_gm)
                                            <a href="{{asset($item->is_customer_gm_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-target="#modal_upload_progress_huawei" data-toggle="modal" wire:click="set_selected({{$item->id}},'is_customer_gm')" class="text-danger"><i class="fa fa-times"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->is_customer_gh)
                                            <a href="{{asset($item->is_customer_gh_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-target="#modal_upload_progress_huawei" data-toggle="modal" wire:click="set_selected({{$item->id}},'is_customer_gh')" class="text-danger"><i class="fa fa-times"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->is_customer_od)
                                            <a href="{{asset($item->is_customer_od_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <a href="javascript:void(0)" data-target="#modal_upload_progress_huawei" data-toggle="modal" wire:click="set_selected({{$item->id}},'is_customer_gh')" class="text-danger"><i class="fa fa-times"></i></a>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->is_verification)
                                            <a href="{{asset($item->is_verification_file)}}" target="_blank"><i class="text-success fa fa-check-circle"></i></a>
                                        @else
                                            <i class="text-danger fa fa-times"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->approval_file)
                                            <a href="{{asset($item->approval_file)}}"><i class="fa fa-download"></i> </a>
                                            <a href="{{asset($item->file_verification)}}"><i class="fa fa-download"></i> Verification Docs</a><br />
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->file_verification and $item->acceptance_doc)
                                            <a href="{{asset($item->acceptance_doc)}}"><i class="fa fa-download"></i> Acceptance Docs</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->invoice_doc)
                                            <a href="{{asset($item->invoice_doc)}}"><i class="fa fa-download"></i></a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">{{$item->vat}}</td>
                                    <td class="text-right">{{format_idr($item->total_amount+$item->ehs_other_deduction+$item->rp_deduction)}}</td>
                                    <td class="text-center">{{$item->wht}}</td>
                                    <td class="text-right">{{format_idr($item->invoice_amount)}}</td>
                                    <td>
                                        @if($is_service_manager)
                                            @if($item->status_==1 || $item->status_=="")
                                                <a href="javascript:void(0)" wire:click="set_selected({{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_regional_proccess_huawei"><i class="fa fa-upload"></i> Process</a>
                                            @endif
                                        @endif
                                        @if($is_e2e)
                                            @if($item->status_==3)
                                                <a href="javascript:void(0)" wire:click="set_selected({{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_upload_pds_huawei"><i class="fa fa-upload"></i> Upload PDS</a>
                                            @endif
                                            @if($item->status_==2)
                                                <a href="javascript:void(0)" wire:click="set_selected({{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_upload_verification_huawei"><i class="fa fa-upload"></i> Upload Verification</a>
                                            @endif
                                        @endif
                                        @if($is_finance and $item->status_==4)
                                            <a href="javascript:void(0)" wire:click="set_selected({{$item->id}})" data-toggle="modal" data-target="#modal_upload_acceptance_huawei"><i class="fa fa-upload"></i> Acceptance & <br />Verification</a>
                                        @endif
                                        <a href="javascript:void(0)" wire:loading.remove wire:target="delete({{$item->id}})" class="text-danger" wire:click="delete({{$item->id}})"><i class="fa fa-trash"></i></a>
                                        <span wire:loading wire:target="delete({{$item->id}})">
                                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                            <span class="sr-only">{{ __('Loading...') }}</span>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" wire:ignore.self id="modal_upload_bos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form wire:submit.prevent="submit_bos">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload BOS</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>File (xlsx)</label>
                                <input type="file" class="form-control" wire:model="bos_approval_file" />
                                @error('bos_approval_file')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                        <div wire:loading wire:target="submit_verification">
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

            <div class="modal fade" wire:ignore.self id="modal_upload_progress_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <form wire:submit.prevent="update_progress">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Progress</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true close-btn">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>File (xlsx)</label>
                                <input type="file" class="form-control" wire:model="file_progress" />
                                @error('file_progress')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                        <div wire:loading wire:target="submit_verification">
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

            <div class="modal fade" wire:ignore.self id="modal_upload_verification_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="submit_verification">
                            @csrf
                            <div class="modal-header">
                                <h6 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Approved Verification and Acceptance Docs</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Acceptance Docs</label>
                                    <input type="file" class="form-control" wire:model="acceptance_doc" />
                                    @error('acceptance_doc')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                            <div wire:loading wire:target="submit_verification">
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

            <div class="modal fade" wire:ignore.self id="modal_upload_acceptance_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="submit_acceptance">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Invoice PO Number : {{isset($selected->po_no)?$selected->po_no:'-'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="form-group">
                                    <label>Acceptance</label>
                                    <input type="file" class="form-control" wire:model="acceptance_doc" />
                                    @error('acceptance_doc')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div> -->
                                <div class="form-group">
                                    <label>Invoice Docs</label>
                                    <input type="file" class="form-control" wire:model="invoice_doc" />
                                    @error('invoice_doc')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Invoice Amount</label>
                                    <input type="file" class="form-control" wire:model="invoice_amount" />
                                    @error('invoice_amount')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>VAT</label>
                                        <input type="number" class="form-control" wire:model="vat" />
                                    </div>
                                    <div class="col-md-6">
                                        <label>WHT</label>
                                        <input type="number" class="form-control" wire:model="wht" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                            <div wire:loading wire:target="submit_acceptance">
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

            <div class="modal fade" wire:ignore.self id="modal_upload_pds_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="submit_pds">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload PDS PO Number : {{isset($selected->po_no)?$selected->po_no:'-'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>PDS File</label>
                                    <input type="file" class="form-control" wire:model="pds_file" />
                                    @error('pds_file')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>PDS Amount</label>
                                    <input type="number" class="form-control" wire:model="pds_amount" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                            <div wire:loading wire:target="submit_pds">
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

            <div class="modal fade" wire:ignore.self id="modal_regional_proccess_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="process_regional">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Process PO Number : {{isset($selected->po_no)?$selected->po_no:'-'}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(isset($selected->id) and $selected->is_have_deduction==0)
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" wire:model="is_have_deduction" value="1">
                                            <span>Have Deduction</span>
                                        </label>
                                        <p id="error-checkbox"></p>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>Verification Docs</label>
                                    <input type="file" class="form-control" wire:model="file_verification" />
                                    @error('file_verification')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                    @enderror
                                </div>
                                @if($is_have_deduction==0)
                                    <div class="form-group">
                                        <label>Upload Approval Docs</label>
                                        <input type="file" class="form-control" wire:model="approval_file" />
                                        @error('approval_file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info close-modal"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                            <div wire:loading wire:target="process_regional">
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

            <div class="modal fade" id="modal_upload_huawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Huawei</h5>
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
    </div>
</div>