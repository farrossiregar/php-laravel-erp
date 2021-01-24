@section('title', 'Dashboard')
@section('parentPageTitle', 'Work Flow Management')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#underwriting">WO Never Assigned</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#reinsurance">Assigned Never Accept WO</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#claim">Accept Never Close WO Manual</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#claim">Total FT Never Close Manual</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#claim">Total FT Never Close Manual</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="underwriting">
                    <div class="header row">
                        <div class="col-md-2">
                            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                        </div>
                    </div>
                    <div class="body">
                        <div id="multiple-chart" class="ct-chart"></div>
                    </div>
                </div>
                <div class="tab-pane" id="claim">
                </div>
                <div class="tab-pane" id="reinsurance">
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist/css/chartist.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')}}"/>
<script src="{{ asset('assets/bundles/chartist.bundle.js')}}"></script>
<script src="{{ asset('assets/vendor/chartist/polar_area_chart.js')}}"></script>
<script src="{{ asset('assets/js/pages/charts/chartjs.js')}}"></script>
@endpush
@section('page-script')
var dataMultiple = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    series: [{
        name: 'series-real',
        data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
    }, {
        name: 'series-projection',
        data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],            
    }]
};
options = {
    lineSmooth: false,
    height: "230px",
    low: 0,
    high: 'auto',
    series: {
        'series-projection': {
            showPoint: true,                
        },
    },
    
    options: {
        responsive: true,
        legend: false
    },

    plugins: [
        Chartist.plugins.legend({
            legendNames: ['Actual', 'Projection']
        })
    ]
};
new Chartist.Line('#multiple-chart', dataMultiple, options);
@endsection