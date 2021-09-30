@section('title', 'Department')
@section('parentPageTitle', 'Data Master')

<div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                @if(check_access('department.insert'))
                <div class="col-md-4">
                    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"><i class="fa fa-plus"></i> Department</a>
                </div>
                @endif
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <tbody>
                            @foreach($non_projects as $k => $item)
                                <tr>
                                    <th>
                                        @if(check_access('department.edit'))
                                            <a href="javascript:;" wire:click="$emit('emit-edit',{{$item->id}})" data-toggle="modal" data-target="#modal_edit">{{$item->name}}</a>
                                        @else
                                            {{$item->name}}
                                        @endif
                                    </th>
                                    <th>
                                        @if($item->icon)
                                            <!-- <img src="{{asset($item->icon)}}" style="height:50px;" /> -->
                                        @endif
                                    </th>
                                    <td>
                                        @if(check_access('department.insert-sub-department'))
                                        <a href="javascript:;" wire:click="$emit('emit-insert-sub',{{$item->id}})" class="mr-2" data-toggle="modal" data-target="#modal_insert_sub" title="Add Sub Department"><i class="fa fa-plus"></i></a>
                                        @endif
                                        @if(check_access('department.delete'))
                                        <a href="javascript:;" wire:click="delete({{$item->id}})" class="text-danger"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @if($item->sub)
                                    @foreach($item->sub as $sub)
                                    <tr>
                                        <td class="pl-4">
                                            @if(check_access('department.edit-sub-department'))
                                                <a href="javascript:;" wire:click="$emit('emit-edit-sub-department',{{$sub->id}})" data-toggle="modal" data-target="#modal_edit_sub">{{$sub->name}}</a>
                                            @else
                                                {{$sub->name}}
                                            @endif
                                        </td>
                                        <td></td>
                                        <td>
                                            @if(check_access('department.delete-sub-department'))
                                            <a href="javascript:;" wire:click="deleteSub({{$sub->id}})" class="text-danger"><i class="fa fa-trash"></i></a>
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
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_insert_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="save_project">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Department</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" wire:model="department_name_project" />
                        </div>
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="file" wire:model="department_icon_project" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading.remove>
                            <button type="button" class="btn btn-secondary btn-sm close-btn" data-dismiss="modal">Cancel</button>
                            <button type="submit"  class="btn btn-info btn-sm close-modal"><i class="fa fa-save"></i> Save</button>
                        </div>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
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

@if(check_access('department.edit'))
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:department.edit />
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

@if(check_access('department.edit-sub-department'))
<div class="modal fade" id="modal_edit_sub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:department.edit-sub-department />
    </div>
</div>
@endif
@section('page-script')
Livewire.on('emitEditSubDepartmentHide', ()=>{
    $("#modal_edit_sub").modal('hide');
});
Livewire.on('emitEditHide', () => {
    $("#modal_edit").modal('hide');
})
function autologin(action,name){
    $("#modal_autologin form").attr("action",action);
    $("#modal_autologin .modal-body").html('<p>Autologin as '+name+' ?</p>');
    $("#modal_autologin").modal("show");
}
@endsection