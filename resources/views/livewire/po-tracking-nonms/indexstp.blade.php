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
    

    @if(check_access('po-tracking-nonms.edit-stp'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-potrackingstp-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking STP')}}</a>
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
                    <th>No TT</th>    
                    <th>Region</th>    
                    <th>Status</th>    
                    <th>Note from PMG</th>    
                    <!-- <th>Bast Status</th> -->
                    <th>Note Bast from E2E</th>
                    <th>Extra Budget</th>
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
                                <a href="javascript:;" wire:click="$emit('modalinputpono','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackinginput-pono" title="Upload" class="btn btn-primary"> {{__('Add PO No')}}</a>
                            @endif
                        @else
                            @if($item->po_no != null || $item->po_no != '')
                                {{ $item->po_no }}
                            @else
                                <div class="btn btn-warning"> Waiting PO No</div>
                            @endif
                        @endif


                    </td>    
                    <td>{{ $item->no_tt }}</td>    
                    <td>{{ $item->region }}</td>    
                    <!-- <td>
                        <?php
                            if($item->status == '' || $item->status == null || $item->status == '0'){
                                $status =  "Waiting Approval"; // BOQ / STP belum disubmit
                                $statustype =  "warning";
                            }else{
                                if($item->status == '1'){
                                    $status =  "Approved"; // Submit ke Finance jika profit >= 30%
                                    $statustype =  "success";
                                }
                                
                                if($item->status == '2'){
                                    $status =  "Revise"; // Permintaan Revisi dari PMG
                                    $statustype =  "danger";
                                }

                                if($item->status == '3'){
                                    $status =  "Waiting PMG Review under 30%"; // Submit ke PMG dan proses Review jika profit per item < 30%
                                    $statustype =  "warning";
                                }
                            }
                        ?>   
                        <div class="btn btn-<?php echo $statustype; ?>"> <?php echo $status; ?> </div>
                    </td>     -->
                    <td class="text-center">
                        
                        @if($item->status==0 || $item->status == null || $item->status == '0')
                            <label class="badge badge-info" data-toggle="tooltip" title="Regional - Waiting to Submit">Waiting to Submit</label>
                        @endif
                        @if($item->status==1)
                            <!-- <label class="badge badge-warning" data-toggle="tooltip" title="Finance - Approved">Finance - Profit >= 30% </label> -->
                            <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%">Finance - Approved</label>
                        @endif
                        @if($item->status==2)
                            <!-- <label class="badge badge-primary" data-toggle="tooltip" title="E2E - Generate ESAR, Upload ESAR and Verification Docs">E2E Upload</label> -->
                            <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                        @endif
                        @if($item->status==3)
                            <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                        @endif

                        @if($item->status==1 && ($item->bast_status == '' || $item->bast_status == null))
                            <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">Waiting Approval </label>
                        @endif

                        @if($item->status==1 && ($item->bast_status == '1'))
                            <label class="badge badge-success" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                        @endif

                        @if($item->status==1 && ($item->bast_status == '2'))
                            <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Declined</label>
                        @endif
                    </td>
                    <td>{{ $item->status_note }}</td>    
                    <!-- <td>
                        <?php
                            if($item->bast_status == '' || $item->bast_status == null){
                                $status =  "Waiting Approved Bast E2E";
                                $statustype =  "warning";
                            }else{
                                if($item->bast_status == '1'){
                                    $status =  "Approved";
                                    $statustype =  "success";
                                }else{
                                    $status =  "Revise";
                                    $statustype =  "danger";
                                }
                            }
                        ?>   
                        <div class="btn btn-<?php echo $statustype; ?>"> <?php echo $status; ?> </div>
                    </td> -->
                    <td>{{ $item->bast_status_note }}</td>
                    <td><b>Rp {{ format_idr(get_extra_budget($item->id)) }}</b> </td>
                    <td>
                        @if(check_access('po-tracking-nonms.preview-doc'))
                        <?php
                            if($item->type_doc == 1){
                                $type_doc =  "STP";
                                $url_doc = route('po-tracking-nonms.edit-stp',['id'=>$item->id]);
                            }else{
                                $type_doc =  "BOQ";
                                $url_doc = route('po-tracking-nonms.edit-boq',['id'=>$item->id]);
                            }
                        ?>   
                        <a href="<?php echo $url_doc; ?>"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview PO Non MS <?php echo $type_doc; ?> </button></a>
                        @endif
                        
                        <?php
                            if($user->user_access_id == '22' && ($item->po_no != null || $item->po_no != '')){ // Regional user access id 22
                        ?>
                        <!--    Start Regional Upload Bast    -->
                        <!-- <a href="javascript:;" wire:click="$emit('modalimportbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importbast" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Bast')}}</a> -->
                        <!--    End Regional Upload Bast    -->
                        
                        <?php
                            }
                        ?>


                        
                        
                        @if(check_access('po-tracking-nonms.preview-bast'))
                        <!--    Start E2E Preview Bast   -->
                        <a href="{{ route('po-tracking-nonms.edit-bast',['id'=>$item->id]) }}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Bast </button></a>
                        <!--    End E2E Preview Bast    -->
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

<!--    MODAL PO STP      -->
<div class="modal fade" id="modal-potrackingstp-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importstp />
        </div>
    </div>
</div>
<!--    MODAL PO STP      -->



@section('page-script')


<script>

    Livewire.on('modal-stp',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });

 
</script>





@endsection




