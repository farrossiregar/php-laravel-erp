<div>
    <div class=" row">
        <div class="col-md-2 form-group">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
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
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                        <td>{{$item->lat}}</td>
                        <td>{{$item->long}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                @endforeach
                @if($data->count() ==0)
                <tr>
                    <td colspan="9" class="text-center"><i>empty</i></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
