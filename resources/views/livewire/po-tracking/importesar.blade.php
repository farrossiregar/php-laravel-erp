<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Upload Data PO Tracking ESAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>File</label>
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="col-md-12">
            <!-- <a href="{{ asset('storage/app/public/po_tracking/esar/approved_esar120210228022835.pdf') }}"><i class="fa fa-download"></i> Download Sample Excel</a> -->
            <a href="{{ asset('po_tracking/esar/approved_esar120210228022835.pdf') }}"><i class="fa fa-download"></i> Download Auto Generate ESAR</a>
            <br>
            <?php echo $appesar; ?>
            
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