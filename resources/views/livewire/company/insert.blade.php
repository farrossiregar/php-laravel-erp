@section('title', __('Insert'))
@section('parentPageTitle', 'Company')

<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    
                    <div class="form-group">
                        <label>{{ __('Company Name') }}</label>
                        <input type="text" class="form-control" wire:model="name" >
                        @error('Company Name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Telephone') }}</label>
                        <input type="text" class="form-control"  wire:model="telepon" >
                        @error('Telephone')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Address') }}</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control" wire:model="address"></textarea>
                        @error('Address')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Logo') }}</label>
                        <input type="text" class="form-control"  wire:model="logo" >
                        @error('Logo')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Code') }}</label>
                        <input type="text" class="form-control"  wire:model="code" >
                        @error('Code')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Website') }}</label>
                        <input type="text" class="form-control"  wire:model="website" >
                        @error('Website')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    
                    <hr>
                    <a href="{{route('company.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>