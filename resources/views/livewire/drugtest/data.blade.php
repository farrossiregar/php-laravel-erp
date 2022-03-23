<div class="card">
    <div class="row pt-3 pl-3">
        <div class="col-md-2">
            <select class="form-control employee_id" wire:model="filter_employee_id">
                <option value=""> --- Employee --- </option>
                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1 form-group">
            <input type="text" class="form-control date_created" placeholder="Date" />
        </div>
        <div class="col-md-1" wire:ignore>
            <select class="form-control" wire:model="region_id" wire:change="$set('sub_region_id',null)">
                <option value=""> -- Region -- </option>
                @foreach($region as $item)
                    <option value="{{$item->id}}">{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-control" wire:model="sub_region_id">
                <option value=""> -- Sub Region -- </option>
                @foreach($sub_region as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-control" wire:model="filter_tahun">
                <option value=""> -- Tahun -- </option>
                @foreach(\App\Models\DrugTest::groupBy('tahun')->get() as $item)
                    <option>{{$item->tahun}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <select class="form-control" wire:model="filter_batch">
                <option value=""> -- Batch -- </option>
                <option>1</option>
                <option>2</option>
            </select>
        </div>
        <div class="col-md-4">
            @if(check_access('drug-test.insert'))
                <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal_add_drug_test"><i class="fa fa-plus"></i> Drug Test</a>
            @endif
            @if(check_access('drug-test.download'))
                <a href="javascript:void(0)" wire:click="downloadExcel" class="btn btn-success"><i class="fa fa-download"></i> Download</a>
            @endif
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body">
        <div class="table-responsive">
            <table class="table table-hover m-b-0 c_list">
                <thead>
                    <tr style="background:#eee;">
                        <th style="width:50px;">No</th>         
                        <th>Region</th>   
                        <th>Sub Region</th>   
                        <th>Employee</th>   
                        <th>Tahun</th>
                        <th class="text-center">Batch</th>
                        <th>Remark</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">File</th>
                        <th>Date Submited</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $item)
                        @if(!isset($item->employee->name)) @continue @endif
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{isset($item->employee->region->region) ? $item->employee->region->region : ''}}</td>
                            <td>{{isset($item->employee->sub_region->name) ? $item->employee->sub_region->name : ''}}</td>
                            <td>
                                <!-- <a href="javascript:void(0)" class="text-danger" wire:click="delete({{$item->id}})"><i class="fa fa-trash"></i></a> -->
                                {{isset($item->employee->name) ? $item->employee->name : ''}}
                            </td>
                            <td>{{$item->tahun}}</td>
                            <td class="text-center">{{$item->batch}}</td>
                            <td>{{isset($item->remark) ? $item->remark : ''}}</td>
                            <td class="text-center">
                                @if($item->status_drug==0)
                                    <span class="badge badge-warning">Not Submited</span>
                                @endif
                                @if($item->status_drug==1)
                                    <span class="badge badge-danger">Positif</span>
                                @endif
                                @if($item->status_drug==2)
                                    <span class="badge badge-success">Negatif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @foreach(\App\Models\DrugTestUpload::where('drug_test_id',$item->id)->get() as $img)
                                    <a href="{{ $img->image }}" target="_blank"><i class="fa fa-file"></i></a>
                                @endforeach
                                @if($is_edit_image)
                                    <a href="javascript:void(0)" class="ml-2 text-danger" wire:click="set_id({{$item->id}})" data-toggle="modal" data-target="#modal_edit_uploaded"><i class="fa fa-edit"></i></a>
                                @endif
                            </td>
                            <td>
                                @if($item->date_submited)
                                    {{date('d-M-Y',strtotime($item->date_submited))}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if($data->count() ==0)
                    <tr>
                        <td colspan="5" class="text-center"><i>empty</i></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        {{$data->links()}}
    </div>
</div>