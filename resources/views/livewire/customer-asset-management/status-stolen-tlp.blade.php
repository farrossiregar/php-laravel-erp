<div>
    <a href="javascript:;" class="badge badge-danger" data-toggle="modal" data-target="#modal_tt_{{$data->id}}"><i class="fa fa-warning"></i> Waiting Upload</a>
    <div wire:ignore.self  class="modal fade" id="modal_tt_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="text-warning fa fa-warning"></i> {{ __('Upload Capture Open TT') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" >
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
