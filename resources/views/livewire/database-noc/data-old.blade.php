<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div>
    <!-- <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="month">
            <option value=""> --- Month --- </option>
            @foreach(\App\Models\EmployeeNoc::select('month')->groupBy('month')->orderBy('month','ASC')->get() as $item)
            <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
            @endforeach
        </select>
    </div> -->

    @if(check_access('database-noc.import-revise'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-databasenoc-importnoc" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Database Noc')}}</a>
    </div>
    
    @endif
    
    
    <div class="col-md-12">
        <br><br>
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
                        <?php
                            $date = date_format(date_create($item->year.'-'.$item->month.'-01'), 'M Y');
                        ?>
                        <td>{{ $date }}</td>
                        <td><label class="badge badge-success" data-toggle="tooltip"><b>{{ $item->jumlah_active }}</b> </label></td>
                        <td>
                            <?php
                                $monthyear = $item->month.'-'.$item->year;
                            ?>
                            
                            <label class="badge badge-danger" data-toggle="tooltip"><b>{{ $item->jumlah_resign }}</b> </label>
                        </td>
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
                            @if(check_access('database-noc.approval'))
                                @if($item->status == '' || $item->status == null)
                                    <a href="javascript:;" wire:click="$emit('modalapprovedatabasenoc','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclinedatabasenoc','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                                @endif
                            @endif
                            

                            @if(check_access('database-noc.import-revise'))
                                @if($item->status == '0')
                                    <a href="javascript:;" wire:click="$emit('modalrevisenoc','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-edit"></i> Revisi</a>
                                @endif
                            @endif

                            <a href="javascript:;" wire:click="$emit('modalpreviewnoc','{{ $monthyear }}')" class="btn btn-info"><i class="fa fa-eye"></i> Preview</a>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>