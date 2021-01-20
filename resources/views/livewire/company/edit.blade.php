@section('title', $data->name)
@section('parentPageTitle', 'Company')

<div class="row clearfix">
    <div class="col-md-12">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-md-6">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>{{ __('Logo') }}</h6>
                                <div class="form-group">
                                    <div class="media photo">
                                        <div class="media-left m-r-15">
                                            @if(!empty($logo))
                                            <img src="{{ $logo->temporaryUrl() }}" class="user-photo media-object" alt="Logo" style="width:100%;">
                                            @else 
                                                @if(!empty($data->logo))
                                                    <img src="{{ asset('storage/logo/'.$data->logo) }}" class="user-photo media-object" alt="Logo" style="width:100%;">
                                                @endif
                                            @endif

                                        </div>
                                        <div class="media-body">
                                            <p>Upload your Foto</p>
                                            <button type="button" class="btn btn-default-dark" id="btn-upload-logo"><i class="fa fa-upload"></i> Upload Photo</button>
                                            <input type="file" id="logo" class="sr-only" wire:model="logo">
                                            @error('logo')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
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
                        </div>
                    </div>
                   
                    
                    <hr>
                    <a href="{{route('company.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('page-script')
$('#btn-upload-logo').on('click', function() {
    $(this).siblings('#logo').trigger('click');
});

@endsection