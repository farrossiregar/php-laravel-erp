@section('title', "Insert")
@section('parentPageTitle', 'Employee')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="tab-content">
                <div class="tab-pane show active" id="general">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Foto</h6>
                                <div class="media photo">
                                    <div class="media-left m-r-15">
                                        @if(!empty($foto))
                                        <img src="{{ $foto->temporaryUrl() }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p>Upload your Foto</p>
                                        <button type="button" class="btn btn-default-dark" id="btn-upload-photo"><i class="fa fa-upload"></i> Upload Photo</button>
                                        <input type="file" id="filePhoto" class="sr-only" wire:model="foto">
                                        @error('pas_foto')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6>Foto KTP</h6>
                                <div class="media photo">
                                    <div class="media-left m-r-15">
                                        @if(!empty($foto_ktp))
                                        <img src="{{ $foto_ktp->temporaryUrl() }}" class="user-photo media-object" alt="Foto KTP" style="width:100%;">
                                        @endif
                                    </div>
                                    <div class="media-body">
                                        <p>Upload your Foto KTP.</p>
                                        <button type="button" class="btn btn-default-dark" id="btn-upload-foto_ktp"><i class="fa fa-upload"></i> Upload Photo</button>
                                        <input type="file" id="foto_ktp" class="sr-only" wire:model="foto_ktp">
                                        @error('foto_ktp')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="basic-form" method="post" wire:submit.prevent="save">
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>General Info</h5>
                                    <hr />
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Code / Alias</label>
                                            <input type="text" class="form-control" wire:model="employee_code" placeholder="{{ __('Code / Alias') }}" >
                                            @error('employee_code')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Name</label>
                                            <input type="text" class="form-control" wire:model="name" placeholder="{{ __('Name') }}" >
                                            @error('name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>NIK</label>
                                            <input type="text" class="form-control"  wire:model="nik" placeholder="{{ __('NIK') }}" >
                                            @error('nik')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>KTP</label>
                                            <input type="text" class="form-control"  wire:model="ktp" placeholder="{{ __('KTP') }}" >
                                            @error('ktp')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control"  wire:model="email" placeholder="{{ __('Email') }}" />
                                            @error('email')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control"  wire:model="telepon" placeholder="{{ __('Telepon') }}" />
                                            @error('telepon')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Place of Birth</label>
                                            <input type="text" class="form-control" placeholder="Place of Birth" wire:model="place_of_birth" >
                                            @error('place_of_birth')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Date of Birth</label>
                                            <input type="date" class="form-control" placeholder="Date of Birth" wire:model="date_of_birth" >
                                            @error('date_of_birth')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Marital Status</label>
                                            <select class="form-control" wire:model="marital_status">
                                                <option value=""> --- Marital Status --- </option>
                                                @foreach(config('vars.marital_status') as $k => $i)
                                                <option value="{{$k}}">{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('marital_status')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Blood Type</label>
                                            <select class="form-control" wire:model="blood_type">
                                                <option value=""> --- Blood Type --- </option>
                                                @foreach(config('vars.blood_type') as $k => $i)
                                                <option>{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('blood_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Postcode</label>
                                            <input type="text" class="form-control"  wire:model="postcode" placeholder="{{ __('Postcode') }}" />
                                            @error('postcode')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Religion</label>
                                            <select class="form-control" wire:model="religion">
                                                <option value=""> --- Religion --- </option>
                                                @foreach(config('vars.religion') as $i)
                                                <option>{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('religion')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address KTP</label>
                                        <textarea class="form-control" wire:model="address" placeholder="{{ __('Address') }}""></textarea>
                                        @error('address')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Domisili</label>
                                        <textarea class="form-control" wire:model="domisili" placeholder="{{ __('Domisili') }}""></textarea>
                                        @error('domisili')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5>Position / Access</h5>
                                    <hr />
                                    <div class="form-group">
                                        <label>Company</label>
                                        <select class="form-control" wire:model="company_id">
                                            <option value=""> --- Company --- </option>
                                            @foreach(\App\Models\Company::get() as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>   
                                            @endforeach
                                        </select>
                                        @error('company_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="form-group" x-data="{showProject:false}">
                                        <label>Department</label>
                                        <select class="form-control" wire:model="department_id">
                                            <option value="">{{__('--- Department --- ')}} </option>
                                            @foreach(\App\Models\Department::orderBy('name','ASC')->get() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                        @enderror
                                    </div>
                                    <div class="row" x-data="{open:@entangle('showProject')}">
                                        <div class="form-group col-md-12" x-show="open">
                                            <label class="mr-2">Project</label>
                                            <select class="form-control multiselect multiselect-custom multiselect_project" multiple="multiple" wire:model="project_id" >
                                                @foreach($projects as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>   
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Employee Status</label>
                                            <select class="form-control" wire:model="employee_status">
                                                <option value=""> --- Employee Status --- </option>
                                                @foreach(config('vars.employee_status') as $k => $i)
                                                <option value="{{$k}}">{{$i}}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_status')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region_id">
                                                <option value="">{{__('--- Region --- ')}} </option>
                                                @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $item)
                                                @if(empty($item->region))@continue @endif
                                                <option value="{{$item->id}}">{{$item->region}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_access_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Rule / Access</label>
                                            <select class="form-control" wire:model="user_access_id">
                                                <option value="">{{__('--- Position --- ')}} </option>
                                                @foreach(\App\Models\UserAccess::orderBy('name','ASC')->get() as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('user_access_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Lokasi Kantor</label>
                                            <select class="form-control" wire:model="lokasi_kantor">
                                                <option value=""> --- Lokasi Kantor --- </option>
                                                <option>Kantor Pusat (Duren Tiga,Jakarta)</option>
                                                <option>Kantor Cabang / Homebase</option>
                                            </select>
                                            @error('company_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" value="1" wire:model="is_noc">
                                            <span>NOC Database</span>
                                        </label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row border mx-0 py-2 mt-2" x-show="open" @click.away="open = false">
                                            <div class="form-group col-md-6">
                                                <label>Password</label>
                                                <input type="password" class="form-control"  wire:model="password" placeholder="Password">
                                                @error('password')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control"  wire:model="confirm" placeholder="Confirm">
                                                @error('confirm')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <a href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                            <span wire:loading>
                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                <span class="sr-only">{{ __('Loading...') }}</span>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
<script>
    @foreach($employee_project as $item)
    $('.multiselect_project').find("option[value='{{$item->client_project_id}}']").prop("selected", true);
    @endforeach

    var _multiSelect = $('.multiselect_project').multiselect({ 
            nonSelectedText: ' --- Select Project --- ',
            onChange: function (option, checked) {
                @this.set('project_id', $('.multiselect_project').val());
            },
            buttonWidth: '100%'
        });
    Livewire.on('load-project',()=>{
        _multiSelect.multiselect('destroy');
        _multiSelect.multiselect({
            nonSelectedText: ' --- Select Project --- ',
            onChange: function (option, checked) {
                @this.set('project_id', $('.multiselect_project').val());
            },
            buttonWidth: '100%'
        });
        console.log("load project");
    });
</script>
@endpush
@section('page-script')
$('#btn-upload-photo').on('click', function() {
    $(this).siblings('#filePhoto').trigger('click');
});
$('#btn-upload-foto_ktp').on('click', function() {
    $(this).siblings('#foto_ktp').trigger('click');
});
@endsection