<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Add PO Number</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        @if($error_message)
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-times-circle"></i> {{$error_message}}
            </div>
        @endif
        <div class="row">
            <div class="form-group col-md-4">
                <label>PO No</label>
                <input type="text" class="form-control" name="po_no" wire:model="po_number" />
                @error('po_number')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>Date PO</label>
                <input type="date" class="form-control" wire:model="date_po" />
                @error('date_po')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>Works</label>
                <input type="text" class="form-control" wire:model="works" />
                @error('works')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-4">
                <label>Contract</label>
                <input type="text" class="form-control" wire:model="contract" />
                @error('contract')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label>Date Contract</label>
                <input type="date" class="form-control" wire:model="date_contract" />
                @error('date_contract')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <table class="table">
                <thead style="background:#eee;">
                    <tr>
                        <th style="width:50px">No</th>
                        <th>WO Number</th>
                        <th>PO Line Item</th>
                        <th>Region</th>
                        <th>Site ID</th>
                        <th>Site Name</th>
                        <th></th>
                    </tr>
                </thead>
                @if(!$wos)
                    <tr>
                        <td colspan="7" class="text-center"><i>Empty</i></td>
                    </tr>
                @endif
                @foreach($wos as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>
                            <select class="form-control" wire:model="wo_id.{{$k}}" wire:ignore>
                                <option value=""> -- WO Number -- </option>
                                @foreach($wo_list as $wo_item)
                                    <option value="{{$wo_item->id}}">{{$wo_item->no_tt}} / {{$wo_item->region}} / {{$wo_item->site_id}} / {{$wo_item->site_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        @if($wo_id[$k])
                            @php($wo_row = App\Models\PoTrackingNonms::find($wo_id[$k]))
                            <td>
                                <select class="form-control" wire:model="wo_line_item.{{$k}}">
                                    <option value=""> -- Select -- </option>
                                    @foreach(\App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master',$wo_id[$k])->whereNull('po')->get() as $boq)
                                        <option value="{{$boq->id}}">{{$boq->po_line_item}} / {{$boq->item_code}} / {{$boq->item_description}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>{{$wo_row->region}}</td>
                            <td>{{$wo_row->site_id}}</td>
                            <td>{{$wo_row->site_name}}</td>
                        @else <td colspan="4"></td>
                        @endif
                        <td><a href="javascript:void(0)" class="text-danger" wire:click="delete_wo({{$k}})"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <a href="javascript:void(0)" wire:click="add_wo" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Add WO</a>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
    </div>
</form>