@section('title', __('Insert'))
@section('parentPageTitle', 'Cluster')

<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    
                    <div class="form-group">
                        <label>{{ __('Cluster Name') }}</label>
                        <input type="text" class="form-control" wire:model="name" >
                        @error('Cluster Name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Region Id') }}</label>
                        <input type="text" class="form-control"  wire:model="region_id" >
                        @error('Region Id')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    
                    <hr>
                    <a href="{{route('cluster.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                    <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Save') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>