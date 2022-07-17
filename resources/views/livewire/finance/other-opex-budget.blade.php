<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-database"></i> Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <table class="table">
                <thead style="background:#eee;">
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Budget</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>