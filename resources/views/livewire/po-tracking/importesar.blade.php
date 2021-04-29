<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Approved ESAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    
    @if(isset($po->status) and $po->status==2)
    <div class="modal-body">
        @foreach($files as $k => $item)
            <div wire:key="{{$k}}" >
                <div class="form-group">
                    <input type="text" class="form-control" wire:model="title.{{$k}}" placeholder="ESAR / Verification Docs" />
                </div>
                <div class="form-group">
                    <input type="file" class="form-control" wire:model="file.{{$k}}" />
                    @error('file')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                    @enderror
                    @if($k!=0)  
                <a href="javascript:void(0)" wire:click="delete_file({{$k}})" class="text-danger"><i class="fa fa-trash"></i> delete</a>
                @endif
                </div>
                <hr />
            </div> 
        @endforeach
        <a href="javascript:void(0)" wire:loading.remove wire:click="add_files" data-toggle="tooltip" title="Add Document Upload"><i class="fa fa-plus"></i> Docs</a>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
    </div>
    @endif
    @if(isset($po->status) and $po->status>=3)
        <div class="modal-body">
            @foreach($esar_upload as $esar)
                <p>{{$esar->title}} <a href="{{asset('storage/po_tracking/ApprovedEsar/'.$esar->approved_esar_filename)}}" target="_blank"><i class="fa fa-download"></i> Download</a></p>
            @endforeach
        </div>
    @endif
</form>