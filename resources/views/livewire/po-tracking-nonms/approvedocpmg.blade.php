<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Proccess PO Tracking Non MS Doc</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label class="form-check-label">Note</label>
            <textarea class="form-control" name="note" wire:model="note"></textarea>
            @error('note')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
            <!-- <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" wire:model="status" >
                        <label class="form-check-label" for="flexRadioDefault1">
                            Approve
                        </label>
                    </div>
                    <br>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" wire:model="status" >
                        <label class="form-check-label" for="flexRadioDefault2">
                            Revise
                        </label>
                    </div>
                </div>
            </div>
             -->
        </div>
    </div>
    <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-success" wire:click="approve"><i class="fa fa-check"></i> Approve</a>
        <a href="javascript:void(0)" class="btn btn-danger" wire:click="revise"><i class="fa fa-times"></i> Revise</a>
    </div>
    <div wire:loading wire:target="approve">
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
    <div wire:loading wire:target="revise">
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>