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
                        <a href="#" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Dana STPL')}}</a>
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
                                    <th>Site ID</th> 
                                    <th>Employee ID</th> 
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
                                    <td><a href="javascript:;" wire:click="$emit('modalpreview','{{ $item->id }}')" >{{ $item->site_id }}</a></td>
                                    <td>
                                        <?php
                                            $employee_name = \App\Models\Employee::where('id', $item->employee_id)->first();
                                            // print_r($employee_name);
                                            echo @$employee_name->name;
                                        ?>
                                    </td>
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

<div class="modal fade" id="modal-accidentreport-previewdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:accident-report.previewaccident />
        </div>
    </div>
</div>


@section('page-script')


    Livewire.on('modalpreview',(data)=>{
        $("#modal-accidentreport-previewdata").modal('show');
    });

@endsection