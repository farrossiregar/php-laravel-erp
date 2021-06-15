<div class="modal fade" wire:ignore.self id="modal_bast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form wire:submit.prevent="save">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> BAST</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{$url_generate_bast}}" target="_blank"><i class="fa fa-download"></i> BAST</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('po-tracking-nonms.detailfoto',['id'=>'34']) }}" target="_blank"><i class="fa fa-eye"></i> Detail Foto BAST</a>
                        </div>
                    </div>
                    
                    
                    @if(isset($data->bast_status) and $data->bast_status==1)
                        <div class="form-group">
                            <label>Upload BAST</label>
                            <input type="file" class="form-control" name="file" wire:model="file_bast" />
                            <br>
                            @error('file_bast')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Upload GR</label>
                            <input type="file" class="form-control" wire:model="file_gr" />
                            <br>
                            @error('file_gr')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" wire:model="note" placeholder="Note"></textarea>
                            @error('note')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if(isset($data->bast_status) and $data->bast_status==1)
                        <button type="button" class="btn btn-success" wire:click="approve"><i class="fa fa-check"></i> Approve</button>
                        <button type="button" class="btn btn-danger" wire:click="revisi"><i class="fa fa-times"></i> Revisi</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>