@section('title', 'Department')
@section('parentPageTitle', 'Data Master')

<div class="row clearfix">
    <div class="col-lg-7">
        <div class="card">
            <div class="header row">
                <div class="col-md-4">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                @if(check_access('department.insert'))
                <div class="col-md-4">
                    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"><i class="fa fa-plus"></i> Department</a>
                </div>
                @endif
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>Department</th>                                    
                                <th>Total Employee</th> 
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td><a href="{{route('users.edit',['id'=>$item->id])}}">{{$item->name}}</a></td>
                                <td>{{\App\Models\Employee::where('department_id',$item->id)->count()}}</td>
                                <td>
                                    @if(check_access('department.insert-sub-department'))
                                    <a href="javascript:;" wire:click="$emit('emit-insert-sub',{{$item->id}})" data-toggle="modal" data-target="#modal_insert_sub" title="Add Sub Department"><i class="fa fa-plus"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @if($item->sub)
                                @foreach($item->sub as $sub)
                                <tr>
                                    <td class="pl-4">{{$sub->name}}</td>
                                    <td>{{\App\Models\Employee::where('department_sub_id',$sub->id)->count()}}</td>
                                    <td>
                                        @if(check_access('department.delete-sub-department'))
                                        <a href="javascript:;" wire:click="delete({{$sub->id}})" class="text-danger"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif
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
@if(check_access('department.insert'))
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:department.insert />
    </div>
</div>
@endif

@if(check_access('department.insert-sub-department'))
<div class="modal fade" id="modal_insert_sub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:department.insert-sub-department />
    </div>
</div>
@endif

@section('page-script')
function autologin(action,name){
    $("#modal_autologin form").attr("action",action);
    $("#modal_autologin .modal-body").html('<p>Autologin as '+name+' ?</p>');
    $("#modal_autologin").modal("show");
}
@endsection