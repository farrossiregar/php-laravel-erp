@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')


<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
    <br><br><br>
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#boq">{{ __('Boq') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#stp">{{ __('Stp') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="boq">
                    <livewire:po-tracking-nonms.indexboq />
                </div>
                
                <div class="tab-pane" id="stp">
                    <livewire:po-tracking-nonms.indexstp />
                </div>
            </div>
        </div>
    </div>
</div>




<!--    MODAL PO NON MS INPUT PO NO      -->
<div class="modal fade" id="modal-potrackinginput-pono" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.inputpono />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS INPUT PO NO      -->




<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->
<div class="modal fade" id="modal-potrackingnonms-importaccdoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <livewire:po-tracking-nonms.importaccdoc />
        </div>
    </div>
</div>
<!--    MODAL PO NON MS IMPORT ACCEPTANCE DOC HUAWEI      -->


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











