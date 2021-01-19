@section('title', $data->name)
@section('parentPageTitle', 'Cluster')

<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" wire:submit.prevent="save">
                    <div class="form-group">
                        <label for="sel1">{{ __('Region Name') }}</label>
                        <select class="form-control" id="sel1"  wire:model="region_id">
                            <option value="">{{__('--- Region Name --- ')}} </option>
                            @foreach(\App\Models\Region::orderBy('id','ASC')->get() as $item)
                            <option value="{{$item->id}}" <?php if($data->region_id == $item->id){ echo "selected"; } ?>>{{$item->region}}</option>
                            @endforeach
                        </select>
                        @error('Region Name')
                        <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Cluster Name') }}</label>
                        <input type="text" class="form-control" wire:model="name" >
                        @error('Cluster Name')
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