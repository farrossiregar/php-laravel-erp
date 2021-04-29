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
                    <th>Date</th>
                    <th>Employee & PPE</th>
                    <th>Banner</th>
                    <th>Sertifikasi WAH</th>
                    <th>Electrical</th>
                    <th>First Aid</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $k => $item)
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
