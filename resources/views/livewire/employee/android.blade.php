<div class="row">
    <div class="col-md-12 p-4 border mb-3">
        @php($parent = \App\Models\ModulesItem::where('link','mobile-apps.index')->first())       
        @foreach(\App\Models\ModulesItem::where('parent_id',$parent->id)->get() as $menu)
            <p>
                <label class="fancy-checkbox">
                    <input type="checkbox" value="1" wire:click="update_employee_access({{$menu->id}},{{$menu->id}})" wire:model="employee_access.{{$menu->id}}" />
                    <span>{{$menu->name}}</span>
                </label>
            </p>
        @endforeach
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>PIC Speed Warning Alarm</label>
            <select class="form-control" wire:model="speed_warning_pic_id">
                <option value=""> --- select --- </option>
                @foreach(\App\Models\Employee::whereNotNull('telepon')->get() as $em)
                    <option value="{{$em->id}}">{{$em->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12 text-success">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span> Auto save
        </span>
    </div>
</div>
