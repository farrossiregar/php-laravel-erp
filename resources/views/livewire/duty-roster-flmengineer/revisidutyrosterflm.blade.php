<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Revisi Duty Roster FLM Engineer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">

                <div class="col-md-12">
                    @error('projectcode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" wire:model="name" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Position</label>
                    <input type="text" class="form-control" wire:model="position" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Account Mateline</label>
                    <input type="text" class="form-control" wire:model="account_mateline" />
                </div>
                <div class="col-md-12 form-group">
                    <label>No Pass ID</label>
                    <input type="text" class="form-control" wire:model="no_pass_id" />
                </div>
                
                <div class="col-md-12 form-group">
                    <label>Training K3</label>
                    <select class="form-control" wire:model="training_k3">
                        <option value="">-- Training K3 --</option>
                        <option value="Done">Done</option>
                        <option value="Not yet">Not yet</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label>Status Synergy</label>
                    <select class="form-control" wire:model="status_synergy">
                        <option value="">-- Status Synergy --</option>    
                        <option value="Synergy">Synergy</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label>Total Site</label>
                    <input type="text" class="form-control" wire:model="total_site" />
                </div>
            </div>
            
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-edit"></i>Update</button>
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