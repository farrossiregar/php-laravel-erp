@section('title', __('PO Tracking Non MS Ericson'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <b><h5>PO Tracking Non MS Ericson</h5></b> 
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped m-b-0 c_list">
                                            <tr>
                                                <th>Total Ericson Price</th>                               
                                                <th>Total Price After Input</th>                                                          
                                                <th>Total Profit After Input (%)</th>         
                                                <th class="text-center">Status</th>
                                            </tr>

                                            <tr>
                                                <td class="text-center">Rp {{ format_idr($total_before[0]->price) }}</td>                               
                                                <td class="text-center">Rp {{ format_idr($total_after[0]->input_price) }}</td>    
                                                <td class="text-center"><div class="btn btn-{{$total_profit >= 30 ? 'success' : 'danger' }}">{{ $total_profit }}%</div></td>       
                                                <td  class="text-center">
                                                    @if($status==0 || $status == null || $status == '0')
                                                        <label class="badge badge-info" data-toggle="tooltip" title="Regional - Waiting to Submit">Waiting to Submit</label>
                                                    @endif
                                                    @if($status==1)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                                    @endif
                                                    @if($status==2)
                                                        <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                                                    @endif
                                                    @if($status==3)
                                                        <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                                    @endif
                                                    @if($status==4)
                                                    <label class="badge badge-success" data-toggle="tooltip" title="Finance - Budget Successfully Transfered">Finance Regional - Budget Transfered</label>
                                                    @endif
                                                    @if($status==5 && $bast_status == 1)
                                                        <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">Waiting Approval </label>
                                                    @endif
                                                    @if($status==5 && $bast_status == 2)
                                                        <label class="badge badge-success" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                                                    @endif
                                                    @if($status==5 && $bast_status == 3)
                                                        <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Revisi</label>
                                                    @endif
                                                    @if($status==6)
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
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>Project Code</th>                               
                                    <th>Item Code</th>                               
                                    <th>Site Id</th>                               
                                    <th>Site Name</th>                               
                                    <th>Item Description</th>                               
                                    <th>UOM</th>                               
                                    <th>Quantity</th>                               
                                    <th>Supplier</th>                               
                                    <th>Region</th>                               
                                    <th>Remark</th>                               
                                    <th>Reff</th>                                
                                    <th>Price</th>     
                                    <th>Total Price</th>                              
                                    <th>Input Price</th>    
                                    <th>Total After Input</th>                               
                                    <th>Profit (%)</th>                                                               
                                </tr>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>                               
                                    <td>{{ $item->project }}</td>                               
                                    <td>{{ $item->item_code }}</td>                               
                                    <td>{{ $item->site_id }}</td>                               
                                    <td>{{ $item->site_name }}</td>                               
                                    <td>{{ $item->item_description }}</td>                               
                                    <td>{{ $item->uom }}</td>                               
                                    <td>{{ $item->qty }}</td>                               
                                    <td>{{ $item->supplier }}</td>                               
                                    <td>{{ $item->region }}</td>                               
                                    <td>{{ $item->remark }}</td>                               
                                    <td>{{ $item->reff }}</td>                               
                                    <td>Rp {{ format_idr($item->price) }}</td>   
                                    <td>Rp {{ format_idr($item->qty * $item->price) }}</td>                             
                                    <td>
                                        @if(check_access('po-tracking-nonms.input-price'))
                                            @if($item->input_price == null || $item->input_price == '')
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Input Price" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Price')}}</a>
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Input Price" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                            @endif
                                        @endif
                                        Rp {{ format_idr($item->input_price) }}
                                    </td>  
                                    <td>
                                        <?php
                                            echo 'Rp '. format_idr($item->qty * $item->input_price);
                                        ?>
                                    </td>                                                             
                                    <td><div class="btn btn-{{$item->profit >= 30 ? 'success' : 'danger'}}">{{ $item->profit }}%</div></td>                                   
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @if(check_access('po-tracking-nonms.status-doc'))
                        @if($status == '3' || $status == '0' || $status == '' || $status == null)
                            <div class="btn btn-warning"> Waiting Approval</div>
                        @endif
                    @endif
                    <div class="col-md-12">
                        <hr />
                        <a href="{{route('po-tracking-nonms.index')}}" class="mr-3"><i class="fa fa-arrow-left"></i> Back</a>
                        <!--    Approve BOQ by PMG   -->
                        @if(check_access('po-tracking-nonms.approve-pmg'))
                            @if($status == 3)
                                <a href="javascript:;" wire:click="$emit('modalapprovepononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-approve" title="Proccess" class="btn btn-primary">{{__('Proccess')}} <i class="fa fa-arrow-right"></i></a>
                            @else
                                <!-- @if($status == 1)
                                    <div class="btn btn-success"> Approved </div>
                                @endif

                                @if($status == 2)
                                    <div class="btn btn-danger"> Revised </div>
                                @endif

                                @if($status == 0)
                                    <div class="btn btn-warning"> Waiting to Submitted </div>
                                @endif -->
                            @endif
                        @endif
                        <!--    End Approve BOQ by PMG   -->

                        <!--    Submit to Finance or PMG by Regional   -->
                        @if(check_access('po-tracking-nonms.submit-doc'))
                            @if($status == 1)
                                <a href="javascript:;" wire:click="$emit('modalsubmitfinreg','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submitfinreg" title="Submit to Finance Regional" class="btn btn-primary"> {{__('Submit To Finance Regional')}}</a>                    
                            @endif
                            <!-- @if($status == '2')
                                <span class="btn btn-danger"> Revised </span>
                            @endif -->
                            @if($status == '0' || $status == '' || $status == null || $status == '3' || $status == '2')
                                <a href="javascript:;" wire:click="$emit('modalsubmitdocpononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submit" title="Submit Price" class="btn btn-primary"><i class="fa fa-check"></i> {{__('Submit Price')}}</a>                                  
                            @endif
                        @endif
                        <!--    End Submit to Finance or PMG by Regional    -->
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






