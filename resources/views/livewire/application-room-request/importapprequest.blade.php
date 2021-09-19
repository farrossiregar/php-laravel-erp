<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add Application Access Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Employee ID</label>
                            <input type="text" class="form-control" wire:model="employee_id" readonly/>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Employee Name</label>
                            <input type="text" class="form-control" wire:model="employee_name" readonly/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Department</label>
                            <input type="text" class="form-control" wire:model="departement" readonly/>
                        </div>

                        
                        <div class="col-md-6 form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" wire:model="lokasi" readonly/>
                        </div>
                    </div>

                    <div class="row">
                        <div id="app_detail" class="col-md-12 form-group">
                            <label>Application</label>
                            <select class="form-control" wire:model="request_room_detail" required>
                                <option value=""> -- Application -- </option>
                                <option  value="epl">ePL</option>
                                <option  value="eopex">eOPex</option>
                            </select>
                        </div>
                    </div>

                </div>
               
                
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-plus"></i> Submit</button>
    </div>
   
</form>