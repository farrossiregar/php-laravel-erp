<form id="basic-form" method="post" wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Iuran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>{{ __('Department') }} <a href="{{route('department.index')}}" data-toggle="tooltip" title="Data Department" target="_blank"><i class="fa fa-table"></i></a></label>
            <select class="form-control" wire:model="department_id">
                <option value=""> --- Select Department --- </option>
                @foreach(\App\Models\Department::get() as $dep)
                <optgroup label="{{$dep->name}}">
                    @foreach(\App\Models\DepartmentSub::where('department_id',$dep->id)->get() as $sub)
                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
                </optgroup>
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
            @error('link')
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
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
        <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
    </div>
</form>