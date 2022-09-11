<form>
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Acknowledge Extra Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <p>
                <label>Amount </label> : Rp. {{isset($data) ? format_idr($data->extra_budget) : '-'}}<br />
            </p>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click="approve" class="btn btn-success"><i class="fa fa-check-circle"></i> Acknowledge</button>
    </div>
</form>