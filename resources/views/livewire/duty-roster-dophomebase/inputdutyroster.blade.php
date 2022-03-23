<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Input Duty Roster DOP - Homebase</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="">Nama (Homebase/DOP)</label>
                <input type="text" class="form-control" name="nama_dop" wire:model="nama_dop" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Project</label>
                <input type="text" class="form-control" name="project" wire:model="project" />
            </div>
            <div class="form-group col-md-12">
                <label for="">Region</label>
                <input type="text" class="form-control" name="region" wire:model="region" />
            </div>
            <div class="form-group col-md-12">
                <label for="">Alamat</label>
                <textarea type="text" class="form-control" cols="20" rows="6" name="alamat" wire:model="alamat"></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="">Longitude</label>
                <input type="text" class="form-control" name="long" wire:model="long" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Latitude</label>
                <input type="text" class="form-control" name="lat" wire:model="lat" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Pemilik (Homebase/DOP)</label>
                <input type="text" class="form-control" name="pemilik_dop" wire:model="pemilik_dop" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Telepon Pemilik (Homebase/DOP)</label>
                <input type="text" class="form-control" name="telepon_pemilik" wire:model="telepon_pemilik" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Opex (Region/GA)</label>
                <input type="text" class="form-control" name="opex_region_ga" wire:model="opex_region_ga" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Type (Homebase/DOP)</label>
                <select class="form-control" wire:model="type_homebase_dop">
                    <option value="">-- Select --</option>
                    <option>Homebase</option>
                    <option>DOP</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="">Start Date</label>
                <input type="date" class="form-control" wire:model="start_date" />
            </div>
            <div class="form-group col-md-3">
                <label for="">Expired</label>
                <input type="date" class="form-control" name="expired" wire:model="expired" />
            </div>
            <div class="form-group col-md-6">
                <label for="">Budget</label>
                <input type="text" class="form-control" name="budget" wire:model="budget" />
            </div>
        </div>
       
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Submit</button>
    </div>
    <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
</form>