<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Approve PO Tracking Non MS Doc</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Approve
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Revise
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <label class="form-check-label">Note</label>
                        <textarea class="form-control" name="note" wire:model="note"></textarea>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Submit</button>
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