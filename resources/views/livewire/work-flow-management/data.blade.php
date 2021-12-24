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
                        <th>{{ __('PROBLEM')}} ({{$count}})</th>
                        <th>{{ __('THRESHOLD') }}</th>
                        <th>{{ __('PIKUP DATE') }}</th>
                        <th>{{ __('RESOLVE DATE') }}</th>
                        <th>{{ __('STATUS') }}</th>
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
                        <td>
                            @if(!isset($item->employee->name))
                                <a href="javascript:void(0)" wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_change_pic" title="Change PIC"><i><i class="fa fa-edit"></i> Not set</i></a>
                            @else
                                {{isset($item->employee->name) ? $item->employee->name : '' }}
                            @endif
                        </td>
                        <td>{{$item->problem}}</td>
                        <td class="text-center">{{$item->threshold}}</td>
                        <td>{{$item->pickup_date ? date('d M Y',strtotime($item->pickup_date)) : '-'}}</td> 
                        <td>{{$item->resolve_date ? date('d M Y',strtotime($item->resolve_date)) : '-'}}</td> 
                        <td>
                            @if($item->status==0)
                                <span class="badge badge-warning">Waiting Pickup</span>
                            @endif
                            @if($item->status==1)
                                <span class="badge badge-info">Pickup</span>
                            @endif
                            @if($item->status==2)
                                <span class="badge badge-success">Resolved</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
    </div>

    <div wire:ignore.self class="modal fade" id="modal_change_pic" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="submit_change_pic">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Change PIC</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" wire:ignore>
                            <select class="form-control select2">
                                <option value=""> -- Select Employee --- </option>
                                @foreach($employees as $item)
                                    <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('change_pic_id')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Please wait...') }}</span> Please wait...
                        </span>
                        <button type="submit" wire:loading.remove wire:target="change_pic_id" class="btn btn-success"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
        <script>
            Livewire.on('refresh-page',()=>{
                $("#modal_upload").modal("hide");
                $("#modal_change_pic").modal("hide");
            });
            $(document).ready(function() {    
                $(".select2").select2();
                $('.select2').on('select2:select', function (e) {
                    var data = e.params.data;
                    @this.set('employee_id',data.id);
                });
            });
        </script>
    @endpush

</div>
<!-- Modal -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:work-flow-management.upload />
        </div>
    </div>
</div>