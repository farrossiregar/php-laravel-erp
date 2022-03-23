@section('title', __('Work Force Management'))
<div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                @if(check_access('work-flow-management.dashboard'))
                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#wo-never-assigned" wire:click="$emit('chart')">{{ __('Dashboard') }}</a></li>
                @endif
                @if(check_access('work-flow-management.data'))
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
                @endif
            </ul>
            <div class="tab-content">
                @if(check_access('work-flow-management.dashboard'))
                    <div class="tab-pane show active" id="wo-never-assigned">
                        @livewire('work-flow-management.dashboard')
                    </div>
                @endif
                @if(check_access('work-flow-management.data'))
                    <div class="tab-pane" id="data">
                        <livewire:work-flow-management.data />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
    <script src="{{ asset('assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js') }}"></script>
    <script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}?v=2"></script>
    <script>
    $( document ).ready(function() {
        $('.multiselect_month').multiselect({ 
                nonSelectedText: ' --- All Month --- ',
                onChange: function (option, checked) {
                    @this.set('month', $('.multiselect_month').val());
                },
                buttonWidth: '100%'
            }
        );
        $('.multiselect_region').multiselect({ 
                nonSelectedText: ' --- All Region --- ',
                onChange: function (option, checked) {
                    @this.set('region', $('.multiselect_region').val());
                },
                buttonWidth: '100%'
            }
        );
    });
    </script>
@endpush