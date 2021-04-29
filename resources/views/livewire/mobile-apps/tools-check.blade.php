<div>
    <div class="form-group row">
        <div class="col-md-2">
            <select class="form-control" wire:model="employee_id">
                <option value=""> --- Employee --- </option>
                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-control" wire:model="tahun">
                <option value=""> --- Year --- </option>
                @foreach(\App\Models\ToolsCheck::groupBy('tahun')->get() as $y)
                    <option>{{$y->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="bulan">
                <option value=""> --- Month --- </option>
                @foreach(\App\Models\ToolsCheck::groupBy('bulan')->get() as $m)
                    <option>{{$m->bulan}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table m-b-0 c_list">
            <thead>
                <tr style="background:#eee;">
                    <th>No</th>                                    
                    <th>Employee</th> 
                    <th>Year</th>
                    <th>Month</th>
                    @foreach(\App\Models\ToolsCheckItem::get() as $tools)
                    <th>{{$tools->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                        <td>{{$item->year}}</td>
                        <td>{{$item->month}}</td>
                        @foreach(\App\Models\ToolsCheckItem::get() as $tools)
                        <th></th>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
