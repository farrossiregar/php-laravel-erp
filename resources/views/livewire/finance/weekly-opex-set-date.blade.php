<form wire:submit.prevent="save_set_date">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-database"></i> Date</h5>
    </div>
    <div class="modal-body row">
        <div class="form-group col-md-6">
            <label>Start Date</label>
            <input type="date" class="form-control" wire:model="start_date" />
            @error('start_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label>End Date</label>
            <input type="date" class="form-control" wire:model="end_date" />
            @error('end_date')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Save</button>
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>
@push('after-scripts')
<script>
    Livewire.on('close-modal-date',()=>{
        $("#modal_set_date").modal('hide');
    })
</script>
@endpush