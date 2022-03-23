<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input PO No</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>WO Number</th>
                        <th>Region</th>
                    </tr>
                </thead>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$item->no_tt}}</td>
                        <td>{{$item->region}}</td>
                    </tr>        
                @endforeach
            </table>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label>PO No</label>
                <input type="text" class="form-control" name="po_no" wire:model="po_no" />
            </div>
            <div class="form-group col-md-2">
                <label>Date PO</label>
                <input type="date" class="form-control" wire:model="date_po" />
            </div>
            <div class="form-group col-md-4">
                <label>Contract</label>
                <input type="text" class="form-control" wire:model="contract" />
            </div>
            <div class="form-group col-md-2">
                <label>Date Contract</label>
                <input type="text" class="form-control" wire:model="date_contract" />
            </div>
        </div>
        <div class="row clearfix file_manager">
            @foreach($data as $item)
                @if(isset($item->bast_file))
                    @foreach($item->bast_file as $img)
                        <div class="col-md-3">
                            <div class="card" x-data="{open:false}">
                                <div class="file" @mouseover="open = true" @mouseover.away = "open = false">
                                    <div class="hover" x-show="open">
                                        <button type="button" wire:click="delete_bast({{$img->id}})" class="btn btn-icon btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="icon">
                                        <a href="{{asset($img->image)}}" target="_blank"><img src="{{asset($img->image)}}" style="height:100px" /></a>
                                    </div>
                                    <div class="file-name">
                                        <p class="m-b-5 text-muted">{{$img->description}}</p>
                                        <small><span class="date text-muted">{{date('d/m/Y',strtotime($img->created_at))}}</span></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
</form>