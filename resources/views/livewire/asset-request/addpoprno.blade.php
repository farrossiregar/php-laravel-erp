@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Request Asset</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                       
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead style="background:#eee;">
                                                    <tr>
                                                        <th style="width:10px">No</th>
                                                        <th class="text-right">PR / PO Numbers</th>
                                                        <th class="text-right">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $k =>  $item)
                                                        <tr>
                                                            <td>{{ $k+1 }}</td>
                                                            <td class="text-right">{{ $item->pr_po_number }}</td>
                                                            <td class="text-right">{{ $item->amount }}</td>
                                                        </tr>
                                                    @endforeach
                                                    @if($insert)
                                                        <tr>
                                                            <td></td>
                                                            
                                                            <td>
                                                                <input type="number" class="form-control text-right" wire:model="pr_no" placeholder="PR / PO Number" />
                                                                @error('pr_no')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <input type="number" class="form-control text-right" wire:model="amount" placeholder="Amount" />
                                                                @error('amount')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <!-- <button wire:loading.remove wire:target="save" type="submit" class="badge badge-info badge-active"><i class="fa fa-save"></i> Save</button> -->
                                                                <a href="javascript:void(0)" wire:loading.remove wire:target="save" wire:click="$set('insert',false)" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Cancel</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            @if($insert==false)
                                                <a href="javascript:void(0)" wire:click="$set('insert',true)" class="badge badge-info badge-active"><i class="fa fa-plus"></i> PR / PO Number</a>
                                            @endif
                                            <br><br>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
        <script type="text/javascript">
        

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                input_val = "Rp" + left_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = "Rp" + input_val;
            }
            
            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
        </script>
        @endpush
</div>