<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add Room Request {{date('d-M-Y',strtotime($start_date_booking))}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Date</label>
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
                        <div class="col-md-2 form-group">
                            <label>Participant</label>
                            <input type="number" class="form-control" wire:model="participant" required/>
                        </div>
                        <div id="room_detail" class="col-md-3 form-group">
                            <label>Room</label>
                            <select class="form-control" wire:model="request_room_detail" required>
                                <option value=""> -- Room Detail -- </option>
                                <option  value="hrd">Ruang HRD</option>
                                <option  value="server">Ruang Server IT & Jaringan</option>
                                <option  value="finance">Ruang Finance</option>
                                <option  value="informasi">Tempat penyimpanan data & informasi sensitif</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Purpose</label>
                            <textarea class="form-control" cols="10" rows="2" wire:model="purpose" required></textarea>
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