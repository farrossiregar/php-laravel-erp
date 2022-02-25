<div class="modal fade" wire:ignore.self id="modal_process_extra_budget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Process Extra Budget</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                @if(isset($selected_data))
                    <div class="form-group">
                        <p>
                            <label>Extra Budget </label> : Rp. {{format_idr($selected_data->extra_budget)}}<br />
                            <label>File </label> : <a href="{{asset($selected_data->extra_budget_file)}}" target="_blank"><i class="fa fa-image"></i></a>
                        </p>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" wire:model="note" placeholder="Note / Remark"></textarea>
                        @error('note')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</button>
                <button type="button" wire:click="approve" class="btn btn-success"><i class="fa fa-check-circle"></i> Approve</button>
            </div>
            <div wire:loading wire:target="reject">
                <div class="page-loader-wrapper" style="display:block">
                    <div class="loader" style="display:block">
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                        <p>Please wait...</p>
                    </div>
                </div>
            </div>
            <div wire:loading wire:target="approve">
                <div class="page-loader-wrapper" style="display:block">
                    <div class="loader" style="display:block">
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                        <p>Please wait...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>