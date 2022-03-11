<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Invoice Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-md-12 form-group">  
            <div class="row">
                <div class="col-md-4 form-group">
                    <label>Invoice No</label>
                    <input class="form-control"  wire:model="invoice_no" readonly>

                </div>

                <div class="col-md-6 form-group">
                    <label>Tax Invoice Number (Faktur Pajak)</label>
                    <input class="form-control"  wire:model="tax_invoice_no" readonly>

                </div>
                <div class="col-md-2 form-group">
                    <label>Currency</label>
                    <input list="curr" type="text" class="form-control" wire:model="currency" readonly>
                    
                </div>
            </div>
        </div>

        @foreach(\App\Models\SalesInvoiceListingDetaildesc::where('id_master', $selected_id)->orderBy('id', 'asc')->get() as $key => $item)
        <?php
            $i = $key+1;
        ?>
        <div class="col-md-12 form-group">
            <label>Item Description {{ $i }}</label>
            <input type="text" class="form-control" value="<?php echo $item->item_description; ?>" readonly>
            
        </div>
        <div class="row" style="margin: 0 4px;">
            <!-- <div class="col-md-3 form-group">
                <label>Currency</label>
                <input list="curr" type="text" class="form-control" value="<?php echo $item->currency; ?>" readonly>
                
            </div> -->

            <div class="col-md-4 form-group">
                <label>QTY </label>
                <input type="number" class="form-control" value="<?php echo $item->qty; ?>" readonly>
            
            </div>

            <div class="col-md-4 form-group">
                <label>Price per Unit </label>
                <input type="number" class="form-control" value="<?php echo $item->price_perunit; ?>" readonly>
            
            </div>

            <div class="col-md-4 form-group">
                <label>Total </label>
                <input type="number" class="form-control" value="<?php echo $item->total; ?>" readonly>
            
            </div>
        </div>
        @endforeach

        
        <div class="row" style="margin: 0 4px; width: 100%; margin-top: 60px;">
            <div class="col-md-9 form-group" style="width:75%;">
                <label for="">Total Item</label>
            </div>                                        
            <div class="col-md-3 form-group" style="width:25%;">
                <input type="number" class="form-control" value="<?php echo $total; ?>" readonly>
            </div>                                      
        </div>

        <div class="row" style="margin: 0 4px; width: 100%;">
            <div class="col-md-3 form-group" style="width:25%;">
                <!-- <label for="">VAT</label> -->
                <select class="form-control"  wire:model="vat" >
                    <option value=""> --- VAT --- </option>
                    <option value="1" <?php if($vat == '1'){ echo 'selected'; }; ?> >YES</option>
                    <option value="0" <?php if($vat == '0'){ echo 'selected'; }; ?>>NO</option>
                </select>
            </div> 
            <div class="col-md-3 form-group" style="width:25%;">
                
            </div>                                        
            <div class="col-md-3 form-group" style="width:25%;">
                
            </div>                                        
            <div class="col-md-3 form-group" style="width:25%;">
                <input type="number" class="form-control" value="<?php if($vat == '1'){ echo ($total*10)/100; }else{ echo '0'; } ?>" readonly>
            </div>                                      
        </div>

        <div class="row" style="margin: 0 4px; width: 100%;">
            <div class="col-md-9 form-group" style="width:75%;">
                <label for="">Amount + VAT</label>
            </div>                                        
            <div class="col-md-3 form-group" style="width:25%;">
                <input type="number" class="form-control" value="<?php if($vat == '1'){ echo $total + (($total*10)/100); }else{ echo $total; } ?>" readonly>
            </div>                                      
        </div>

        <!-- <div class="row">
            <div class="col-md-6 form-group">
                <label>Deduction </label>
                <input type="number" class="form-control" value="<?php echo $deduction; ?>" readonly>
                
            </div>

            <div class="col-md-6 form-group">
                <label>WHT ART 23 </label>
                <input type="number" class="form-control" value="<?php echo $art23; ?>" readonly>
            </div>

            <div class="col-md-6 form-group">
                <label>WHT ART 4 </label>
                <input type="number" class="form-control" value="<?php echo $art4; ?>" readonly>
                
                @error('art4')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>

            <div class="col-md-6 form-group">
                <label>Invoice Net Amount </label>
                <input type="number" class="form-control" value="<?php echo $net_amount; ?>" readonly>
                
                @error('net_amount')
                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
        </div> -->
        
      
    </div>
    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
    </div> -->
     <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
    
</form>

