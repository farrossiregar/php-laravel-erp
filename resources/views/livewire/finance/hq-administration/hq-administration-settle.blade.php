<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Settlement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Cash Transaction No</label> : {{isset($data->cash_transaction_no) ? $data->cash_transaction_no : '-'}}
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label>File</label>
                <input type="file" class="form-control" wire:model="file" />
                @error('file')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <table class="table">
                    <thead style="background: #eee;">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th class="text-right">Amount</th>
                            <th class="text-right">Amount Settle</th>
                        </tr>
                    </thead> 
                    <tbody>
                        @php($num=1)
                        @if(isset($data->items))
                            @foreach($data->items as $k => $item)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$item->description}}</td>
                                    <td class="text-right">{{format_idr($item->amount)}}</td>
                                    <td><input type="number" class="form-control text-right" wire:model="item_amount.{{$k}}" /> </td>
                                </tr>
                                @php($num++)
                            @endforeach
                            <tr style="background: #eee;">
                                <th></th>
                                <th class="text-right">Total</th>
                                <th class="text-right">{{format_idr($total)}}</th>
                                <th class="text-right">{{format_idr($total_settle)}}</th>
                            </tr>
                            <!-- <tr style="background: #eee;">
                                <th></th>
                                <th class="text-right">Difference</th>
                                <th></th>
                                <th class="text-right">{{format_idr($total_difference)}}</th>
                            </tr> -->
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info" wire:loading.remove wire:target="save">Submit</button>
        <span wire:loading wire:target="save">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>