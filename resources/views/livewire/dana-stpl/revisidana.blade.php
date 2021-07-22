<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Revisi Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                @if(isset($detaildana->note))
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">{{$detaildana->note}}</div>
                    </div>
                @endif
                <div class="col-md-12 form-group">
                    <label>Project</label>
                    <input type="text" class="form-control" wire:model="project_name" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Region</label>
                    <input type="text" class="form-control" wire:model="region" readonly/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Project Manager</label>
                    <input type="text" class="form-control" wire:model="sm" readonly/>
                </div>
                
                <div class="col-md-12 form-group">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="danastpledit" wire:model="danastpl" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
</form>
