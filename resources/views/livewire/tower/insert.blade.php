<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Tower</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
        <input type="hidden" wire:model="parent_id" />
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Tower</label>
            <input type="text" class="form-control" wire:model="name" />
            @error('name')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group" wire:ignore>
            <label>Site</label>
            <select class="form-control select_site" id="site_id" wire:model="site_id">
                <option value=""> --- Select --- </option>
                @foreach(\App\Models\Site::orderBy('name','ASC')->get() as $site)
                <option value="{{$site->id}}">{{$site->site_id}} - {{$site->name}}</option>
                @endforeach
            </select>
            @error('site_id')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger close-btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-info close-modal btn-sm"><i class="fa fa-save"></i> Save</button>
    </div>
</form>
@push('after-scripts')
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}"/>
<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<style>
    .select2-container .select2-selection--single {height:36px;padding-left:10px;}
    .select2-container .select2-selection--single .select2-selection__rendered{padding-top:3px;}
    .select2-container--default .select2-selection--single .select2-selection__arrow{top:4px;right:10px;}
    .select2-container {width: 100% !important;}
</style>
<script>
    select__2 = $('.select_site').select2();
    $('.select_site').on('change', function (e) {
        let elementName = $(this).attr('id');
        var data = $(this).select2("val");
        @this.set(elementName, data);
    });
    var selected__ = $('.select_site').find(':selected').val();
    if(selected__ !="") select__2.val(selected__);
</script>
@endpush