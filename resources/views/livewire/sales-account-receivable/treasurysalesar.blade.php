<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Update Treasury</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
        
            <div class="col-md-6" >
                <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 30px; width: 100%; margin: auto;">

                    <div class="row">
                        <br>
                            <div class="col-md-12 form-group">
                                <h5>From</h5>
                            </div>
                        <br>
                        <div class="form-group">
                            <label>Paid Amount in Bank</label>
                            <input type="text" name="" id="" class="form-control" wire:model="paid_amount_bank" readonly>
                            
                        </div>

                        <div class="form-group">
                            <label>Bank & Account No</label>
                            <input type="text" name="" id="" class="form-control" wire:model="bank">
                            
                        </div>

                        <div class="form-group">
                            <label>PIC</label>
                            <input type="text" name="" id="" class="form-control" wire:model="pic">
                            
                        </div>
                    </div>
                </div>
            </div>
                
            

            <div class="col-md-6" >
                <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 30px; width: 100%; margin: auto;">

                    <div class="row">
                        <br>
                            <div class="col-md-12 form-group">
                                <h5>To</h5>
                            </div>
                        <br>
                        
                        <div class="form-group">
                            <label>Paid Amount in Bank</label>
                            <input type="text" name="" id="" class="form-control" wire:model="paid_amount_bank" readonly>
                            
                        </div>

                        <div class="form-group">
                            <label>Bank & Account No</label>
                            <input type="text" name="" id="" class="form-control" wire:model="bank">
                            
                        </div>

                        <div class="form-group">
                            <label>PIC</label>
                            <input type="text" name="" id="" class="form-control" wire:model="pic">
                            
                        </div>
                    
                    </div>
                </div>
                
            </div>
        </div>
        
    
    
        <div class="modal-footer">
            <button type="button" class="btn btn-success  close-modal"  wire:click="save"><i class="fa fa-check"></i> Submit</button>
        </div>
        <!-- <div wire:loading>
            <div class="page-loader-wrapper" style="display:block">
                <div class="loader" style="display:block">
                    <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    <p>Please wait...</p>
                </div>
            </div>
        </div> -->
        
    </div>
    
    
</form>

