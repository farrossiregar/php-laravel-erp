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
        <!-- <div class="col-md-4">
            <a href="javascript:;" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> {{ __('Upload') }}</a>
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div> -->
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
                            <td>
                                @if(isset($item->employee->name))
                                    {{$item->employee->name}}
                                @endif
                            </td> 
                            <td>{{isset($item->tower->name)?$item->tower->name : ''}}</td> 
                            <td>{!!isset($item->site_code)?$item->site_code: ''!!}</td> 
                            <td>{{isset($item->site_name)?$item->site_name : ''}}</td> 
                            <td>{{isset($item->site_owner)?$item->site_owner : ''}}</td>
                            <td>{{isset($item->cluster->name)?$item->cluster->name : ''}}</td> 
                            <td>{{isset($item->region_name)?$item->region_name : ''}}</td>
                            <td>{{$item->qty_module_1?$item->qty_module_1:'-'}}</td>
                            <td>{{$item->battery_brand_1?$item->battery_brand_1:'-'}}</td>
                            <td>{{$item->battery_qty_1?$item->battery_qty_1:'-'}}</td>
                            <td>{{$item->qty_module_2?$item->qty_module_2:'-'}}</td>
                            <td>{{$item->battery_brand_2?$item->battery_brand_2:'-'}}</td>
                            <td>{{$item->battery_qty_2?$item->battery_qty_2:'-'}}</td>
                            <td>{{$item->qty_module_3?$item->qty_module_3:'-'}}</td>
                            <td>{{$item->battery_brand_3?$item->battery_brand_3:'-'}}</td>
                            <td>{{$item->battery_qty_3?$item->battery_qty_3:'-'}}</td>
                            <td>
                                @if($item->photo_kondition)
                                    <a href="{{asset($item->photo_kondition)}}"><i class="fa fa-image"></i></a>
                                @endif
                                @if($item->images)
                                    @foreach($item->images as $img)
                                        <a href="{{asset($img->file)}}" target="_blank"><i class="fa fa-image"></i></a>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{$item->catatan}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
