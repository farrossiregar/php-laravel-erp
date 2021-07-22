<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Accident Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                
                <div class="col-md-12 form-group">
                    <label>Site ID</label>
                    <input type="text" class="form-control" wire:model="site_id"/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Tanggal Kejadian</label>
                    <input type="date" class="form-control" wire:model="date"/>
                </div>
                <div class="col-md-12 form-group">
                    <label>Klasifikasi Insiden</label>
                    <select onclick="" class="form-control" wire:model="klasifikasi_insiden">
                        <option value=""> -- Klasifikasi Insiden --</option>
                        <option value="Cedera / Injury">Cedera / Injury</option>
                        <option value="Kerusakan Property">Kerusakan Property</option>
                        <option value="Lingkungan">Lingkungan</option>
                        <option value="Near Miss">Near Miss</option>
                        
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <label>Jenis Insiden</label>
                    <select onchange="showrincian()" id="jenis_insiden" class="form-control"  wire:model="jenis_insiden">
                        <option value=""> -- Jenis Insiden --</option>
                        <option value="Menabrak / Ditabrak sesuatu">Menabrak / Ditabrak sesuatu</option>
                        <option value="Jatuh / Kejatuhan">Jatuh / Kejatuhan</option>
                        <option value="Jatuh pada permukaan yang sama (terpeleset, terguling)">Jatuh pada permukaan yang sama (terpeleset, terguling)</option>
                        <option value="Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)">Kontak dengan permukaan kerja (benda kasar/tajam, tersayat)</option>
                        <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                        <option value="Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)">Terkena suhu yang ekstrim (Heatstroke, Frostbite, Luka bakar, dll)</option>
                        <option value="Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan">Kontak dengan listrik/ radiasi/ bahankimia/ racun/ kebisingan</option>
                        <option value="Masuknya benda asing ke tubuh/mata/kulit (debu,logam)">Masuknya benda asing ke tubuh/mata/kulit (debu,logam)</option>
                        <option value="Terpapar tekanan berlebih (stress)/ gerakan berlebih">Terpapar tekanan berlebih (stress)/ gerakan berlebih</option>
                        <option value="Terjepit didalam, terkait pada, terjepit diantara, atau tergencet">Terjepit didalam, terkait pada, terjepit diantara, atau tergencet</option>
                        <option value="Gerakan berulang-ulang (ergonomi)">Gerakan berulang-ulang (ergonomi)</option>
                        <option value="Disengat oleh / digigit oleh sesuatu">Disengat oleh / digigit oleh sesuatu</option>
                        <option value="Faktor biologis (Bakteri, Virus, Mikroba, Jamur)">Faktor biologis (Bakteri, Virus, Mikroba, Jamur)</option>
                        <option value="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*">Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*</option>
                        
                    </select>
                </div>
                <div id="div_rincian" style="display: none;" class="col-md-12 form-group">
                    <label>Rincian Kejadian</label>
                    <textarea class="form-control" id="rincian" wire:model="rincian"></textarea>
                </div>
                <div class="col-md-12 form-group">
                    <label>Nik dan Nama</label>
                    <input type="text" class="form-control" wire:model="nikdannama" >
                </div>

                <div class="col-md-12 form-group">
                    <label>Insiden Photo</label>
                    <!-- <div class="form-group">
                        <label>File</label>
                        <input type="file" class="form-control" name="photo1" wire:model="photo1" />
                        @error('file')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div> -->
                    <input type="text" class="form-control" wire:model="photo1" >
                    <input type="text" class="form-control" wire:model="photo2" >
                    <input type="text" class="form-control" wire:model="photo3" >
                    <input type="text" class="form-control" wire:model="photo4" >
                    <input type="text" class="form-control" wire:model="photo5" >
                    <input type="text" class="form-control" wire:model="photo6" >
                    <input type="text" class="form-control" wire:model="photo7" >
                    <input type="text" class="form-control" wire:model="photo8" >
                </div>
             
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
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
<script>

    function showrincian(){
        var insiden = $('#jenis_insiden').val();
        if(insiden == 'Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*'){
            $('#div_rincian').css('display', 'block');
        }else{
            $('#div_rincian').css('display', 'none');
        }
    }
</script>

@section('page-script')
    Livewire.on('rincianinsiden',()=>{
        
        var insiden = $('#jenis_insiden').val();
        if(insiden == 'Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*'){
            $('#div_rincian').css('display', 'block');
        }else{
            $('#div_rincian').css('display', 'none');
        }
    
       
        
        
    });

    

    Livewire.on('modalrevisidana',(data)=>{
        $("#modal-datastpl-revisidana").modal('show');
    });

    Livewire.on('modalapprovedana',(data)=>{
        $("#modal-datastpl-approved").modal('show');
    });
 
@endsection
