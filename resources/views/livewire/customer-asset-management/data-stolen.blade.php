<div>
    <div class="header px-0 row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="{{ __('Searching...') }}" />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="employee_id">
                <option value=""> --- {{ __('Employee') }} --- </option>
                @foreach(\App\Models\CustomerAssetManagementHistory::groupBy('employee_id')->whereNotNull('employee_id')->get() as $item)
                    @if(isset($item->employee->name))
                        <option value="{{$item->employee_id}}">{{$item->employee->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="region">
                <option value=""> --- {{ __('Region') }} --- </option>
                @foreach(\App\Models\CustomerAssetManagementHistory::whereNotNull('region_name')->groupBy('region_name')->get() as $item)
                <option value="{{$item->region_name}}">{{$item->region_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="created_at" title="Date Submited" />
        </div>
        <div class="col-md-4">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <div class="body px-0 pt-0">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead style="white-space: nowrap;">
                    <tr>
                        <th>{{ __('NO') }}</th>                     
                        <th>{{ __('DATE SUBMISSION') }}</th>                                    
                        <th>{{ __('NIK / NAMA') }}</th>                             
                        <th>{{ __('TOWER INDEX') }}</th>
                        <th>{{ __('SITE ID') }}</th>
                        <th>{{ __('SITE NAME') }}</th>
                        <th>{{ __('CLUSTER') }}</th>
                        <th>{{ __('REGION') }}</th>
                        <th>{{ __('RECTIFIER 1 QTY MODULE') }}</th>
                        <th>{{ __('RECTIFIER 1 BATTERY BRAND') }}</th>
                        <th>{{ __('RECTIFIER 1 BATTERY QTY (PCS)') }}</th>
                        <th>{{ __('RECTIFIER 2 QTY MODULE') }}</th>
                        <th>{{ __('RECTIFIER 2 BATTERY BRAND') }}</th>
                        <th>{{ __('RECTIFIER 2 BATTERY QTY (PCS)') }}</th>
                        <th>{{ __('RECTIFIER 3 QTY MODULE') }}</th>
                        <th>{{ __('RECTIFIER 3 BATTERY BRAND') }}</th>
                        <th>{{ __('RECTIFIER 3 BATTERY QTY (PCS)') }}</th>
                        <th>{{ __('PHOTO') }}</th>
                        <th>{{ __('CATATAN') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                    <tr>
                        <td style="width: 50px;">{{$data->firstItem() + $k}}</td>
                        <td>{{date('d M Y',strtotime($item->created_at))}}</td> 
                        <td>
                            @if(isset($item->employee->name))
                                {{$item->employee->name}}
                            @endif
                        </td> 
                        <td>{{isset($item->tower->name)?$item->tower->name : ''}}</td> 
                        <td>{!!isset($item->site_code)?"<a href=\"". route('sites.edit',$item->site_id)."\">{$item->site_code}</a>" : ''!!}</td> 
                        <td>{{isset($item->site_name)?$item->site_name : ''}}</td> 
                        <td>{{isset($item->cluster->name)?$item->cluster->name : ''}}</td> 
                        <td>{{isset($item->region->region)?$item->region->region : ''}}</td>
                        <td>{{$item->qty_module_1}}</td>
                        <td>{{$item->battery_brand_1}}</td>
                        <td>{{$item->battery_qty_1}}</td>
                        <td>{{$item->qty_module_2}}</td>
                        <td>{{$item->battery_brand_2}}</td>
                        <td>{{$item->battery_qty_2}}</td>
                        <td>{{$item->qty_module_3}}</td>
                        <td>{{$item->battery_brand_3}}</td>
                        <td>{{$item->battery_qty_3}}</td>
                        <td>
                            @if($item->photo_kondition)
                                <a href="{{asset($item->photo_kondition)}}"><i class="fa fa-image"></i></a>
                            @endif
                        </td>
                        <td>{{$item->catatan}}</td>
                        <td>
                        
                            @if($item->site_owner == 'TLP')
                                @if($item->status==1)
                                    @if(check_access('customer-asset-management.asset-stolen-open-tt-tlp'))
                                        @livewire('customer-asset-management.status-stolen-tlp',['data'=>$item->id],key($item->id+$item->status+1))
                                    @else
                                        <a href="javascript:;" class="badge badge-danger"><i class="fa fa-warning"></i> Not Verify</a>
                                    @endif
                                @endif
                                @if($item->status==3)
                                    <a href="javascript:;" class="badge badge-success"><i class="fa fa-check"></i> Verify</a>
                                @endif
                            @endif
                            @if($item->site_owner == 'TMG')
                                @if($item->status==1)
                                    @if(check_access('customer-asset-management.asset-stolen-verify-and-acknowldge-tmg'))
                                        @livewire('customer-asset-management.status-stolen-tmg',['data'=>$item->id],key($item->id+$item->status+2))
                                    @else
                                        <a href="javascript:;" class="badge badge-danger"><i class="fa fa-warning"></i> Not Verify</a>
                                    @endif
                                @endif
                                @if($item->status==2)
                                    @if(check_access('customer-asset-management.stolen-submit-email-boq'))
                                        @livewire('customer-asset-management.status-stolen-boq-tmg',['data'=>$item->id],key($item->id+$item->status+3))
                                    @else
                                        <span class="badge badge-warning"><i class="fa fa-times"></i> Not Uploaded</span>
                                    @endif
                                @endif
                                @if($item->status==3)
                                    <a href="{{asset("storage/customer-asset/boq/{$item->file_boq}")}}" target="_blank" class="badge badge-success"><i class="fa fa-download"></i> Uploaded</a>
                                @endif
                            @endif
                            
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
