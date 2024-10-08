<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Upload Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>File (xlsx)</label>
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
            <a href="{{asset('template/template-site-list.xlsx')}}">Download Template</a>
        </div>
    </div>
    <div class="modal-footer">
        <button wire:loading.remove type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
    </div>
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Checking data...</p>
            </div>
        </div>
    </div>
</form>