<div>
    <a href="javascript:;" class="badge badge-info" data-toggle="modal" data-target="#upload_boq_{{$data->id}}"><i class="fa fa-upload"></i> Upload BOQ</a>
    
    <div wire:ignore.self class="modal fade" id="upload_boq_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="save">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> {{ __('Upload BOQ') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="file" wire:model="file" />
                            @error('file')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> Upload</button>
                    </div>
                    <div wire:loading>
                        <div class="page-loader-wrapper" style="display:block">
                            <div class="loader" style="display:block">
                                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                                <p>{{ __('Please wait...') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
