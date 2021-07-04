<div>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#raw-data">{{ __('Raw Data') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#stolen">{{ __('Stolen') }}</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#not-stolen">{{ __('Not Stolen') }}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane show active" id="raw-data">
           <livewire:customer-asset-management.raw-data />
        </div>
        <div class="tab-pane" id="not-stolen">
           <livewire:customer-asset-management.data-not-stolen />
        </div>
        <div class="tab-pane" id="stolen">
           <livewire:customer-asset-management.data-stolen />
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:customer-asset-management.upload />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:customer-asset-management.confirm-delete />
        </div>
    </div>
</div>
@section('page-script')
Livewire.on('refresh-page',(data)=>{
    $('.modal').modal('hide');
});
Livewire.on('confirm-delete',(data)=>{
    $("#modal_confirm_delete").modal("show");
});
@endsection