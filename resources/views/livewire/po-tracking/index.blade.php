@section('title', __('PO Tracking'))
{{-- @section('parentPageTitle', 'Home') --}}

<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data-po-tracking">{{ __('Data PO Tracking') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="dashboard">
                </div>
                <div class="tab-pane" id="data-po-tracking">
                    <div class="header row">
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div>
                        @if(check_access('po-tracking.import'))
                        <div class="col-md-1">
                            <a href="#" data-toggle="modal" data-target="#modal-potracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking Reimbursement')}}</a>
                        </div>
                        @endif
                    </div>
                    
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>                               
                                        <th>ID</th>  
                                        <th>Change History</th> 
                                        <th>Rep Office</th>  
                                        <th>Customer</th>  
                                        <th>Project Name</th>  
                                        <th>Project Code</th>  
                                        <th>Site ID</th>  
                                        <th>Sub Contract NO</th>  
                                        <th>PR NO</th>  
                                        <th>Sales Contract NO</th>  
                                        <th>PO Status</th>  
                                        <th>PO NO</th>  
                                        <th>Site Code</th>  
                                        <th>Site Name</th>  
                                        <th>PO Line NO</th>  
                                        <th>Shipment NO</th>  
                                        <th>Item Description</th>  
                                        <th>Requested QTY</th>  
                                        <th>Unit</th>  
                                        <th>Unit Price</th>  
                                        <th>Center Area</th>  
                                        <th>Start Date</th>  
                                        <th>End Date</th>  
                                        <th>Billed QTY</th>  
                                        <th>Due QTY</th>  
                                        <th>QTY Cancel</th>  
                                        <th>Item Code</th>  
                                        <th>Version NO</th>  
                                        <th>Line Amount</th>  
                                        <th>Bidding Area</th>  
                                        <th>Tax Rate</th>  
                                        <th>Currency</th>  
                                        <th>Ship To</th>  
                                        <th>Engineering Code</th>  
                                        <th>Engineering Name</th>  
                                        <th>Payment Terms</th>  
                                        <th>Category</th>  
                                        <th>Payment Method</th>  
                                        <th>Product Category</th>  
                                        <th>Bill To</th>  
                                        <th>Subproject Code</th>  
                                        <th>Expired Date</th>  
                                        <th>Publish Date</th>  
                                        <th>Acceptance Date</th>  
                                        <th>FF Buyer</th>  
                                        <th>Note to Receiver</th>  
                                        <th>Fob Lookup Code</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->po_reimbursement_id }}</td>
                                        <td>{{ $item->change_history }}</td>
                                        <td>{{ $item->rep_office }}</td>
                                        <td>{{ $item->customer }}</td>
                                        <td>{{ $item->project_name }}</td>
                                        <td>{{ $item->project_code }}</td>
                                        <td>{{ $item->site_id }}</td>
                                        <td>{{ $item->sub_contract_no }}</td>
                                        <td>{{ $item->pr_no }}</td>
                                        <td>{{ $item->sales_contract_no }}</td>
                                        <td>{{ $item->po_status }}</td>
                                        <td>{{ $item->po_no }}</td>
                                        <td>{{ $item->site_code }}</td>
                                        <td>{{ $item->site_name }}</td>
                                        <td>{{ $item->po_line_no }}</td>
                                        <td>{{ $item->shipment_no }}</td>
                                        <td>{{ $item->item_description }}</td>
                                        <td>{{ $item->requested_qty }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->center_area }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->billed_qty }}</td>
                                        <td>{{ $item->due_qty }}</td>
                                        <td>{{ $item->qty_cancel }}</td>
                                        <td>{{ $item->item_code }}</td>
                                        <td>{{ $item->version_no }}</td>
                                        <td>{{ $item->line_amount }}</td>
                                        <td>{{ $item->bidding_area }}</td>
                                        <td>{{ $item->tax_rate }}</td>
                                        <td>{{ $item->currency }}</td>
                                        <td>{{ $item->ship_to }}</td>
                                        <td>{{ $item->engineering_code }}</td>
                                        <td>{{ $item->engineering_name }}</td>
                                        <td>{{ $item->payment_terms }}</td>
                                        <td>{{ $item->category }}</td>
                                        <td>{{ $item->payment_method }}</td>
                                        <td>{{ $item->product_category }}</td>
                                        <td>{{ $item->bill_to }}</td>
                                        <td>{{ $item->subproject_code }}</td>
                                        <td>{{ $item->expire_date }}</td>
                                        <td>{{ $item->publish_date }}</td>
                                        <td>{{ $item->acceptance_date }}</td>
                                        <td>{{ $item->ff_buyer }}</td>
                                        <td>{{ $item->note_to_receiver }}</td>
                                        <td>{{ $item->fob_lookup_code }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>PO Tracking Uploaded</th>    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $k => $item)
                                    <tr>
                                        <td style="width: 50px;">{{$k+1}}</td>
                                        <td><?php echo date_format($item->created_at, 'd M Y H:i:s'); ?></td>
                                        
                                        <td>
                                            <!-- <a href="{{route('po-tracking.generate-esar',$item)}}">Generate ESAR</a> -->
                                            <a href="{{route('po-tracking.edit-reimbursement',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Reimbursement</button></a>
                                            
                                            
                                            <!--    Regional     -->
                                            @if(check_access('po-tracking.edit-bast'))
                                            <a href="{{route('po-tracking.edit-bast',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Bast</button></a>
                                            <!-- @if($item->approved_bast_erp_date_upload == null)
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import BAST')}}</a>
                                            @else
                                                <a href="#" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview BAST')}}</a>
                                            @endif -->
                                            @endif
                                            <!--    End Regional     -->

                                            <!--    E2E     -->
                                            @if(check_access('po-tracking.edit-esar'))
                                                <a href="{{route('po-tracking.edit-esar',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Esar</button></a>
                                            @endif
                                            <!--    End E2E     -->

                                            <!--    Finance     -->
                                            
                                            @if(check_access('po-tracking.edit-accdoc'))
                                                <a href="{{route('po-tracking.edit-accdoc',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Acceptance Docs</button></a>
                                                <!-- @if($item->approved_esar_date_upload == null)
                                                    <div type="button" class="btn btn-warning">Waiting Approved ESAR</div>
                                                @else -->
                                                    <!-- @if($item->approved_acceptance_docs_date_upload == null)
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Acceptance Docs & Invoice')}}</a>
                                                    @else
                                                        <a href="#" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload" class="btn btn-success"><i class="fa fa-eye"></i> {{__('Preview Acceptance Docs & Invoice')}}</a>
                                                    @endif -->
                                                <!-- @endif -->

                                            @endif
                                            <!--    End Finance     -->

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                        <br />
                        
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

<!--    MODAL REIMBURSEMENT      -->
<div class="modal fade" id="modal-potracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:p-o-tracking.insert />
        </div>
    </div>
</div>
<!--    MODAL REIMBURSEMENT      -->







@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

<script>
    // Livewire.on('modal-esar',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingaesar-upload").modal('show');
    // });

    Livewire.on('modal-bast',(data)=>{
        console.log(data);
        $("#modal-potrackingbast-upload").modal('show');
    });

    Livewire.on('modal-acceptancedocs',(data)=>{
        console.log(data);
        $("#modal-potrackingacceptance-upload").modal('show');
    });
</script>





@endsection










