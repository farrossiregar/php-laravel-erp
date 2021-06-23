@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')


<?php
    $user = \Auth::user();
?>

<div class="header row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

    <!-- <div class="col-md-2">
        <select name="region" class="form-control" id="region" wire:model="date">
            @foreach(App\Models\Region::all() as $item)
            <option value="{{ $item->id }}">{{ $item->region_code }}</option>
            @endforeach
        </select>
    </div> -->
    

    @if(check_access('po-tracking-nonms.edit-boq'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-potrackingboq-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking Ericson')}}</a>
    </div>
    @endif

</div>

<div class="body pt-0">

    
    <div class="table-responsive">
        <table class="table table-striped m-b-0 c_list">
            <thead>
                <tr>
                    <th>No</th>
                    <th>PO No</th>    
                    <th>WO Number</th>    
                    <th>Region</th>    
                    <th>Status</th>    
                    <th>Note from PMG</th>    
                    <th>Note Bast from E2E</th>
                    <th>Total Price</th>
                    <th>Total Actual Price</th>
                    <th>Total Profit Margin</th>
                    <th>Extra Budget</th>
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
                                <a href="javascript:;" wire:click="$emit('modalinputpono','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackinginput-pono" title="Upload"> {{__('Add PO No')}}</a>
                            @endif
                        @else
                            @if($item->po_no != null || $item->po_no != '')
                                {{ $item->po_no }}
                            @else
                                <span class="badge badge-danger"> Waiting PO No</span>
                            @endif
                        @endif
                    </td>    
                    <td><a href="{{route('po-tracking-nonms.edit-boq',['id'=>$item->id]) }}">{{ $item->no_tt }}</a></td>  
                    <td>{{ $item->region }}</td>    
                    <td class="text-center">
                        @if($item->status==0 || $item->status == null || $item->status == '0')
                            <label class="badge badge-info" data-toggle="tooltip" title="Regional - Waiting to Submit">Waiting to Submit</label>
                        @endif
                        @if($item->status==1)
                            <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                        @endif
                        @if($item->status==2)
                            <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                        @endif
                        @if($item->status==3)
                            <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                        @endif
                        @if($item->status==4)
                        <label class="badge badge-success" data-toggle="tooltip" title="Finance - Budget Successfully Transfered">Finance Regional - Budget Transfered</label>
                        @endif
                        @if($item->status==5 && $item->bast_status == 1)
                            <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">Waiting Approval </label>
                        @endif
                        @if($item->status==5 && $item->bast_status == 2)
                            <label class="badge badge-success" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                        @endif
                        @if($item->status==5 && $item->bast_status == 3)
                            <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Revisi</label>
                        @endif
                        @if($item->status==6)
                            <label class="badge badge-danger" data-toggle="tooltip" title="Finance - Upload Approved Acceptance docs and Invoice">Finance</label>
                        @endif
                    </td>
                    <td>{{ $item->status_note }}</td>    
                    <td>{{ $item->bast_status_note }}</td>
                    <td>Rp {{ format_idr(get_total_price($item->id)) }}</td> 
                    <td>Rp {{ format_idr(get_total_actual_price($item->id)) }}</td>                               
                    <td>
                        <?php
                            if(get_total_price($item->id) && get_total_actual_price($item->id)){
                                $total_profit = 100 - round((get_total_price($item->id) / get_total_actual_price($item->id)) * 100);
                            }else{
                                $total_profit = '100';
                            }

                            if($total_profit >= 30){
                                $color = 'success';
                            }else{
                                $color = 'danger';
                            }
                        ?>
                        <div class="text-<?php echo $color; ?>">{{ $total_profit }}%</div>
                    </td>
                    <td>Rp {{ format_idr(get_extra_budget($item->id)) }}</td>
                    <td>@livewire('po-tracking-nonms.select-coordinator-stp',['data'=>$item->id],key($item->id))</td>
                    <td>@livewire('po-tracking-nonms.select-field-team-stp',['data'=>$item->id],key($item->id))</td>
                    <td> 
                        @if($item->bast_status == '')
                            <a href="{{route('po-tracking-nonms.detailfoto',['id'=>$item->id]) }}" ><i class="fa fa-eye"></i> Detail Foto</a>
                        @endif
                        
                        @if(check_access('po-tracking-nonms.preview-bast'))
                            @if($item->bast_status == 1)
                                <!--    Start E2E Preview Bast   -->
                                <a href="javascript:;" data-toggle="modal" data-target="#modal_bast" wire:click="$emit('listen-bast',{{$item->id}})"><i class="fa fa-eye"></i> BAST</a>
                                <!--    End E2E Preview Bast    -->
                            @endif
                        @endif

                        @if(check_access('po-tracking-nonms.upload-accdoc'))
                        <!--    Start Finance Upload Huawei Acceptance Docs    -->
                        
                            @if($item->e2e_to_fin == '1')
                                @if($item->acc_doc == null || $item->acc_doc == '')
                                    @if($item->gr_cust == null || $item->gr_cust == '')
                                        <div class="btn btn-warning">Waiting Uploaded Approved Bast & GR Customer</div>    
                                    @else
                                        <a href="javascript:;" wire:click="$emit('modalimportaccdoc','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importaccdoc" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Huawei Acceptance Docs')}}</a>
                                    @endif
                                @else
                                    @if($item->acc_doc != '0')
                                    <a href="javascript:;" wire:click="$emit('modalimportaccdoc','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importaccdoc" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        <a href="<?php echo asset('storage/po_tracking_nonms/AcceptanceDocs/'.$item->acc_doc) ?>" target="_blank"><i class="fa fa-download"></i>  Download Acceptance Docs </a>
                                    @endif
                                @endif
                            @endif
                        <!--    End Finance Upload Huawei Acceptance Docs    -->
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <br />
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









