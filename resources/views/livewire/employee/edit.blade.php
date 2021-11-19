@section('title', $data->name)
@section('parentPageTitle', 'Employee')
<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#general">{{ __('General') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#history">{{ __('History') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="history">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Subject</th>
                                <th>Date</th>
                                <th>URL</th>
                                <th>IP</th>
                                <th>Agent</th>
                                <th>var</th>
                            </tr>
                            @foreach($history as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->url}}</td>
                                    <td>{{$item->ip}}</td>
                                    <td>{{$item->agent}}</td>
                                    <td>{{$item->var}}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{$history->links()}}
                    </div>
                </div>
                <div class="tab-pane show active" id="general">
                    <div class="body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6>Foto</h6>
                                <div class="media photo">
                                    <div class="media-left m-r-15">
                                        @if(!empty($foto))
                                        <img src="{{ $foto->temporaryUrl() }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                        @else 
                                            @if(!empty($data->foto))
                                                <img src="{{ asset('storage/foto/'.$data->user_id.'/'.$data->foto) }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                            @endif
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
                                        @else
                                            @if(!empty($data->foto_ktp))
                                                <img src="{{ asset('storage/foto/'.$data->user_id.'/'.$data->foto_ktp) }}" class="user-photo media-object" alt="Pasphoto" style="width:100%;">
                                            @endif
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
                                                <option value="{{$k}}" wire:key="marital_status_{{$k}}">{{$i}}</option>
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
                                    <div class="row">
                                        <div class="form-group col-6" wire:ignore>
                                            <label>Department</label>
                                            <select class="form-control" wire:model="department_id">
                                                <option value="">{{__('--- Department --- ')}} </option>
                                                @foreach(\App\Models\Department::where('is_project',0)->orderBy('name','ASC')->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            @php($sub_department = \App\Models\DepartmentSub::where('department_id',$this->department_id)->get())
                                            @if($sub_department->count()>0)
                                                <label>Sub Department</label>
                                                <select class="form-control" wire:model="sub_department_id">
                                                    <option value="">-- Sub Department -- </option>
                                                    @foreach($sub_department as $sub)
                                                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row" x-data="{open:@entangle('showProject')}">
                                        <div class="form-group col-md-12" x-show="open">
                                            <label class="mr-2">Project</label>
                                            <select class="form-control multiselect multiselect-custom multiselect_project" multiple="multiple" wire:model="project_id" style="height:35px !important;" >
                                                @foreach($projects as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>   
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region_id">
                                                <option value="">{{__('--- Region --- ')}} </option>
                                                @foreach(\App\Models\ClientProjectRegion::select('region.id','region.region')->join('region','region.id','=','client_project_region.region_id')->whereIn('client_project_region.client_project_id',$client_project_ids)->groupBy('region.id')->get() as $item)
                                                @if(empty($item->region))@continue @endif
                                                <option value="{{$item->id}}">{{$item->region}}</option>
                                                @endforeach
                                            </select>
                                            @error('region_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Sub Region</label>
                                            <select class="form-control" wire:model="sub_region_id">
                                                <option value="">{{__('--- Sub Region --- ')}} </option>
                                                @foreach(\App\Models\SubRegion::where('region_id',$region_id)->get() as $sub)
                                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_region_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6" wire:ignore>
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
                                            <label>Rule / Access</label>
                                            <select class="form-control" wire:model="user_access_id">
                                                <option value="">{{__('--- Position --- ')}} </option>
                                                @foreach(\App\Models\UserAccess::where('is_project',$is_project)->orderBy('name','ASC')->get() as $item)
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
                                                <option>Kantor Cabang/Homebase</option>
                                            </select>
                                            @error('lokasi_kantor')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" value="1" wire:model="is_manager">
                                            <span>Set Manager</span>
                                        </label>
                                    </div>
                                    <div  x-data="{open:@entangle('showEditPassword') }" class="mb-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <a href="javascript:void(0)" x-on:click="open = ! open"><i class="fa fa-key"></i> Change Password</a>
                                            </div>
                                        </div>
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
                                            <div class="col-12">
                                                <a href="javascript:void(0)" wire:click="update_password" class="btn btn-info btn-sm">Submit Password</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <h5>Android</h5>
                                    <hr />
                                    <div class="form-group">
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" value="1" wire:model="is_use_android">
                                            <span>Active Android</span>
                                        </label>
                                    </div>
                                    <div class="form-group border p-3">
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_site_list" />
                                                <span>Site List</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_daily_commitment" />
                                                <span>Daily Commitment</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_health_check" />
                                                <span>Health Check</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_vehicle_check" />
                                                <span>Vehicle Check</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_ppe_check" />
                                                <span>PPE Check</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_tools_check" />
                                                <span>Tools Check</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_location_of_field_team" />
                                                <span>Location of Field Team</span>
                                            </label>
                                        </p>  
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_speed_warning" />
                                                <span>Speed Warning Alarm</span>
                                            </label>
                                        </p>  
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_drug_test" />
                                                <span>Drug Test</span>
                                            </label>
                                        </p>  
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_preventive_maintenance" />
                                                <span>Preventive Maintenance</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_customer_asset" />
                                                <span>Customer Asset</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_work_order" />
                                                <span>Work Order</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_training_material" />
                                                <span>Training Material & Exam</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label class="fancy-checkbox">
                                                <input type="checkbox" value="1" wire:model="app_it_support" />
                                                <span>IT Support</span>
                                            </label>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>PIC Speed Warning Alarm</label>
                                        <select class="form-control" wire:model="speed_warning_pic_id">
                                            <option value=""> --- select --- </option>
                                            @foreach(\App\Models\Employee::whereNotNull('telepon')->get() as $em)
                                                <option value="{{$em->id}}">{{$em->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <a href="javascript:;" onclick="history.back()"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                            <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
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
        setTimeout(function(){
            _multiSelect.multiselect('destroy');
            @foreach($employee_project as $item)
            $('.multiselect_project').find("option[value='{{$item->client_project_id}}']").prop("selected", true);
            @endforeach
            _multiSelect.multiselect({
                nonSelectedText: ' --- Select Project --- ',
                onChange: function (option, checked) {
                    @this.set('project_id', $('.multiselect_project').val());
                },
                buttonWidth: '100%'
            });
            console.log("load project");
        },1000);
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