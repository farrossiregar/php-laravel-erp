<div>
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
        <div class="col-md-2 px-0">
            <select class="form-control" wire:model="problem">
                <option value=""> --- {{ __('Problem') }} --- </option>
                <option>FT not resolve WO</option>
                <option>FT not assigned WO</option>
            </select>
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
                        <th>{{ __('REGION') }}</th>
                        <th>{{ __('AREA') }}</th>
                        <th>{{ __('CLUSTER') }}</th>
                        <th>{{ __('SIGNUM')}}</th>
                        <th>{{ __('FT NAME')}}</th>
                        <th>{{ __('PROBLEM')}}</th>
                        <th>{{ __('THRESHOLD') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                    <tr>
                        <td style="width: 50px;">{{$k+1}}</td>
                        <td>{{date('d M Y',strtotime($item->created_at))}}</td> 
                        <td>{{$item->date}}</td> 
                        <td>{{$item->region}}</td> 
                        <td>{{$item->servicearea4}}</td> 
                        <td>{{isset($item->cluster->name) ? $item->cluster->name : '' }}</td> 
                        <td>{{isset($item->employee->employee_code) ? $item->employee->employee_code : '' }}</td> 
                        <td>{{isset($item->employee->name) ? $item->employee->name : '' }}</td> 
                        <td>{{$item->problem}}</td>
                        <td class="text-center">{{$item->threshold}}</td>
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