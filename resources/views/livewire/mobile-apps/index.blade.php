@section('title', __('Mobile Apps'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#employee">{{ __('Employee') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#commitment-daily">{{ __('Commitment Daily') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#health-check">{{ __('Health Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#vehicle-check">{{ __('Vehicle Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ppe-check">{{ __('PPE Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tools-check">{{ __('Tools Check') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#speed-warning-alarm">{{ __('Speed Warning Alarm') }}</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preventive-maintenance">{{ __('Preventive Maintenance') }}</a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#drug-test">{{ __('Drug Test') }}</a></li>
            </ul>
            <div class="tab-content">
            
                <div class="tab-pane" id="preventive-maintenance">
                    <livewire:mobile-apps.preventive-maintenance />
                </div>
                
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script>
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
</script>