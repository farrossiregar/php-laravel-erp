@section('title', __('Mobile Apps'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#employee">{{ __('Employee') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#wfm-internal-review">{{ __('Raw Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="dashboard">
                    <livewire:mobile-apps.employee />
                </div>
                <div class="tab-pane" id="wfm-internal-review">

                </div>
            </div>
        </div>
    </div>
</div>