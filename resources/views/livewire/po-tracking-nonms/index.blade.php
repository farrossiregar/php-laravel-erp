@section('title', __('PO Tracking Non MS'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#boq">{{ __('Ericsson Indosat') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="boq">
                    <livewire:po-tracking-nonms.indexboq />
                </div>
            </div>
        </div>
    </div>
    @livewire('po-tracking-nonms.bast')
</div>

<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->
<div class="modal fade" id="modal-potrackingnonms-importaccdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.importaccdoc />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->
@push('after-scripts')
    <script>
        Livewire.on('modalinputpono',(data)=>{
            console.log(data);
            $("#modal-potrackingstp-upload").modal('show');
        });
        Livewire.on('modalimportaccdoc',(data)=>{
            console.log(data);
            $("#modal-potrackingstp-upload").modal('show');
        });
    </script>
@endpush










