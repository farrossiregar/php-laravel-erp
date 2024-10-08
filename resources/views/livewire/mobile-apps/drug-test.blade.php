<div>
    <div class=" row">
        <div class="col-md-2">
            <input type="text" class="form-control" />
        </div>
        <div class="col-md-1 form-group">
            <input type="text" class="form-control date_created" placeholder="Date" />
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" wire:model="region_id" wire:change="$set('sub_region_id',null)">
                <option value=""> -- Select Region -- </option>
                @foreach($region as $item)
                    <option value="{{$item->id}}">{{$item->region}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="sub_region_id">
                <option value=""> -- Select Sub Region -- </option>
                @foreach($sub_region as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal_add_drug_test"><i class="fa fa-plus"></i> Drug Test</a>
        </div>
        <div class="col-md-1">
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
                    <th style="width:50px;">No</th>         
                    <th>Employee</th>   
                    <th>Title</th>   
                    <th>Remark</th>   
                    <th class="text-center">Status</th>
                    <th class="text-center">File</th>
                    <th>Date Submited</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
                        <td>{{isset($item->title) ? $item->title : ''}}</td>
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
    <br />
    {{$data->links()}}
    <div wire:ignore.self class="modal fade" id="modal_add_drug_test" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        {{-- <div class="form-group">
                            <label>Head</label>
                            <select class="form-control" wire:model="employee_pic_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" wire:model="title" />
                        </div>
                        <div class="form-group">
                            <label>Remark</label>
                            <textarea class="form-control mt-2" wire:model="remark" placeholder="Remark"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Employee</label>
                            <select class="form-control" wire:model="employee_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" wire:click="positif"><i class="fa fa-minus"></i> Negatif</button>
                        <button type="button" class="btn btn-danger" wire:click="negatif"><i class="fa fa-plus"></i> Positif</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
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
</div>
