<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Regional Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>PR Number</label>
            <input type="text" class="form-control" wire:model="pr_no" />
            @error('pr_no')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Date of Req PR</label>
            <input type="date" class="form-control" wire:model="date_of_req_pr" />
            @error('date_of_req_pr')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group">
            <label>Supplier</label>
            <input type="text" class="form-control" wire:model="supplier" />
            @error('supplier')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="row">
            <div class="form-group col-md-7">
                <label>PR Amount</label>
                <input type="number" class="form-control" wire:model="pr_amount" />
                @error('pr_amount')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="form-group col-md-5">
                <label>Margin (%)</label>
                <input type="number" class="form-control" wire:model="margin" readonly />
                @error('margin')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Status PR</label>
            <input type="text" class="form-control" wire:model="status_pr" />
            @error('status_pr')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="submit" wire:loading.remove wire:target="save" class="btn btn-info"><i class="fa fa-save"></i> Submit Budget</button>
        <span wire:loading wire:target="save">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>