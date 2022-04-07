@section('title', __('PO Tracking Non MS'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <b><h5>{{$po_tracking->no_tt}}</h5></b> 
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped m-b-0 c_list table-nowrap-th">
                                            <tr>
                                                <th>Total Ericsson Price</th>                               
                                                <th>Total Price After Input</th>                                                          
                                                <th>Total Profit After Input (%)</th>         
                                                <th class="text-center">Status</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Rp {{ format_idr($total_ericson) }}</td>                               
                                                <td class="text-center">Rp {{ format_idr(@$total_after[0]->input_price) }}</td>    
                                                <td class="text-center"><div class="btn btn-{{$total_profit >= 30 ? 'success' : 'danger' }}">{{ $total_profit }}%</div></td>       
                                                <td  class="text-center">
                                                    @if($status==0 || $status == null || $status == '0')
                                                        @if($po_tracking->is_revise_finance==1)
                                                            <label class="badge badge-info" data-toggle="tooltip" title="{{$po_tracking->note_finance}}">Revise Finance</label>
                                                        @else
                                                            <label class="badge badge-info" data-toggle="tooltip" title="Regional - Waiting PR Submission">Waiting PR Submission</label>
                                                        @endif
                                                    @endif
                                                    @if($status==1)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance Review</label>
                                                    @endif
                                                    @if($status==2)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance Approved</label>
                                                    @endif
                                                    @if($status==3)
                                                        <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                                                    @endif
                                                    @if($status==4)
                                                        <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                                    @endif
                                                    @if($status==5)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="Finance - Budget Successfully Transfered">Budget Transferred To Project Admin/Finance</label>
                                                    @endif
                                                    @if($status==6)
                                                        <label class="badge badge-success" data-toggle="tooltip">Pending Assignment To Field Team</label>
                                                    @endif
                                                    @if($status==7 && $bast_status == 1)
                                                        <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">Waiting Approval </label>
                                                    @endif
                                                    @if($status==7 && $bast_status == 2)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                                                    @endif
                                                    @if($status==7 && $bast_status == 3)
                                                        <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Revisi</label>
                                                    @endif
                                                    @if($status==8)
                                                        <label class="badge badge-danger" data-toggle="tooltip" title="Finance - Upload Approved Acceptance docs and Invoice">Finance</label>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                                <tr>
                                    <th>No</th>       
                                    <th>PO</th>
                                    <th>PO Line Item</th>
                                    <th>SNo Material</th>
                                    <th>SNO Rectification</th>                            
                                    <th>Category Material</th>                               
                                    <th>Item Code</th>                             
                                    <th>Item Description</th>                               
                                    <th>UOM</th>                               
                                    <th>Quantity</th>                            
                                    <th>Customer Price</th>     
                                    <th>Total Price</th>                              
                                    <th>Budget Request</th>    
                                    <th>Total After Price PR</th>                               
                                    <th>Profit (%)</th>                                                              
                                </tr>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>     
                                    <td class="text-center">{{$item->po}}</td>                               
                                    <td class="text-center">@livewire('po-tracking-nonms.editable',['data'=>$item,'field'=>'po_line_item'],key((int)$item->id+10))</td>                               
                                    <td class="text-center">{{$item->sno_material}}</td>                               
                                    <td class="text-center">{{$item->sno_rectification}}</td>                           
                                    <td>{{ $item->category_material }}</td>                               
                                    <td>{{ $item->item_code }}</td>                     
                                    <td>{{ $item->item_description }}</td>                               
                                    <td class="text-center">{{ $item->uom }}</td>                               
                                    <td class="text-center">{{ $item->qty }}</td>            
                                    <td>Rp {{ format_idr($item->price) }}</td>   
                                    <td>Rp {{ format_idr($item->qty * $item->price) }}</td>                             
                                    <td>
                                        @if(check_access('po-tracking-nonms.input-price'))
                                            @if($item->input_price == null || $item->input_price == '')
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Input Price" class="badge badge-primary badge-active"><i class="fa fa-plus"></i> {{__('Input Price')}}</a>
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Input Price"><i class="fa fa-edit"></i></a>
                                            @endif
                                        @endif
                                        Rp {{ format_idr($item->input_price) }}
                                    </td>  
                                    <td>Rp. {{format_idr($item->input_price)}}</td>                                                             
                                    <td><div class="text-{{$item->profit >= 30 ? 'success' : 'danger'}}">{{ $item->profit }}%</div></td>                                  
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @if(isset($po_tracking->bukti_transfer))
                            <br />
                            @foreach($po_tracking->bukti_transfer as $bukti_transfer)
                                <p><a href="{{asset($bukti_transfer->file)}}" target="_blank"><i class="fa fa-image"></i> File Transfer</a></p>
                            @endforeach
                        @endif
                        @if(isset($po_tracking->note_finance))
                            <br />
                            <p><strong>Note Finance :<br/> </strong> {{$po_tracking->note_finance}}</p>
                        @endif
                    </div>
                    @if(check_access('po-tracking-nonms.status-doc'))
                        @if($status == '3' || $status == '0' || $status == '' || $status == null)
                            <div class="btn btn-warning"> Waiting Approval</div>
                        @endif
                    @endif
                    <div class="col-md-12">
                        <hr />
                        <a href="{{route('po-tracking-nonms.index')}}" class="mr-3"><i class="fa fa-arrow-left"></i> Back</a>
                        @if(check_access('po-tracking-nonms.approve-pmg'))
                            @if($status == 3)
                                <a href="javascript:;" wire:click="$emit('modalapprovepononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-approve" title="Proccess" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{__('Proccess')}}</a>
                            @endif
                        @endif
                        @if($is_finance)
                            @if($status == 1)
                                <a href="javascript:;" data-toggle="modal" data-target="#modal-approve-finance" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{__('Process Budget')}}</a>                    
                            @endif
                        @endif
                        @if($status == 2)
                            @if($is_finance)
                                <a href="javascript:;" wire:click="$emit('modalsubmitfinreg','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submitfinreg" title="Submit to Finance Regional" class="btn btn-primary"><i class="fa fa-check-circle"></i> {{__('Transfer Budget')}}</a>                    
                            @endif
                        @endif
                        @if($is_service_manager)
                            @if($status == '0' || $status == '' || $status == null)
                                <a href="javascript:;" wire:click="$emit('modalsubmitdocpononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submit" title="Submit Request" class="btn btn-primary"><i class="fa fa-check"></i> {{__('Submit Request')}}</a>                                  
                            @endif
                        @endif
                        <!--    End Submit to Finance or PMG by Regional    -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" wire:ignore.self id="modal-approve-finance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Confirm Budget</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <p>Process budget request ?</p>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" wire:model="note" placeholder="Note / Remark"></textarea>
                        @error('note')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="finance_reject_budet" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
                    <button type="button" wire:click="finance_approve_budget" class="btn btn-info"><i class="fa fa-check-circle"></i> Approve</button>
                </div>
                <div wire:loading wire:target="finance_reject_budet">
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
                <div wire:loading wire:target="finance_approve_budget">
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
</div>
<!--    MODAL INPUT PRICE BOQ      -->
<div class="modal fade" id="modal-pononmsboq-priceinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.inputpriceboq />
        </div>
    </div>
</div>
<!--    END MODAL INPUT PRICE BOQ        -->
<!--    MODAL SUBMIT DOCUMENT      -->
<div class="modal fade" id="modal-potrackingnonms-submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.submitdoc />
        </div>
    </div>
</div>
<!--    END MODAL MODAL SUBMIT DOCUMENT        -->
<!--    MODAL SUBMIT TO FINANCE REGIONAL      -->
<div class="modal fade" id="modal-potrackingnonms-submitfinreg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.submitfinreg />
        </div>
    </div>
</div>
<!--    END MODAL SUBMIT TO FINANCE REGIONAL        -->
<!--    MODAL APPROVE DOCUMENT PMG      -->
<div class="modal fade" id="modal-potrackingnonms-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.approvedocpmg />
        </div>
    </div>
</div>
<!--    END MODAL APPROVE DOCUMENT PMG        -->
@push('after-scripts')
<script>
    Livewire.on('modalinputboqprice',(data)=>{
        console.log(data);
        $("#modal-pononmsboq-priceinput").modal('show');
    });
    Livewire.on('modalsubmitdocpononms',(data)=>{
        $("#modal-potrackingnonms-submit").modal('show');
    });
    Livewire.on('modalsubmitfinreg',(data)=>{
        $("#modal-potrackingnonms-submitfinreg").modal('show');
    });
    Livewire.on('modalapprovepononms',(data)=>{
        $("#modal-potrackingnonms-approve").modal('show');
    });
</script>
@endpush






