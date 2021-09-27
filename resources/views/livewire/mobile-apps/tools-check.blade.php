<div>
    <div class="form-group row">
        <div class="col-md-2">
            <input type="text" class="form-control" placeholder="Searching..." />
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
                    @foreach($toolboxs as $tools)
                    <th class="text-center">{{$tools->name}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$item->bulan}}</td>
                        @foreach($toolboxs as $tool)
                            <td class="text-center">
                            @foreach(\App\Models\ToolboxCheck::where(['toolbox_id'=>$tool->id,'tools_check_id'=>$item->id])->get() as $upload)
                                @if($upload->status==1) <span class="badge badge-success" title="QTY : {{$upload->qty}}">Kondisi Baik</span> @endif
                                @if($upload->status==2) <span class="badge badge-warning" title="QTY : {{$upload->qty}}, Note: {{$upload->note}}">Kondisi Rusak</span> @endif 
                                <a href="{{asset($upload->image)}}" target="_blank"><i class="fa fa-image"></i></a>
                            @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
