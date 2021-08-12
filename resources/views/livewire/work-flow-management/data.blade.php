<div class="card">
    <div class="header row">
        <div class="col-md-1 pr-0">
            <select class="form-control" wire:model="perpage">
                <option value="100">-- limit -- </option>
                <option>200</option>
                <option>300</option>
                <option>400</option>
                <option>500</option>
                <option>600</option>
                <option>700</option>
                <option>800</option>
                <option>900</option>
                <option>1000</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" wire:model="keyword" placeholder="{{ __('Searching...') }}" />
        </div>
        <div class="col-md-2 px-0">
            <select class="form-control" wire:model="region">
                <option value=""> --- {{ __('Region') }} --- </option>
                @foreach(\App\Models\WorkFlowManagement::groupBy('region')->get() as $item)
                <option>{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="created_at" placeholder="Date Uploaded" onfocus="(this.type='date')" />
        </div>
        <div class="col-md-1 px-0">
            @if(check_access('work-flow-management.upload'))
            <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> {{ __('Upload') }}</a>
            @endif
        </div>
    </div>
    <div class="body pt-0">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>{{ __('NO') }}</th>
                        <th>{{ __('UPLOADED') }}</th>                                    
                        <th>{{ __('DATE') }}</th>                                    
                        <th>{{ __('NAME') }}</th>                                    
                        <th>{{ __('ID') }}</th>                                    
                        <th>{{ __('SERVICEAREA4') }}</th>
                        <th>{{ __('CITY') }}</th>
                        <th>{{ __('SERVICEAREA2') }}</th>
                        <th>{{ __('REGION') }}</th>
                        <th>{{ __('ASP') }}</th>
                        <th>{{ __('REGION_&_ASP_INFO') }}</th>
                        <th>{{ __('SKILLS') }}</th>
                        <th>{{ __('WO ASSIGN') }}</th>
                        <th>{{ __('WO ACCEPT') }}</th>
                        <th>{{ __('WO_CLOSE_MANUAL') }}</th>
                        <th>{{ __('WO_CLOSE_AUTO') }}</th>
                        <th>{{ __('MTTR') }}</th>
                        <th>{{ __('REMARK_WO_ASSIGN') }}</th>
                        <th>{{ __('REMARK_WO_ACCEPT') }}</th>
                        <th>{{ __('REMARK_WO_CLOSE MANUAL') }}</th>
                        <th>{{ __('FINAL REMARK') }}</th>
                        <th>{{ __('THRESHOLD') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                    <tr>
                        <td style="width: 50px;">{{$k+1}}</td>
                        <td>{{date('d M Y',strtotime($item->created_at))}}</td> 
                        <td>{{$item->date}}</td> 
                        <td>{{$item->name}}</td> 
                        <td>{{$item->id_}}</td> 
                        <td>{{$item->servicearea4}}</td> 
                        <td>{{$item->city}}</td> 
                        <td>{{$item->servicearea2}}</td> 
                        <td>{{$item->region}}</td> 
                        <td>{{$item->asp}}</td> 
                        <td>{{$item->region_dan_asp_info}}</td> 
                        <td>{{$item->skills}}</td> 
                        <td>{{$item->wo_assign}}</td> 
                        <td>{{$item->wo_accept}}</td> 
                        <td>{{$item->wo_close_manual}}</td> 
                        <td>{{$item->wo_close_auto}}</td> 
                        <td>{{$item->mttr}}</td> 
                        <td>{{$item->remark_wo_assign}}</td> 
                        <td>{{$item->remark_wo_accept}}</td> 
                        <td>{{$item->remark_wo_close_manual}}</td> 
                        <td>{{$item->final_remark}}</td>
                        <td>{{$item->threshold}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:work-flow-management.upload />
        </div>
    </div>
</div>