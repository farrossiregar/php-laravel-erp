@section('title', __('Accident Report - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model="date" />
                    </div>
                    
                    <!-- <div class="col-md-2">
                        <a href="#" data-toggle="modal" data-target="#modal-accidentreport-inputdata" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Dana STPL')}}</a>
                    </div> -->
                    <div class="col-md-2">
                        <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Accident Report')}}</a>
                    </div>
                   
                </div>

                <div class="body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 c_list">
                            <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Employee ID</th> 
                                    <th>Site ID</th> 
                                    <th>Date</th>  
                                    <th>Klasifikasi Insiden</th> 
                                    <th>Jenis Insiden</th> 
                                    <th>Kronologis</th> 
                                    <th>Nik dan Nama</th> 
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->employee_id }}</td>
                                    <td>{{ $item->site_id }}</td>
                                    <td>{{ date_format(date_create($item->date), 'd M Y') }}</td>
                                    <td>{{ $item->klasifikasi_insiden }}</td>
                                    <td>{{ $item->jenis_insiden }}</td>
                                    <td>{{ $item->rincian_kronologis }}</td>
                                    <td>{{ $item->nik_and_nama }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accidentreport-inputdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:accident-report.inputaccident />
        </div>
    </div>
</div>

