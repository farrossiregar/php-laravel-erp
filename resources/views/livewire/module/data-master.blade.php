<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table">
                        @foreach(\App\Models\ModulesItem::where(['module_id'=>$data->id])->whereNull('parent_id')->get() as $k => $item)
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
                                    @livewire('module.delete-sub', ['data'=>$function],key(17+$function->id.$item->id))
                                    <small>{{$function->link}}</small>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                    <a href="#" data-toggle="modal" data-target="#modal_add_items"><i class="fa fa-plus"></i> Add</a>
                </div>
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
                <form wire:submit.prevent="save_function">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Function</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                        <input type="hidden" wire:model="parent_id" />
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name_function" />
                            @error('name_function')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" class="form-control" wire:model="link_function" />
                            @error('link_function')
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

@section('page-script')
Livewire.on('modalAddFunction', (id) =>
    $('#modal_add_function').modal('show')
);
Livewire.on('hideModal', () =>
    $('#modal_add_items').modal('hide')
);
@endsection