@section('title', __('Vehicle'))
@section('parentPageTitle', 'Duty Roster')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                @if(check_access('vehicle.data'))
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                @endif
            </ul>
            <div class="tab-content">
                @if(check_access('site-tracking.data'))
                    <div class="tab-pane active" id="data">
                        <livewire:vehicle.data />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>