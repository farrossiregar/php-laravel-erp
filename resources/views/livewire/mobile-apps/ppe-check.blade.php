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
                    <th class="text-center">Employee & PPE</th>
                    <th class="text-center">Banner</th>
                    <th class="text-center">Sertifikasi WAH</th>
                    <th class="text-center">Electrical</th>
                    <th class="text-center">First Aid</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $k => $item)
                <tr>
                    <td>{{$k+1}}</td>
                    <td>{{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                    <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                    <td class="text-center">
                        @if($item->foto_dengan_ppe)
                            <a href="{{asset($item->foto_dengan_ppe)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_banner)
                            <a href="{{asset($item->foto_banner)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_wah)
                            <a href="{{asset($item->foto_wah)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_elektrikal)
                            <a href="{{asset($item->foto_elektrikal)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->foto_first_aid)
                            <a href="{{asset($item->foto_first_aid)}}" target="_blank"><i class="fa fa-image"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
