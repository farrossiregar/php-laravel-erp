<div>
    <div class="header px-0 row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="{{ __('Searching...') }}" />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="employee_id">
                <option value=""> --- {{ __('Employee') }} --- </option>
                @foreach(\App\Models\Employee::whereNotNull('user_id')->groupBy('name')->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="region">
                <option value=""> --- {{ __('Region') }} --- </option>
                @foreach(\App\Models\CustomerAssetManagement::whereNotNull('region_name')->groupBy('region_name')->get() as $item)
                <option>{{$item->region_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="created_at" placeholder="Date Uploaded" title="Date Uploaded" />
        </div>
        <div class="col-md-4">
            <a href="javascript:;" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> {{ __('Upload') }}</a>
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
                        <th>{{ __('UPLOADED') }}</th>                                  
                        <th>{{ __('DATE SUBMISSION') }}</th>                                    
                        <th>{{ __('NIK / NAMA') }}</th>                             
                        <th>{{ __('TOWER INDEX') }}</th>
                        <th>{{ __('SITE ID') }}</th>
                        <th>{{ __('SITE NAME') }}</th>
                        <th>{{ __('SITE OWNER') }}</th>
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
                        <td><a href="{{route('customer-asset-management.history',['data'=>$item->id])}}">{{ $item->tanggal_submission?date('d-M-Y',strtotime($item->tanggal_submission)):''}}</a></td> 
                        <td>
                            @if(isset($item->site->employee->name))
                                {{$item->site->employee->name}}
                            @endif
                        </td> 
                        <td>{{isset($item->tower->name)?$item->tower->name : ''}}</td> 
                        <td>{!!isset($item->site_code)?"<a href=\"". route('sites.edit',$item->site_id)."\">{$item->site_code}</a>" : ''!!}</td> 
                        <td>{{isset($item->site_name)?$item->site_name : ''}}</td> 
                        <td>{{isset($item->site_owner)?$item->site_owner : ''}}</td>
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
                            @if($item->photo_kondisition)
                                <a href="{{asset($item->photo_kondisition)}}"><i class="fa fa-image"></i></a>
                            @endif
                        </td>
                        <td>{{$item->catatan}}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
