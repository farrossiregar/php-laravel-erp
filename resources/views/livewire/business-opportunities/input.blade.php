@section('title', __('Business Opportunities - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Business Opportunities</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Customer</label>
                                            <input type="text" class="form-control" wire:model="customer"/>
                                            @error('customer')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control" wire:model="project_name"/>
                                            @error('project_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region">
                                                <option value="">-- Region --</option>
                                                @foreach(\App\Models\Region::orderBy('id', 'desc')->get() as $item)
                                                <option value="{{ $item->region }}">{{ $item->region }}</option>
                                                @endforeach
                                            </select>
                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" wire:model="qty"/>
                                            @error('qty')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Price / Unit</label>
                                            <input type="text" class="form-control" wire:model="price_or_unit"/>
                                            @error('price_or_unit')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Estimated Revenue</label>
                                            <input type="number" class="form-control" wire:model="estimate_revenue"/>
                                            @error('estimate_revenue')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Duration</label>
                                            <input type="number" class="form-control" wire:model="duration"/>
                                            @error('duration')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="startdate"/>
                                            @error('startdate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="enddate"/>
                                            @error('enddate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="start_dur"/>
                                            @error('start_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="end_dur"/>
                                            @error('end_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                        <div class="col-md-12 form-group">
                                            <label>Brief Description of Project</label>
                                            <textarea class="form-control" wire:model="brief_description"></textarea>
                                            @error('start_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label>Customer_type</label>
                                            <select class="form-control" wire:model="customer_type" x-data="">
                                                <option value="">-- Customer Type --</option>
                                                <option value="Tower Provider">Tower Provider</option>
                                                <option value="Vendor">Vendor</option>
                                                <option value="Operators">Operator</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <!-- <div x-show="$wire.show_customer_type2" class="mt-2">
                                                <input type="text" class="form-control" placeholder="Customer lain yang tidak disebutkan diatas:  *Free Text*" wire:model="customer_type2">
                                            </div> -->
                                            @error('customer_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                       
                                        <!-- <div class="col-md-12 form-group" x-data="">
                                            <label>Jenis Insiden</label>
                                            <select class="form-control" wire:model="jenis_insiden" >
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
                                            <div x-show="$wire.show_jenis_insiden2" class="mt-2">
                                                <input type="text" class="form-control" placeholder="Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*" wire:model="jenis_insiden2">
                                            </div>
                                        </div>
                                            @error('jenis_insiden')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror -->
                                        
                                        <!-- <div class="col-md-12 form-group">
                                            <label>Nik dan Nama</label>
                                            <input type="text" class="form-control" wire:model="nikdannama" >
                                            @error('nikdannama')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    <!-- <a href="{{route('accident-report.index')}}" class="mr-2"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a> -->
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>