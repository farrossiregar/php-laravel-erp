<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div href="#" title="Close" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Add Data Region')}}</div>
                </div>
            </div>
            <br>
            <div class="row card">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-control" name="po_no" wire:model="po_no">
                                <option value=""> -- Region --</option>
                                <option value=""></option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div href="#" title="Close" class="btn btn-danger"><i class="fa fa-close"></i> {{__('Close')}}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>CMI</label>
                            <input type="text" class="form-control" name="po_no" wire:model="po_no" />
                        </div>
                        <div class="col-md-4">
                            <label>H3I</label>
                            <input type="text" class="form-control" name="po_no" wire:model="po_no" />
                        </div>
                        <div class="col-md-4">
                            <label>ISAT</label>
                            <input type="text" class="form-control" name="po_no" wire:model="po_no" />
                        </div>
                        <div class="col-md-4">
                            <label>STP</label>
                            <input type="text" class="form-control" name="po_no" wire:model="po_no" />
                        </div>
                        <div class="col-md-4">
                            <label>XL</label>
                            <input type="text" class="form-control" name="po_no" wire:model="po_no" />
                        </div>
                    </div>
                </div>
                
            </div>

            
            
            
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
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