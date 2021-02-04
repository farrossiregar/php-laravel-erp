<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>PIC</label>
                    <input type="text" class="form-control" wire:model="action" />
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" wire:model="action" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Action</label>
                    <input type="text" class="form-control" wire:model="action" />
                </div>
                <div class="form-group">
                    <label>Action</label>
                    <input type="text" class="form-control" wire:model="action" />
                </div>
            </div>
        </div>
        
        
        <div class="form-group">
            <label>Action Point (Repetitive / Non Repetitive)</label>
            <textarea type="text" class="form-control"  wire:model="action_point" ></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Update</button>
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