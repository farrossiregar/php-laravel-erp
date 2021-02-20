@section('title', 'Sites')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-1">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Site</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                                    
                                <th>Site ID</th>                                    
                                <th>Site Name</th>                                    
                                <th>Region</th>                                    
                                <th>Cluster</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num=$data->firstItem())
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$num}}</td>
                                <td>{{$item->site_id}}</td> 
                                <td>{{$item->name}}</td>
                                <td>{{isset($item->region->region)?$item->region->region:''}}</td>
                                <td>{{isset($item->cluster->name)?$item->cluster->name:''}}</td>
                            </tr>
                            @php($num++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
@if(check_access('employee.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:employee.delete />
    </div>
</div>
@endif


<div class="modal fade" id="modal_autologin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-sign-in"></i> Autologin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger close-modal">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-warning"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <p>Are you want delete this data ?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                <button type="button" wire:click="delete()" class="btn btn-danger close-modal">Yes</button>
            </div>
        </div>
    </div>
</div>

@section('page-script')
Livewire.on('emit-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});
function autologin(action,name){
    $("#modal_autologin form").attr("action",action);
    $("#modal_autologin .modal-body").html('<p>Autologin as '+name+' ?</p>');
    $("#modal_autologin").modal("show");
}
@endsection