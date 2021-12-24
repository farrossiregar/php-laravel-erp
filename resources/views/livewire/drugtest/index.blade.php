@section('title', __('Drug Test'))
@section('title', __('Training Material'))
<div class="row clearfix">
    <div class="col-lg-12">
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
    </div>

    <div wire:ignore.self class="modal fade" id="modal_edit_uploaded" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update_edit_uploaded">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:loading.remove class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modal_add_drug_test" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store_employee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Drug Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun</label>
                            <span>{{date('Y')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="mr-2">
                                <input type="radio" value="1" wire:model="batch" /> Batch 1
                            </label>
                            <label>
                                <input type="radio" value="2" wire:model="batch" /> Batch 2
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Remark</label>
                            <textarea class="form-control mt-2" wire:model="remark" placeholder="Remark"></textarea>
                        </div>
                        <div class="form-group" wire:ignore>
                            <label>Employee</label>
                            <select class="form-control insert_employee_id" wire:model="employee_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('employee_id')
                            <span class="text-danger mb-2">{{ $message }}</span>
                        @enderror
                        <div class="form-group mt-2">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading.remove>
                            <button type="button" class="btn btn-success" wire:click="positif"><i class="fa fa-minus"></i> Negatif</button>
                            <button type="button" class="btn btn-danger" wire:click="negatif"><i class="fa fa-plus"></i> Positif</button>
                        </div>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
        <script>
            $('.employee_id').select2();
            $('.employee_id').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('filter_employee_id',data.id)
            });
            $('.insert_employee_id').select2();
            $('.insert_employee_id').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('employee_id',data.id)
            });
            $('.date_created').daterangepicker({
                opens: 'left',
                locale: {
                    cancelLabel: 'Clear'
                },
                autoUpdateInput: false,
            }, function(start, end, label) {
                @this.set("date_start", start.format('YYYY-MM-DD'));
                @this.set("date_end", end.format('YYYY-MM-DD'));
                $('.date_created').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
            });
            Livewire.on('refresh-page',()=>{
                $(".modal").modal("hide");
            });
        </script>
    @endpush
</div>