<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Field Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Scope of Work</label>
            <textarea class="form-control" wire:model="scoope_of_work"></textarea>
            @error('scoope_of_work')
                <ul class="parsley-errors-list filled"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>
        <div class="form-group" wire:ignore>
            <label>Field Team</label>
            <select class="form-control select-field_team">
                <option value="">-- select --</option>
                @foreach($field_teams as $item)
                    <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                @endforeach
            </select>
        </div>
        @error('field_team_id')
            <ul class="parsley-errors-list filled"><li class="parsley-required">{{ $message }}</li></ul>
        @enderror
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
        <button type="submit" wire:loading.remove class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
</form>
@push('after-scripts')
    <script>
        $(document).ready(function() {    
            $(".select-field_team").select2();
            $('.select-field_team').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('field_team_id',data.id);
            });
        });
    </script>
@endpush