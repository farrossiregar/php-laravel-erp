<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Approval History Asset Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container py-2 mt-4 mb-4">
            @foreach(\App\Models\LogActivity::where('subject', 'Approvalhistoryassetrequest'.$selected_id)->orderBy('id', 'desc')->get() as $k => $item)
            <div class="row">
                <div class="col-auto text-center flex-column d-none d-sm-flex">
                    
                    <div class="row h-40">
                        @if($k != 0)
                        <div class="col" style="border-right: 3px solid lightgray;">&nbsp;</div>
                        @else
                        <div class="col">&nbsp;</div>
                        @endif
                        <div class="col">&nbsp;</div>
                    </div>
                    
                    <h5 class="m-2">
                        @if(json_decode($item->var)->status == '0')
                        <span style="background-color: #de4848;" class="badge badge-pill bg-danger border">&nbsp;</span>
                        @else
                        <span style="background-color: #28a745;" class="badge badge-pill bg-success border">&nbsp;</span>
                        @endif
                    </h5>
                    
                    <div class="row h-40">
                        @if($k != (count(\App\Models\LogActivity::where('subject', 'Approvalhistoryassetrequest'.$selected_id)->orderBy('id', 'desc')->get()) - 1))
                        <div class="col" style="border-right: 3px solid lightgray;">&nbsp;</div>
                        @endif
                        <div class="col">&nbsp;</div>
                    </div>
                    
                </div>
                <div class="col py-2">
                    <div class="card-body">
                        @if(json_decode($item->var)->status == '0')
                        <h5 class="card-title" style="color: #de4848; margin-bottom: 0;">Decline</h5>
                        @else
                        <h5 class="card-title" style="color: #28a745; margin-bottom: 0;">Approve</h5>
                        @endif

                        <span style="font-size: 11px; color: gray;">{{ date_format(date_create($item->created_at), 'd M Y H:i') }}</span>
                        
                        <p class="card-text" style="margin-top: 5px;">
                            @if(json_decode($item->var)->note)
                                <b>Note : </b> <i>{{json_decode($item->var)->note}}</i> 
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    
    
</form>

