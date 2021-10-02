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
                            <label>NIK</label>
                            <input type="text" class="form-control" wire:model="nik" readonly/>
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
                    <div wire:ignore class="row" x-data="{request_room_detail_: ''}">
                        <div id="app_detail" class="col-md-12 form-group">
                            <label>Application</label>
                            <select class="form-control" wire:model="request_room_detail" x-model="request_room_detail_" required>
                                <option value=""> -- Application -- </option>
                                <option>Email</option>
                                <option>ePL</option>
                                <option>eOPex</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="col-12 form-group" x-show="request_room_detail_=='Others'">
                            <label>Others Application</label>
                            <input type="text" class="form-control" wire:model.defer="others" />
                        </div>
                        <div class="col-12 form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="" id="" cols="20" rows="5" wire:model.defer="description" required></textarea>
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