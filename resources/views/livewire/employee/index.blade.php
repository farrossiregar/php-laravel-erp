@section('title', 'Employee')
@section('parentPageTitle', 'Data Master')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="user_access_id">
                        <option value="">--- User Access ---</option>
                        <optgroup label="Project">
                            @foreach(\App\Models\UserAccess::where('is_project',1)->orderBy('name')->get() as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Non Project">
                            @foreach(\App\Models\UserAccess::where('is_project',0)->orderBy('name')->get() as $i)
                            <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="department_id">
                        <option value="">--- Department ---</option>
                        @foreach(\App\Models\Department::orderBy('name')->get() as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="project_id">
                        <option value="">--- Project ---</option>
                        @foreach(\App\Models\ClientProject::where('is_project',1)->groupBy('name')->orderBy('name')->get() as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <a href="{{route('employee.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Employee</a>
                    <!-- <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> Upload</a> -->
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th table-hover">
                        <thead>
                            <tr>
                                <th>No</th>                                    
                                <th>Company</th>                                    
                                <th>Code / Alias</th>                                    
                                <th>NIK</th>                                    
                                <th>Name</th>                                    
                                <th>Phone</th>                                    
                                <th>Email</th>  
                                <th>Department</th>
                                <th>Project</th>
                                <th>Position</th>
                                <th>Android</th>
                                <th>Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num=$data->firstItem())
                            @php($edit = check_access('employee.edit'))
                            @php($autologin = check_access('employee.autologin'))
                            @php($is_delete = check_access('employee.autologin'))
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$num}}</td>
                                <td>{{isset($item->company->code) ? $item->company->code : '-' }}</td>
                                <td>{{$item->employee_code}}</td>
                                <td>{{$item->nik}}</td>
                                <td>
                                    @if($autologin and !empty($item->user_id))
                                        <a href="#" class="text-success pr-2" onclick="autologin('{{ route('users.autologin',['id'=>$item->user_id]) }}','{{$item->name}}')" title="Autologin"><i class="fa fa-sign-in"></i></a>
                                    @endif
                                    
                                    @if($item->device)
                                        <a href="javascript:void(0)" wire:click="set_device({{$item->id}})" data-toggle="modal" data-target="#modal_device_info"><i class="fa fa-mobile-phone"></i></a>
                                    @endif

                                    @if($edit)
                                        <a href="{{route('employee.edit',['id'=>$item->id])}}">{{$item->name}}</a>
                                    @else
                                        {{$item->name}}
                                    @endif
                                </td>
                                <td>{{$item->telepon}}</td> 
                                <td>{{$item->email}}</td>          
                                <td>{{isset($item->department->name)?$item->department->name :''}}</td>
                                <td>
                                    @if($item->employee_project)
                                        @foreach($item->employee_project as $p)
                                            @if(isset($p->project->name))
                                                {{$p->project->name}} 
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{isset($item->access->name)?$item->access->name:''}}</td>
                                <td>
                                    @if($item->is_use_android==1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>{{$item->updated_at}}</td>
                                <td>  
                                    @if($autologin and !empty($item->user_id))
                                    <a href="#" class="text-success pr-2" onclick="autologin('{{ route('users.autologin',['id'=>$item->user_id]) }}','{{$item->name}}')" title="Autologin"><i class="fa fa-sign-in"></i></a>
                                    @endif
                                    @if($is_delete)
                                    <a href="#" class="text-danger" wire:click="$emit('emit-delete',{{$item->id}})" data-toggle="modal" data-target="#modal_delete" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    @endif
                                    @if($item->is_use_android==1)
                                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                        <div class="dropdown-menu">
                                            <a href="#" class="dropdown-item" wire:click="generate_login_password({{$item->id}})" title="Username dan Password login akan dikirim ke nomor karyawan yang bersangkutan"><i class="fa fa-key"></i> Generate Login Apps</a>
                                        </div>
                                    @endif
                                </td>
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
    <div class="modal fade" id="modal_upload" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" wire:submit.prevent="upload">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-mobile-phone"></i> Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" wire:model="file_upload" />
                            @error('file_upload')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="modal_device_info" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-mobile-phone"></i> Device Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if($device_selected)
                            <table class="table">
                                @foreach(json_decode($device_selected) as $header => $value)
                                    <tr>
                                        <th>{{$header}}</th>
                                        <td>{{$value}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@if($is_delete)
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