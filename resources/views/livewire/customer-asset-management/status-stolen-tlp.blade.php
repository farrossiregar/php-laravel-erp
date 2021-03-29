<div>
    <a href="javascript:;" class="badge badge-danger" data-toggle="modal" data-target="#modal_tt_{{$data->id}}"><i class="fa fa-warning"></i> Not Verify</a>
    <div wire:ignore.self  class="modal fade" id="modal_tt_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="text-warning fa fa-warning"></i> {{ __('Trouble Ticket') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($create_trouble_ticket)
                        <form wire:submit.prevent="save">
                            <div class="form-group">
                                <h6><small>Trouble Ticket Number</small> : <span class="text-info">{{$trouble_ticket_number}}</span></h6>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" wire:model="subject" />
                                @error('subject')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                                @error('description')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="file" class="form-control" placeholder="File" wire:model="file" />
                                @error('file')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Submit Trouble Ticket</button>
                            </div>
                        </form>
                    @else
                    @foreach($tt as $item)
                    <div class="card" style="display: block;">
                        <table class="table table-">
                            <tbody>
                                <tr>
                                    <th>Trouble Ticket Number</th>
                                    <td>{{$item->trouble_ticket_number}}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>{{$item->subject}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{$item->description}}</td>
                                </tr>
                                <tr>
                                    <th>File</th>
                                    <td><a href={{asset("storage/customer-asset/trouble-ticket/{$item->file}")}} target="_blank"> <i class="fa fa-search-plus"></i> view </a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endforeach       
                    <div class="form-group">
                        <a href="javascript:;" class="btn btn-info" wire:click="$set('create_trouble_ticket',true)"><i class="fa fa-plus"></i> Create Trouble Ticket</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
