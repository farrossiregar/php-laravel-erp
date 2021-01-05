@section('title', $data->name)
@section('parentPageTitle', 'User Access')

<div class="row clearfix">
    <div class="col-md-4">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    <div class="form-group">
                        <label>{{ __('Name') }}</label>
                        <input type="text" class="form-control" wire:model="name" >
                        @error('name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Description') }}</label>
                        <input type="text" class="form-control"  wire:model="description" >
                        @error('description')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <br>
                    <a href="{{route('user-access.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary ml-3">{{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="header">
                <h2>{{ __('Menu') }}</h2>
            </div>
            <div class="body pt-0">
                <table class="table table-hover">
                    @foreach(\App\Models\Module::all() as $key_module => $module)
                    <tr style="background: #eee;">
                        <th style="width:20px;">{{ $key_module+1 }}.</th>
                        <td><strong>{{ $module->name }}</strong></td>
                        <td></td>
                    </tr>
                    @if($module->menu)
                        @foreach($module->menu as $key_menu => $menu)
                        <tr>
                            <td></td>
                            <td>{{ $menu->name }}</td>
                            <td><input type="checkbox"  wire:click="checkmodule({{ $menu->id }})" wire:model="module_id.{{ $menu->id }}" /></td>
                        </tr>
                            @foreach($menu->func as $key_func => $func)
                            <tr>
                                <td></td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $func->name }}</td>
                                <td><input type="checkbox" wire:click="checkmodule({{ $func->id }})" wire:model="module_id.{{ $func->id }}"  /></td>
                            </tr>
                            @endforeach
                        @endforeach
                    @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>