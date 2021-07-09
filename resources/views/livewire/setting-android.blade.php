<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Speed Warning Alarm</label>
            <div class="alert alert-warning" role="alert">Batas kecepatan maksimum yang diperbolehkan Tim Lapangan.</div>
            <div class="row">
                <input type="number" class="form-control ml-3 mr-2" style="width:100px;" wire:model="speed_limit" />
                <span>km/h</span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Location Of Field Team</label>
            <div class="alert alert-warning" role="alert">Simpan lokasi field team setiap beberapa menit.</div>
            <div class="row">
                <input type="number" class="form-control ml-3 mr-2" style="width:100px;" wire:model="limit_location_of_field_team" />
                <span>menit</span>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <span wire:loading.delay class="text-success">
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span> Auto save
        </span>
    </div>
</div>
