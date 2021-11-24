<div>
    <div class="form-group row">
        <div class="pl-3 py-2 form-group" x-data="{open_dropdown:false}" @click.away="open_dropdown = false">
            <a href="javascript:void(0)" x-on:click="open_dropdown = ! open_dropdown" class="dropdown-toggle">
                 Searching <i class="fa fa-search-plus"></i>
            </a>
            <div class="dropdown-menu show-form-filter" x-show="open_dropdown">
                <form class="p-2">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Searching..." />
                    </div>
                    <div class="form-group">
                        <select class="form-control" wire:model="tahun">
                            <option value=""> --- Year --- </option>
                            @foreach(\App\Models\ToolsCheck::groupBy('tahun')->get() as $y)
                                <option>{{$y->tahun}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" wire:model="bulan">
                            <option value=""> --- Month --- </option>
                            @foreach(\App\Models\ToolsCheck::groupBy('bulan')->get() as $m)
                                <option>{{$m->bulan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" wire:ignore>
                        <select class="form-control" wire:model="region_id" wire:change="$set('sub_region_id',null)">
                            <option value=""> -- Select Region -- </option>
                            @foreach($region as $item)
                                <option value="{{$item->id}}">{{$item->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" wire:model="sub_region_id">
                            <option value=""> -- Select Sub Region -- </option>
                            @foreach($sub_region as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" wire:ignore>
                        <select class="form-control" wire:model="user_access_id">
                            <option value="">-- Job Role/Access --</option>
                            @foreach(\App\Models\UserAccess::where('is_project',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <a href="javascript:void(0)" wire:click="clear_filter()"><small>Clear filter</small></a>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <a href="javascript:void(0)" class="btn btn-info" wire:click="downloadExcel"><i class="fa fa-download"></i> Download</a>
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
                    <th>Region</th> 
                    <th>Sub Region</th> 
                    <th>NIK</th> 
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
                        <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                        <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                        <td>{{isset($item->_employee->nik) ? $item->_employee->nik : ''}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->tahun}}</td>
                        <td>{{$item->bulan}}</td>
                        @if(isset($item->toolsboxCheck))
                            @foreach($toolboxs as $tool)
                                @php($upload = $item->toolsboxCheck->where('toolbox_id',$tool->id)->first())
                                <td>
                                    @if($upload)
                                        @if($upload->status==1) <span class="text-success" title="Kondisi Baik, QTY : {{$upload->qty}}"><i class="fa fa-check"></i> {{$upload->qty}}</span> @endif
                                        @if($upload->status==2) <span class="text-danger" title="Kondisi Rusak QTY : {{$upload->qty}}, Note: {{$upload->note}}"><i class="fa fa-warning"></i> {{$upload->qty}}</span> @endif 
                                        @if($upload->image)
                                            <a href="{{asset($upload->image)}}" target="_blank"><i class="fa fa-image"></i></a>
                                        @else
                                            -
                                        @endif
                                    @endif
                                </td>
                            @endforeach
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table><br />
        {{$data->links()}}
    </div>
</div>
