@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <br><br><br>

            <div class="tab-content">
                <div class="row">
                    <div class="row-6">
                        <div class="row">
                            @foreach($data as $key => $item)
                                <div class="col-md-4">
                                    <!-- <img src="https://cdn.mos.cms.futurecdn.net/rNqRoby4d3rr9QCnigVq2B-1200-80.jpeg" class="img-rounded" alt="Cinque Terre" width="304" height="236">  -->
                                    <img src="<?php echo asset('storage/po_tracking_nonms/'.$item->image); ?>" class="img-rounded" alt="Cinque Terre" width="304" height="236"> 
                                    <p>{{ $item->description }}</p>    
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form wire:submit.prevent="save">
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table table-striped m-b-0 c_list">
                                        <thead>
                                            <tr>
                                                <th>Region</th>
                                                <th>:</th>
                                                <th>{{$datadoc->region}}</th>
                                            </tr>
                                            <tr>
                                                <th>Site ID</th> 
                                                <th>:</th>
                                                <th>{{$datadoc->site_id}}</th> 
                                            </tr>
                                            <tr>
                                                <th>Site Name</th>
                                                <th>:</th>    
                                                <th>{{$datadoc->site_name}}</th>    
                                            </tr>
                                            <tr>
                                                <th>Coordinator</th> 
                                                <th>:</th>   
                                                <th>{{$datadoc->coordinator->name}}</th>    
                                            </tr>
                                            <tr>
                                                <th>Field Team</th>    
                                                <th>:</th>
                                                <th>{{$datadoc->field_team->name}}</th>    
                                            </tr>
                    
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <a href="javascript:;" wire:click="$emit('modalapprovedetailfoto','{{$datadoc->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-approvebast" title="Upload" class="btn btn-primary"> {{__('Approve')}}</a>
                                    <a href="javascript:;" wire:click="$emit('modalrevisedetailfoto','{{$datadoc->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-revisebast" title="Upload" class="btn btn-danger"> {{__('Revisi')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewire('po-tracking-nonms.bast')
</div>


<div class="modal fade" id="modal-potrackingnonms-approvebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.approvedetailfoto />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingnonms-revisebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.revisedetailfoto />
        </div>
    </div>
</div>


<script>
    Livewire.on('modalinputpono',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalimportaccdoc',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalapprovedetailfoto',()=>{
        $("#modal-potrackingnonms-approvebast").modal('show');
    });
    Livewire.on('modalrevisedetailfoto',()=>{
        $("#modal-potrackingnonms-revisebast").modal('show');
    });
</script>




<script>
    function hidenote(){
        $('#note').css('display', 'none');
    }   

    function shownote(){
        $('#note').css('display', 'block');
    }   
</script>







