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
                        
                        <div class="col-md-2">
                            <a href="#" data-toggle="modal" data-target="#modal-potrackingboq-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking BOQ')}}</a>
                        </div>

                        <div class="col-md-2">
                            <a href="#" data-toggle="modal" data-target="#modal-potrackingstp-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking STP')}}</a>
                        </div>
                        
                    </div>
                    
                    <div class="body pt-0">

                        
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>PO No</th>    
                                        <th>Region</th>    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="btn btn-warning"> Waiting PO No</div>
                                        </td>    
                                        <td></td>    
                                        <?php
                                            if($item->type_doc == 1){
                                                $type_doc =  "STP";
                                            }else{
                                                $type_doc =  "BOQ";
                                            }
                                        ?>   
                                        <td>
                                            <a href="{{route('po-tracking-nonms.edit-stp',['id'=>$item->id])}}"><button type="button" class="btn btn-success"><i class="fa fa-eye"></i> Preview PO Non MS <?php echo $type_doc; ?> </button></a>
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










