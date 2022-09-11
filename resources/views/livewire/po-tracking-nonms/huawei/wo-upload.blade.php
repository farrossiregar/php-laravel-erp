<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>File (xlsx)</label>
            <input type="file" class="form-control" wire:model="file" />
            <a href="{{asset('template/template-po-nonms-huawei.xlsx')}}"><i class="fa fa-download"></i> Download Template</a>
            @error('file')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
        <button type="submit" wire:loading.remove class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
</form>