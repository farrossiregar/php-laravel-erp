<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Upload Acceptance Doc & Invoice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Invoice No</label>
            <input type="text" class="form-control" wire:model="invoice_no" />
            @error('invoice_no')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Invoice Date</label>
            <input type="date" class="form-control" wire:model="invoice_date" />
            @error('invoice_date')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Acceptance Doc</label>
            <input type="file" class="form-control" wire:model="file" />
            @error('file')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Invoice</label>
            <input type="file" class="form-control" wire:model="file_invoice" />
            @error('file_invoice')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
    </div>
    <div wire:loading wire:target="save,file_invoice,file">
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>