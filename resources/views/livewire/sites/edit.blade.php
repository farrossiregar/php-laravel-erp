@section('title', __('Edit #'. $data->name))
@section('parentPageTitle', 'Site')

<div class="row clearfix">
    <div class="col-md-4">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    <div class="form-group">
                        <label>{{ __('Site ID') }}</label>
                        <input type="text" class="form-control" wire:model="site_id" >
                        @error('site_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Site Name') }}</label>
                        <input type="text" class="form-control"  wire:model="name" >
                        @error('name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('Site Technology') }}</label>
                            <input type="text" class="form-control"  wire:model="site_technology" >
                            @error('site_technology')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Site Owner') }}</label>
                            <select class="form-control" wire:model="site_owner">
                                <option value=""> --- Select --- </option>
                                <option>TMG</option>
                                <option>TLP</option>
                            </select>
                            @error('site_owner')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('TLP Company') }}</label>
                            <input type="text" class="form-control"  wire:model="tlp_company" >
                            @error('tlp_company')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Site Category') }}</label>
                            <input type="text" class="form-control"  wire:model="site_category" >
                            @error('site_category')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>{{ __('Site Type') }}</label>
                            <input type="text" class="form-control"  wire:model="site_type" >
                            @error('site_type')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label>{{ __('Regional') }}</label>
                            <input type="text" class="form-control"  wire:model="regional" >
                            @error('regional')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Service Manager Area') }}</label>
                        <select class="form-control" wire:model="region_id">
                            <option value=""> --- Select --- </option>
                            @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $item)
                            <option value="{{$item->id  }}">{{$item->region}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Cluster') }}</label>
                        <select class="form-control" wire:model="region_cluster_id">
                            <option value=""> --- Cluster --- </option>
                            @foreach(\App\Models\Cluster::where('region_id',$region_id)->orderBy('name','ASC')->get() as $item)
                            <option value="{{$item->id  }}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Field Team') }}</label>
                        <select class="form-control" wire:model="employee_id">
                            <option value=""> --- Field Team --- </option>
                            @foreach(\App\Models\Employee::whereNotNull('user_id')->orderBy('name','ASC')->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <hr>
                    <a href="{{route('sites.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
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