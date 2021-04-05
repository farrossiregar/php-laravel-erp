@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')


<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">
                <div class="tab-pane show active" id="data-po-tracking">
                <br><br>
                    <div class="header row">
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div>

                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div>
                        
                        <?php
                            if($user->user_access_id == '20'){ // E2E user access id 20
                        ?>
                        <div class="col-md-2">
                            <a href="#" data-toggle="modal" data-target="#modal-potrackingboq-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking BOQ')}}</a>
                        </div>

                        <div class="col-md-2">
                            <a href="#" data-toggle="modal" data-target="#modal-potrackingstp-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking STP')}}</a>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    
                    <div class="body pt-0">

                        
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>PO No</th>    
                                        <th>Region</th>    
                                        <th>Status</th>    
                                        <th>Note from PMG</th>    
                                        <th>Bast Status</th>
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
                                            <!--Regional user access id 22 -->
                                            @if($user->user_access_id == '20')
                                                @if($item->po_no != null || $item->po_no != '')
                                                    {{ $item->po_no }}
                                                @else
                                                    <a href="javascript:;" wire:click="$emit('modalinputpono','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackinginput-pono" title="Upload" class="btn btn-primary"> {{__('Add PO No')}}</a>
                                                @endif
                                            @else
                                                <div class="btn btn-warning"> Waiting PO No</div>
                                            @endif


                                        </td>    
                                        <td>{{ $item->region }}</td>    
                                        <td>
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
                                                        $status =  "Waiting PMG Review"; // Submit ke PMG dan proses Review jika profit per item < 30%
                                                        $statustype =  "warning";
                                                    }
                                                }
                                            ?>   
                                            <div class="btn btn-<?php echo $statustype; ?>"> <?php echo $status; ?> </div>
                                        </td>    
                                        <td>{{ $item->status_note }}</td>    
                                        <td>
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
                                        </td>
                                        <td>{{ $item->bast_status_note }}</td>
                                        <td><b>{{ get_extra_budget($item->id) }}</b> </td>
                                        <td>
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

                                            <?php
                                                if($user->user_access_id == '22' && ($item->po_no != null || $item->po_no != '')){ // Regional user access id 22
                                            ?>
                                            <!--    Start Regional Upload Bast    -->
                                            <a href="javascript:;" wire:click="$emit('modalimportbast','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-importbast" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Bast')}}</a>
                                            <!--    End Regional Upload Bast    -->
                                            
                                            <?php
                                                }
                                            ?>


                                            
                                            @if($user->user_access_id == '20' || $user->user_access_id == '22')
                                            <!--    Start E2E Preview Bast   -->
                                            <a href="{{ route('po-tracking-nonms.edit-bast',['id'=>$item->id]) }}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview Bast </button></a>
                                            <!--    End E2E Preview Bast    -->
                                            
                                            @endif

                                            @if($user->user_access_id == '2')
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
                </div>
            </div>
        </div>
    
    </div>
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


<!--    MODAL PO BOQ      -->
<div class="modal fade" id="modal-potrackingboq-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importboq />
        </div>
    </div>
</div>
<!--    MODAL PO BOQ      -->


<!--    MODAL PO NON MS INPUT PO NO      -->
<div class="modal fade" id="modal-potrackinginput-pono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.inputpono />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS INPUT PO NO      -->




<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->
<div class="modal fade" id="modal-potrackingnonms-importaccdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importaccdoc />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->


@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

<script>

    Livewire.on('modal-boq',(data)=>{
        console.log(data);
        $("#modal-potrackingboq-upload").modal('show');
    });

    Livewire.on('modal-stp',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });

    Livewire.on('modalinputpono',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });

    // Livewire.on('modalimportbast',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingstp-upload").modal('show');
    // });

    // Livewire.on('modalrevisebast',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingnonms-revisebast").modal('show');
    // });

    // Livewire.on('modalimportapprovedbast',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingstp-upload").modal('show');
    // });

    // Livewire.on('modalimportgrcust',(data)=>{
    //     console.log(data);
    //     $("#modal-potrackingstp-upload").modal('show');
    // });

    Livewire.on('modalimportaccdoc',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
</script>





@endsection










