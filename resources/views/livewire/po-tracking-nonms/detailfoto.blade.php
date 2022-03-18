@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card p-3">
            <div class="row">
                @foreach($data as $key => $item)
                    <div class="col-md-3">
                        <a href="{{ asset($item->image) }}" target="_blank"><img src="{{ asset($item->image) }}" class="img-rounded" alt="Cinque Terre" width="304" height="236"></a>
                        <p>{{ $item->description }}</p>    
                    </div>
                @endforeach
            </div>
            <hr />
            <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    @livewire('po-tracking-nonms.bast')
</div>


<div class="modal fade" id="modal-potrackingnonms-approvebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.approvedetailfoto />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingnonms-revisebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.revisedetailfoto />
        </div>
    </div>
</div>


<script>
    Livewire.on('modalinputpono',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalimportaccdoc',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalapprovedetailfoto',()=>{
        $("#modal-potrackingnonms-approvebast").modal('show');
    });
    Livewire.on('modalrevisedetailfoto',()=>{
        $("#modal-potrackingnonms-revisebast").modal('show');
    });
</script>
<script>
    function hidenote(){
        $('#note').css('display', 'none');
    }   

    function shownote(){
        $('#note').css('display', 'block');
    }   
</script>







