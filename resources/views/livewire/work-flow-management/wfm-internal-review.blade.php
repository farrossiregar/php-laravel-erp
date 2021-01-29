<div>
    <div class="header row py-0">
        <div class="col-md-1">
            <select class="form-control" wire:model="region">
                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                <option>{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="text-center mt-1 ml-2" wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered m-b-0 c_list">
                <thead>
                    <tr>
                        <th>SERVICEAREA2</th>
                        <th>NAME</th>
                        @foreach($date as $d)
                        <th>{{date('d M Y',strtotime($d->date))}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->servicearea2}}</td>
                        <td>{{$item->name}}</td>
                        @foreach($date as $d)
                        <td class="text-center"></td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>