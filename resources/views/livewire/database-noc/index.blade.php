@section('title', __('Database NOC - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model="date" />
                    </div>

                    @if(check_access('accident-report.input'))
                    <div class="col-md-2">
                        <a href="#" data-toggle="modal" data-target="#modal-databasenoc-importnoc" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Database Noc')}}</a>
                    </div>
                  
                    @endif
                   
                </div>

                <div class="body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 c_list">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Month</th> 
                                    <th>Active Personel</th> 
                                    <th>Resign Personel</th> 
                                    <th>Status</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->month.' '.$item->year }}</td>
                                    <td>{{ $item->jumlah_active }}</td>
                                    <td><a href="javascript:;" wire:click="$emit('modalpreviewnoc','{{ $item->id }}')" >{{ $item->jumlah_resign }}</a></td>
                                    <td>
                                        @if($item->status == '1')
                                            <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                                        @endif
                                        
                                        @if($item->status == '0')
                                            <label class="badge badge-danger" data-toggle="tooltip" title="{{ $item->note }}">Decline</label>
                                        @endif

                                        @if($item->status == '' || $item->status == null)
                                            <label class="badge badge-warning" data-toggle="tooltip" title="Waiting Approval">Waiting Approval</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status == '' || $item->status == null)
                                            <a href="javascript:;" wire:click="$emit('modalapprovedatabasenoc','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                            <a href="javascript:;" wire:click="$emit('modaldeclinedatabasenoc','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                                        @endif

                                        @if($item->status == '0')
                                            <a href="javascript:;" wire:click="$emit('modalimportnoc','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Revisi</a>
                                        @endif
                                    </td>
                                    
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

<div class="modal fade" id="modal-databasenoc-importnoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.importnoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-approvenoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.approvenoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-declinenoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:database-noc.declinenoc />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-databasenoc-previewnoc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:database-noc.previewnoc />
        </div>
    </div>
</div>


@section('page-script')


    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-databasenoc-importnoc").modal('show');
    });

    Livewire.on('modaldeclinedatabasenoc',(data)=>{
        $("#modal-databasenoc-declinenoc").modal('show');
    });

    Livewire.on('modalapprovedatabasenoc',(data)=>{
        $("#modal-databasenoc-approvenoc").modal('show');
    });

    Livewire.on('modalpreviewnoc',(data)=>{
        $("#modal-databasenoc-previewnoc").modal('show');
    });

@endsection