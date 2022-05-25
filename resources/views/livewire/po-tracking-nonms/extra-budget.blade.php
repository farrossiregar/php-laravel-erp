<div class="modal fade" wire:ignore.self id="modal_extra_budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form wire:submit.prevent="save">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Extra Budget</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" wire:model="extra_budget" />
                        @error('extra_budget')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <!-- <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" wire:model="file_extra_budget" />
                        @error('file_extra_budget')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>