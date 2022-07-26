<form wire:submit.prevent="save">
    <div class="modal-header row">
        <div class="col-md-2">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-database"></i> Budget</h5>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="filter_month">
                <option value=""> -- Periode -- </option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
        </div>
        <div class="col-md-2">
            <span wire:loading wire:target="filter_month">
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
        <div class="col-md-6">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true close-btn">×</span>
            </button>
        </div>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <table class="table">
                <thead style="background:#eee;">
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>PIC (Admin Region)</th>
                        <th>Work Location</th>
                        <td><strong>Week 1</strong><br />
                            <a href="javascript:void(0)" wire:click="$emit('week_active',{'week':1,'month':{{$filter_month}}})" data-toggle="modal" data-target="#modal_set_date"><i class="fa fa-edit"></i></a>
                            {{$week_1}}
                        </td>
                        <td><strong>Week 2</strong><br />
                            <a href="javascript:void(0)" wire:click="$emit('week_active',{'week':2,'month':{{$filter_month}}})" data-toggle="modal" data-target="#modal_set_date"><i class="fa fa-edit"></i></a>
                            {{$week_2}}
                        </td>
                        <td><strong>Week 3</strong><br />
                            <a href="javascript:void(0)" wire:click="$emit('week_active',{'week':3,'month':{{$filter_month}}})" data-toggle="modal" data-target="#modal_set_date"><i class="fa fa-edit"></i></a>
                            {{$week_3}}
                        </td>
                        <td><strong>Week 4</strong><br />
                            <a href="javascript:void(0)" wire:click="$emit('week_active',{'week':4,'month':{{$filter_month}}})" data-toggle="modal" data-target="#modal_set_date"><i class="fa fa-edit"></i></a>
                            {{$week_4}}
                        </td>
                        <td><strong>Week 5</strong><br />
                            <a href="javascript:void(0)" wire:click="$emit('week_active',{'week':5,'month':{{$filter_month}}})" data-toggle="modal" data-target="#modal_set_date"><i class="fa fa-edit"></i></a>
                            {{$week_5}}
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k =>  $item)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{isset($item->client_project->name) ? $item->client_project->name : '-'}}</td>
                            <td>{{isset($item->regions->region) ? $item->regions->region : '-'}}</td>
                            <td>@livewire('finance.weekly-opex-editable-pic',['data'=>$item,'field'=>'employee_id'],key('employee_id'.$item->id))</td>
                            <td>@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'work_location'],key('work_location_'.$item->id))</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'week_1'],key('week_1'.$item->id))</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'week_2'],key('week_2'.$item->id))</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'week_3'],key('week_3'.$item->id))</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'week_4'],key('week_4'.$item->id))</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'week_5'],key('week_5'.$item->id))</td>
                        </tr>
                    @endforeach
                    @if($insert)
                        <tr>
                            <td></td>
                            <td>
                                <select class="form-control" wire:model="project_id">
                                    <option value=""> -- Select Project -- </option>
                                    @foreach(\App\Models\ClientProject::orderBy('name','ASC')->where('is_project',1)->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="region">
                                    <option value=""> -- Select Region -- </option>
                                    @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->region}}</option>
                                    @endforeach
                                </select>
                                @error('regio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="subregion">
                                    <option value=""> -- Select Subregion -- </option>
                                    @if($region)
                                        @foreach(\App\Models\SubRegion::where('region_id',$region)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('project_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="week">
                                    <option value=""> -- Select Week -- </option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                                @error('week')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control text-right" wire:model="budget" placeholder="Budget" />
                                @error('budget')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>                            
                        </tr>
                        <tr>
                            <td colspan="5">
                                <button wire:loading.remove wire:target="save" type="submit" class="badge badge-info badge-active"><i class="fa fa-save"></i> Save</button>
                                <a href="javascript:void(0)" wire:loading.remove wire:target="save" wire:click="$set('insert',false)" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Cancel</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if($insert==false)
                <!-- <a href="javascript:void(0)" wire:click="$set('insert',true)" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Budget</a> -->
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>