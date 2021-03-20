<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Approve Bast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value='1' wire:model="status" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Approve
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value='0' wire:model="status" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Reject
                </label>
            </div>
            <!-- <label>Approve</label>
            <input type="radio" class="form-control" name="status" value='1' wire:model="status" />
            <label>Reject</label>
            <input type="radio" class="form-control" name="status" value='0' wire:model="status" /> -->
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-save"></i> Submit</button>
    </div>
    <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
</form>