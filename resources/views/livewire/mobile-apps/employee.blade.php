<div>
    <div class="header row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="user_access_id">
                <option value="">--- User Access ---</option>
                @foreach(\App\Models\UserAccess::all() as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="department_sub_id">
                <option value="">{{__('--- Department --- ')}} </option>
                @foreach(\App\Models\Department::orderBy('name','ASC')->get() as $item)
                <optgroup label="{{$item->name}}">
                    @foreach(\App\Models\DepartmentSub::where('department_id',$item->id)->get() as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </optgroup>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <a href="javascript:;" data-toggle="modal" data-target="#modal_add" class="btn btn-primary"><i class="fa fa-plus"></i> Employee</a>
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped m-b-0 c_list">
            <thead>
                <tr>
                    <th>No</th>                                    
                    <th>Name</th>                                    
                    <th>Phone</th>
                    <th>Email</th>
                    @php($parent = \App\Models\ModulesItem::where('link','mobile-apps.index')->first())       
                    @foreach(\App\Models\ModulesItem::where('parent_id',$parent->id)->get() as $menu)
                        <th class="text-center">{{$menu->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php($num=$data->firstItem())
                @foreach($data as $k => $item)
                <tr>
                    <td style="width: 50px;">{{$num}}</td>
                    <td>
                        @if(check_access('employee.edit'))
                            <a href="{{route('employee.edit',['id'=>$item->id])}}">{{$item->name}}</a>
                        @else
                            {{$item->name}}
                        @endif
                    </td>
                    <td>{{$item->telepon}}</td> 
                    <td>{{$item->email}}</td> 
                    @foreach(\App\Models\ModulesItem::where('parent_id',$parent->id)->get() as $menu)
                        <th class="text-center"><input type="checkbox" value="1" wire:click="update_employee_access({{$item->id}},{{$menu->id}})" wire:model="employee_access.{{$item->id.$menu->id}}" /></th>
                    @endforeach
                </tr>
                @php($num++)
                @endforeach
            </tbody>
        </table>
    </div>
    <br />
    {{$data->links()}}

    <div wire:ignore.self class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="set_employee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <select class="form-control" wire:model="employee_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Employee::where(['is_use_android'=>0])->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger close-modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
