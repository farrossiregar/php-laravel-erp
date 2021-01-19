@section('title', __('Cluster'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-1">
                    <a href="{{route('cluster.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Cluster')}}</a>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Name Region</th>          
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td><a href="{{route('cluster.edit',['id'=>$item->id])}}">{{$item->name}}</a></td>
                                <td>
                                    @if(check_access('cluster.delete'))
                                    <a href="#" class="text-danger" wire:click="$clusterdel('cluster-delete',{{$item->id}})" data-toggle="modal" data-target="#modal_delete" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    @endif
                                    <a href="#" class="text-danger" wire:click="$clusterdel('cluster-delete',{{$item->id}})" data-toggle="modal" data-target="#modal_delete" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    <!-- <a href="{{ route('cluster.delete', $item->id) }}" class="btn btn-danger">Delete</a> -->
                                </td>
                            </tr>
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


@if(check_access('cluster.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:cluster.delete />
    </div>
</div>
@endif


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
Livewire.on('cluster-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});

@endsection