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
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Duty roster')}}</a>
    </div>
    
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>No</td>
                        <td>Status</td> 
                        <td>Action</td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>