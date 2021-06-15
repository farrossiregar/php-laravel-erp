@section('title', __('PO Tracking Non MS Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <br><br><br>
            <!-- <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#boq">{{ __('Ericson') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#stp">{{ __('Stp') }}</a></li>
            </ul> -->
            <div class="tab-content">
                <!-- <div class="tab-pane"> -->
                    <div class="container">
                        <div class="row">
                        <!-- <?php print_r($data); ?> -->
                            @foreach($data as $key => $item)
                            <div class="col-md-4">
                                <h2>Rounded Corners</h2>
                                <p>{{ $item->description }}</p>            
                                <!-- <img src="https://cdn.mos.cms.futurecdn.net/rNqRoby4d3rr9QCnigVq2B-1200-80.jpeg" class="img-rounded" alt="Cinque Terre" width="304" height="236">  -->
                                <img src="<?php echo asset('storage/po_tracking_nonms/'.$item->image); ?>" class="img-rounded" alt="Cinque Terre" width="304" height="236"> 
                            </div>
                           @endforeach
                           
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
    @livewire('po-tracking-nonms.bast')
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
</script>











