<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Preview Accident Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12 form-group">
                        <label>Site ID</label>
                        <input type="text" class="form-control" value="{{ $site_id }}"  disabled/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Employee</label>
                        <input type="text" class="form-control" value="{{ $employee_id }}" disabled/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Tanggal Kejadian</label>
                        <input type="text" class="form-control" value="{{ date_format(date_create($date), 'd M Y') }}" disabled/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Klasifikasi Insiden</label>
                        <input type="text" class="form-control" value="{{ $klasifikasi_insiden }}" disabled/>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Jenis Insiden</label>
                        <input type="text" class="form-control" value="{{ $jenis_insiden }}"  disabled/>
                
                    </div>
                    <div id="div_rincian" class="col-md-12 form-group">
                        <label>Rincian Kejadian</label>
                        <textarea class="form-control" id="rincian" disabled>{{ $rincian_kronologis }}</textarea>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Nik dan Nama</label>
                        <input type="text" class="form-control" value="{{ $nik_and_nama }}"  disabled >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                    
                       @foreach(\App\Models\AccidentReportImage::where('accident_report_id', $selected_id)->orderBy('id', 'asc')->get() as $key => $item)
                        <div class="col-md-6">
                            <label>Insiden Photo {{ $key + 1 }}</label>
                            <img src="<?php echo asset('storage/Accident_Report/web/'.$item->image); ?>" class="img-rounded" alt="" width="160" height="160"> 
                        </div>
                       @endforeach
                    </div>
                   
                

                
             
            </div>
        </div>
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
