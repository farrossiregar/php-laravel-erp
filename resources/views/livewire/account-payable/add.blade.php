<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Account Payable</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                <label>Cash Transaction No</label> : 
            </div>
            <div class="col-md-6 form-group">
                <label>Request Type</label>
                <select onclick="" class="form-control" wire:model="request_type">
                    <option value=""> --- Request Type --- </option>
                    <option value="1">Petty Cash</option>
                    <option value="2">Weekly Opex</option>
                    <option value="3">Other Opex</option>
                    <option value="4">Rectification</option>
                    <option value="5">Subcont</option>
                    <option value="6">Site Keeper</option>
                    <option value="7">HQ Administration</option>
                    <option value="8">Payroll</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label>Sub Request Type</label> {{session()->get('company_id')}}
                <select onclick="" class="form-control" wire:model="subrequest_type">
                    @if($request_type == 1)
                        <option value=""> --- Sub Request Type (Petty Cash) --- </option>
                        @foreach(\App\Models\PettyCashType::where('company_id', session()->get('company_id'))->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @if($request_type==1)
                <div class="form-group col-md-6">
                    <label>Advance Request No</label> : 
                </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>