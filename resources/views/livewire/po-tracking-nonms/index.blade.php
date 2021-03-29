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
                            if($user->user_access_id != '20'){ // E2E user access id 20
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <?php
                                                if($user->user_access_id != '22'){ // Regional user access id 22
                                            ?>
                                                <div class="btn btn-warning"> Waiting PO No</div>
                                            <?php
                                                }else{ // E2E
                                            ?>
                                            <div class="btn btn-primary"><i class="fa fa-plus"></i> Add PO No</div>
                                            <?php
                                                }
                                            ?>
                                        </td>    
                                        <td>{{ $item->region }}</td>    
                                        <td>
                                            <?php
                                                if($item->status == '' || $item->status == null){
                                                    $status =  "Waiting Approval";
                                                    $statustype =  "warning";
                                                }else{
                                                    if($item->status == '1'){
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
                                        <td>{{ $item->region }}</td>    
                                        
                                        <td>
                                            <?php
                                                if($item->type_doc == 1){
                                                    $type_doc =  "STP";
                                                }else{
                                                    $type_doc =  "BOQ";
                                                }
                                            ?>   
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview PO Non MS <?php echo $type_doc; ?> </button></a>

                                            <?php
                                                if($user->user_access_id == '22'){ // Regional user access id 22
                                            ?>
                                            <!--    Start Regional Upload Bast    -->
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Import Bast </button></a>
                                            <!--    End Regional Upload Bast    -->
                                            <?php
                                                }
                                            ?>


                                            <?php
                                                if($user->user_access_id != '20'){ // E2E
                                            ?>
                                            <!--    Start E2E Upload Approved Bast    -->
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Import Approved Bast </button></a>
                                            <!--    End E2E Upload Approved Bast    -->
                                            <?php
                                                }
                                            ?>


                                            <?php
                                                if($user->user_access_id != '20'){ // E2E
                                            ?>
                                            <!--    Start E2E Upload GR    -->
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Import GR Customer </button></a>
                                            <!--    End E2E Upload GR    -->
                                            <?php
                                                }
                                            ?>

                                            <?php
                                                if($user->user_access_id != '2'){ // Finance
                                            ?>
                                            <!--    Start Finance Upload Huawei Acceptance Docs    -->
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Import Huawei Acceptance Docs </button></a>
                                            <!--    End Finance Upload Huawei Acceptance Docs    -->
                                            <?php
                                                }
                                            ?>
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
</script>





@endsection










