<div>
    @if(isset($data->employee->nik))
        {{$data->employee->nik}} / {{$data->employee->name}}
    @else
        @if($assign and $selected_id == $data->id)
            <div class="row">
                <div>
                    <select class="form-control" wire:model="employee_id">
                        <option value=""> -- Employee -- </option>
                        @foreach(\App\Models\Employee::whereNotNull('user_id')->orderBy('name','ASC')->get() as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:loading.remove>
                    <a href="javascript:;" class="ml-2 mt-2 mr-2 text-danger" wire:click="cancel({{$data->id}})"><i class="fa fa-times"></i></a>
                    <a href="javascript:;" class="mt-2 text-success"  wire:click="save"><i class="fa fa-check"></i></a>
                </div>
                <div wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </div>
                
            </div>
        @else
            <a href="javascript:;" wire:click="set_assign({{$data->id}})"><i class="fa fa-arrow-right"></i> Assign</a>
        @endif
    @endif
</div>
