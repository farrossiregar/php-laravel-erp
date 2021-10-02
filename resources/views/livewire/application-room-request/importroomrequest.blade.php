<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add Room Request</h5>
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
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Date Booking</label>
                            <input type="date" class="form-control" wire:model="start_date_booking" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Start Time</label>
                            <input type="time" class="form-control" wire:model="start_time_booking" required/>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>End Time</label>
                            <input type="time" class="form-control" wire:model="end_time_booking" required />
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Participant</label>
                            <input type="number" class="form-control" wire:model="participant" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div id="room_detail" class="col-md-5 form-group">
                            <label>Room</label>
                            <select class="form-control" wire:model="request_room_detail" required>
                                <option value=""> -- Room Detail -- </option>
                                <option  value="hrd">Ruang HRD</option>
                                <option  value="server">Ruang Server IT & Jaringan</option>
                                <option  value="finance">Ruang Finance</option>
                                <option  value="informasi">Tempat penyimpanan data & informasi sensitif</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Purpose</label>
                            <textarea class="form-control" name="" id="" cols="20" rows="5" wire:model="purpose" required></textarea>
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