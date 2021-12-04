<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Petty Cash</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            @foreach(\App\Models\PettyCashUploader::where('id_petty_cash', $this->selected_id)->get() as $item)
            <div class="col-md-2">
                <a href="<?php echo asset('storage/PettyCash/'.$item->settlement); ?>" target="_blank"><i class="fa fa-download fa-2x" style="color: #28a745;" tooltip="Download {{ $item->settlement }}"></i></a>
            </div>
            
            @endforeach
        </div>
        <br>
        <div class="form-group">
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
    </div>
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>