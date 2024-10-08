@section('title', 'Menu')
@section('parentPageTitle', 'Management Menu')

<div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <h6>Project</h6>
                </div>
                <div class="col-md-3">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_module" class="btn btn-primary"><i class="fa fa-plus"></i> Menu</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <th>{{isset($item->department->name) ? $item->department->name : ''}}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @php($menus = \App\Models\Module::select('modules.id','modules.name',\DB::raw('client_projects.name as client_projects_name'),\DB::raw('company.code as company_code'))
                                        ->leftJoin('client_projects','client_projects.id','=','modules.client_project_id')
                                        ->leftJoin('company','company.id','=','client_projects.company_id')
                                ->where(['department_id'=>$item->department_id])->get())
                                @if($menus->count()==0)
                                <tr><td colspan="3"></td></tr>
                                @else
                                    @foreach($menus as $menu)
                                        <tr>
                                            <td>
                                                &nbsp;&nbsp;&nbsp;<a href="{{route('module.edit',$menu->id)}}">{{$menu->company_code}} - {{isset($menu->client_projects_name) ? $menu->client_projects_name : ''}}</a>
                                                <p class="py-0 my-0">&nbsp;&nbsp;&nbsp;<a href="{{route('module.edit',$menu->id)}}">{{$menu->name}}</a></p>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="text-danger" wire:click="delete({{$menu->id}})"><i class="fa fa-trash"></i></a>
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
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <h6>Data Master</h6>
                </div>
                <div class="col-md-3">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_datamaster" class="btn btn-primary"><i class="fa fa-plus"></i> Menu</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    @livewire('module.data-master',['id'=>17],key(17))
                </div>
            </div>
        </div>
    </div>
    
    <div wire:ignore.self class="modal fade" id="modal_insert_datamaster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="basic-form" method="post" wire:submit.prevent="save_data_master">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" class="form-control" wire:model="name_data_master" >
                            @error('name_data_master')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="checkbox" wire:model="status_data_master" value="1" data-parsley-errors-container="#error-checkbox" data-parsley-multiple="checkbox">
                                <span>Active</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_insert_module" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                @livewire('module.insert')
            </div>
        </div>
    </div>
</div>


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
function autologin(action,name){
    $("#modal_autologin form").attr("action",action);
    $("#modal_autologin .modal-body").html('<p>Autologin as '+name+' ?</p>');
    $("#modal_autologin").modal("show");
}
@endsection