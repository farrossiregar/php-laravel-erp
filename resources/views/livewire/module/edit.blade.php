@section('title', $data->name)
@section('parentPageTitle', 'Menu')

<div class="row clearfix">
    <div class="col-md-3">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    <div class="form-group">
                        <label>{{ __('Department') }} <a href="{{route('department.index')}}" data-toggle="tooltip" title="Data Department" target="_blank"><i class="fa fa-table"></i></a></label>
                        <select class="form-control" wire:model="department_id">
                            <option value=""> --- Select Department --- </option>
                            @foreach(\App\Models\Department::get() as $dep)
                                <option value="{{$dep->id}}">{{$dep->name}}</option>
                            @endforeach
                        </select>
                        @error('client_project_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Project') }}</label>
                        <select class="form-control" wire:model="client_project_id">
                            <option value=""> --- Select Project --- </option>
                            @foreach(\App\Models\Company::get() as $company)
                            <optgroup label="{{$company->code}}">
                                @foreach(\App\Models\ClientProject::where('company_id',$company->id)->get() as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                        @error('client_project_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Sub Menu') }}</label>
                        <input type="text" class="form-control" wire:model="name" >
                        @error('name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Prefix Link') }}</label>
                        <input type="text" class="form-control" wire:model="prefix_link" >
                        @error('prefix_link')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('icon') }}</label>
                            <input type="text" class="form-control" wire:model="icon" >
                            @error('icon')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Color') }}</label>
                            <input type="text" class="form-control" wire:model="color" >
                            @error('color')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="checkbox" wire:model="status" value="1" data-parsley-errors-container="#error-checkbox" data-parsley-multiple="checkbox">
                            <span>Active</span>
                        </label>
                    </div>
                    <hr>
                    <a href="{{route('module.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="header">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_add_group" class="btn btn-info"><i class="fa fa-plus"></i> Add Group</a>
            </div>
            <div class="body pt-0">
                @foreach(\App\Models\ModuleGroup::where('module_id',$data->id)->get() as $group)
                    <div class="table-responsive" wire:key="{{$group->id.date('YmdHis')}}">
                        <h5>{{$group->name}}</h5>
                        <table class="table">
                            @foreach(\App\Models\ModulesItem::where(['module_id'=>$data->id,'module_group_id'=>$group->id])->whereNull('parent_id')->get() as $k => $item)
                                <tr>
                                    <th style="background:#eee;">
                                        <div class="row mx-0">
                                            <div class="col-md-6 mx-0">
                                                @livewire('module.form-edit-sub-menu', ['data'=>$item], key($item->id))
                                                <small>{{ $item->link }}</small>
                                            </div>
                                            <div class="col-md-6 mx-0">
                                                <a href="javascript:void(0)" wire:click="addFunction({{$item->id}})" class="mr-3"><i class="fa fa-plus"></i></a>
                                                <a href="javascript:void(0)" wire:click="deleteItem({{$item->id}})" class="text-danger"><i class="fa fa-trash"></i> </a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                @foreach($item->func as $function)
                                <tr>
                                    <td>
                                        @livewire('module.delete-sub', ['data'=>$function],key($function->id))
                                        <small>{{$function->link}}</small>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                        </table>
                        <a href="#" data-toggle="modal" data-target="#modal_add_items" wire:click="$emit('set_module_group',{{$group->id}})"><i class="fa fa-plus"></i> Add</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal_add_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="save_group">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Group</label>
                            <input type="text" class="form-control" wire:model="name_group" />
                            @error('name_group')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger close-btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-info close-modal btn-sm"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<div wire:ignore.self class="modal fade" id="modal_add_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:module.form :data="$data">
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="modal_add_function" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('module.form-function', ['data' => $data])
        </div>
    </div>
</div>
@section('page-script')
Livewire.on('modalAddFunction', (id) =>
    $('#modal_add_function').modal('show')
);
Livewire.on('hideModal', () =>
    $('#modal_add_items').modal('hide')
);
@endsection