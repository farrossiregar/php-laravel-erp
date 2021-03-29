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
                    <th>Employee</th>   
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
