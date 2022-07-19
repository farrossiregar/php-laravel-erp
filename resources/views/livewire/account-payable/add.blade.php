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
                <label>Cash Transaction No</label> : {{$cash_transaction_no}}
            </div>
            <div class="col-md-6 form-group">
                <label>Request Type</label>
                <select onclick="" class="form-control" wire:model="request_type">
                    <option value=""> --- Request Type --- </option>
                    <option value="1">Petty Cash</option>
                    @if($is_weekly_opex)
                        <option value="2">Weekly Opex</option>
                    @endif
                    <option value="3">Other Opex</option>
                    <option value="4">Rectification</option>
                    <option value="5">Subcont</option>
                    <option value="6">Site Keeper</option>
                    <option value="7">HQ Administration</option>
                    <option value="8">Payroll</option>
                </select>
                @error('request_type')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
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
                    @if($request_type == 2)
                        <option value=""> --- Sub Request Type (Weekly Opex) --- </option>
                        <!-- <option value="Opex Region">OPEX Region</option>
                        <option value="Opex Comcase">OPEX Comcase</option>
                        <option value="Police Report">Police Report</option> -->
                        @foreach(\App\Models\WeeklyOpexType::where('company_id', session()->get('company_id'))->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif

                    @if($request_type == 3)
                        <option value=""> --- Sub Request Type (Other Opex) --- </option>
                        @foreach(\App\Models\OtherOpexType::where('company_id', session()->get('company_id'))->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif

                    @if($request_type == 4)
                        <option value=""> --- Sub Request Type (Rectification) --- </option>
                        @foreach(\App\Models\OtherOpexType::where('company_id', session()->get('company_id'))->get() as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('subrequest_type')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Additional Document </label>
                <input type="file" class="form-control" wire:model="file">
                @error('file')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="col-md-6 form-group">
                <label>Document Type </label>
                <input type="text" class="form-control" wire:model="doc_name">
                @error('doc_name')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="form-group col-md-12">
                <table class="table">
                    <thead style="background: #eee;">
                        <tr>
                            <th>No</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead> 
                    <tbody>
                        @php($num=1)
                        @foreach($items as $k => $item)
                            <tr>
                                <td>{{$num}}</td>
                                <td><input type="text" class="form-control" wire:model="item_description.{{$k}}" /> </td>
                                <td><input type="number" class="form-control text-right" wire:model="item_amount.{{$k}}" /> </td>
                                <td><a href="javascript:void(0)" class="text-danger" wire:click="delete_item({{$k}})"><i class="fa fa-close"></i></a></td>
                            </tr>
                            @php($num++)
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-center"><a href="javascript:void(0)" wire:click="add_item" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Add Item</a></td>
                        </tr>
                        <tr style="background: #eee;">
                            <th></th>
                            <th class="text-right">Total</th>
                            <th class="text-right">{{format_idr($total)}}</th>
                            <th></th>
                        </tr>
                        <tr style="background: #eee;">
                            <th></th>
                            <th class="text-right">Budget</th>
                            <th class="text-right">{{format_idr($budget)}}
                            @error('budget') 
                                <br /><span class="text-danger">{{ $message }}</span>
                            @enderror

                            </th>
                            <th></th>
                        </tr>
                        <tr style="background: #eee;">
                            <th></th>
                            <th class="text-right">Remain</th>
                            <th class="text-right">{{format_idr($budget-$total)}}</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info" wire:loading.remove wire:target="save,request_type">Submit</button>
        <span wire:loading wire:target="save,request_type">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>