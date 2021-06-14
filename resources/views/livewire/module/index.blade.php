@section('title', 'Menu')
@section('parentPageTitle', 'Management Menu')

<div class="row clearfix">
    <div class="col-lg-8">
        <div class="card">
            <div class="header row">
                <div class="col-md-3">
                    <select class="form-control" wire:model="company_id">
                        <option value=""> -- Company -- </option>
                        @foreach(\App\Models\Company::get() as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_module" class="btn btn-primary"><i class="fa fa-plus"></i> Menu</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        {{-- <thead>
                            <tr>
                                <th>Department</th>
                                <th>Company</th>
                                <th>Project</th>
                                <th>Name</th>
                                <th>Prefix Link</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Updated</th>
                            </tr>
                        </thead> --}}
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <th>{{isset($item->department->name) ? $item->department->name : ''}}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @php($menus = \App\Models\Module::select('modules.id','modules.name',\DB::raw('client_projects.name as client_projects_name'))->join('client_projects','client_projects.id','=','modules.client_project_id')
                            ->where(['department_id'=>$item->department_id])->get())
                            @if($menus->count()==0)
                            <tr><td colspan="3"></td></tr>
                            @else
                                @foreach($menus as $menu)
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;<a href="{{route('module.edit',$menu->id)}}">{{isset($menu->client_projects_name) ? $menu->client_projects_name : ''}}</a></td>
                                        <td>{{$menu->name}}</td>
                                        <td>
                                            <a href="javascript:;" class="text-danger" wire:click="delete({{$menu->id}})"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
{{--                                 
                                <td>{{isset($item->client_project->company->code) ? $item->client_project->company->code : ''}}</td>
                                <td>{{isset($item->client_project->name) ? $item->client_project->name : ''}}</td>
                                <td><a href="{{route('module.edit',['id'=>$item->id])}}">{{$item->name}}</a></td>
                                <td>{{$item->prefix_link}}</td>
                                <td>
                                    @if($item->icon)
                                        <i style="{{$item->color?'color:'.$item->color:''}}" class="fa fa-{{$item->icon}}"></i>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status==1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    {{$item->updated_at}}
                                    <a href="javascript:;" class="text-danger" wire:click="delete({{$item->id}})"><i class="fa fa-trash"></i></a>
                                </td> --}}
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
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