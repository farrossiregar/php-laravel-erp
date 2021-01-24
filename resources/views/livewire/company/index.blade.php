@section('title', __('Company'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                @if(check_access('company.insert'))
                <div class="col-md-1">
                    <a href="{{route('company.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Company')}}</a>
                </div>
                @endif
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Name</th>          
                                <th>Telephone</th>          
                                <th>Address</th>          
                                <th>Code</th>          
                                <th>Website</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>
                                    @if(check_access('company.edit'))
                                    <a href="{{route('company.edit',['id'=>$item->id])}}">{{$item->name}}</a>
                                    @else
                                    {{$item->name}}
                                    @endif
                                </td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->website}}</td>
                                
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



@if(check_access('company.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:company.delete />
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
Livewire.on('company-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});

@endsection