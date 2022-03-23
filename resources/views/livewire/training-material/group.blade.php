<div class="modal-content">
    <form wire:submit.prevent="store">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> Group Training</h5>
            @if($insert==false)
                <a href="javascript:void(0)" class="btn btn-info ml-2" wire:click="$set('insert',true)"><i class="fa fa-plus"></i></a>
            @endif
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true close-btn">×</span>
            </button>
        </div>
        <div class="modal-body">            
            @if($insert)
                <div class="card box-shadow p-3">
                    <div class="form-group">
                        <label>Group</label>
                        <input type="text" class="form-control" wire:model="group" />
                        @error('group')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        @foreach($count_employee_id as $k => $i)
                            <div class="row mb-2">
                                <div class="col-md-11 pr-0">
                                    <select class="form-control" wire:model="employee_id.{{$k}}">
                                        <option value=""> -- Select -- </option>
                                        @foreach($employees as $em)
                                            <option value="{{$em->id}}">{{$em->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1 pl-1 pt-2">
                                    <a href="javascript:;" class="text-danger" wire:click="delete_employee({{$k}})"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                        @endforeach
                        @error('employee_id')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                        <a href="javascript:void(0);" class="badge badge-info badge-active" wire:click="add_employee" title="Add Employee"><i class="fa fa-plus"></i> Employee</a>
                    </div>
                    <hr />
                    <div class="form-group" wire:loading.remove wire:target="store">
                        <button type="button" class="btn btn-light close-btn" wire:click="$set('insert',false)">Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                    <span wire:loading wire:target="store">
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            @endif    
            @foreach($data as $group)
                <div class="card box-shadow p-3 mb-2">
                    <h6>{{$group->name}} <a href="javascript:void(0)" wire:click="remove_group({{$group->id}})" class="ml-2" title="Remove"><i class="fa fa-times text-danger"></i></a></h6>
                    <hr />
                    <ol>
                        @foreach($group->employee as $em)
                            <li>{{isset($em->employee->name) ? $em->employee->nik .' / '.$em->employee->name : ''}} <a href="javascript:void(0)" wire:click="remove_employee({{$em->id}})" class="ml-2" title="Remove"><i class="fa fa-times text-danger"></i></a></li>
                        @endforeach
                        <li style="list-style: none;margin-left:-24px;">
                            @if($insert_exist_group and $selected_group_id == $group->id)
                                <select class="form-control mb-2" wire:model="selected_employee_id">
                                    <option value=""> -- Select -- </option>
                                    @foreach($employees as $em)
                                        <option value="{{$em->id}}">{{$em->name}}</option>
                                    @endforeach
                                </select>
                                <a href="javascript:void(0)" wire:click="save_employee_group" class="btn btn-sm btn-info"><i class="fa fa-save"></i> Save</a>
                                <a href="javascript:void(0)" wire:click="$set('insert_exist_group',false)">Cancel</a>
                            @else                    
                                <a href="javascript:void(0);" class="badge badge-info badge-active" wire:click="add_employee_exist({{$group->id}})" title="Add Employee"><i class="fa fa-plus"></i></a>
                            @endif
                        </li>
                    </ol>
                </div>
            @endforeach
        </div>
    </form>
</div>