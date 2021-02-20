@section('title', $data->name)
@section('parentPageTitle', 'Menu')

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

    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h2>Sub Menu</h2>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table">
                        <tbod>
                        @foreach($items as $k => $item)
                        <tr>
                            <th style="background:#eee;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h5 class="pb-0 mb-0"><a href="javascript:;" data-toggle="modal" data-target="#modal_edit_items">{{$item->name}}</a></h5>
                                        <small>{{ $item->link }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="javascript:void(0)" wire:click="addFunction({{$item->id}})" class="mr-3"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0)" wire:click="deleteItem({{$item->id}})" class="text-danger"><i class="fa fa-trash"></i> </a>
                                    </div>
                                </div>
                            </th>
                        </tr>
                            @foreach($item->func as $function)
                            <tr>
                                <td> - {{ $function->name }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr />
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modal_add_items"><i class="fa fa-plus"></i> Add</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:module.form-edit-sub-menu />
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