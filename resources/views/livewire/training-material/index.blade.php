@section('title', __('Training Material'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="py-2 px-2">
                        <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" wire:model="employee_id">
                            <option value=""> --- Employee --- </option>
                            @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control date_created" placeholder="Date" />
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal_add_training"><i class="fa fa-plus"></i> Training Material</a>
                        <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#modal_group_training"><i class="fa fa-list"></i> Group Training</a>
                    </div>
                    <div class="col-md-5">
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
                                <th>Group</th>                                    
                                <th>Training</th>   
                                <th>Description</th>          
                                <th>File</th>   
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>
                                        @if(isset($item->group->name))
                                            <a href="javascript:;" title="
                                            @if(isset($item->group->employee))
                                                @foreach($item->group->employee as $em)
                                                    @if(isset($em->employee->name)){{$em->employee->name}}, @endif
                                                @endforeach
                                            @endif
                                            ">{{$item->group->name}}</a>
                                        @endif
                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td style="white-space: break-spaces !important;">{{$item->description}}</td>
                                    <td>
                                        @foreach(\App\Models\TrainingMaterialFile::where('training_material_id',$item->id)->get() as $file)
                                            <a href="{{asset($file->file)}}" target="_blank">{{$file->name}}</a><br />
                                        @endforeach
                                    </td>
                                    <td>
                                        @if(\App\Models\TrainingExam::where('training_material_id',$item->id)->count() > 0)
                                            <a href="{{ route('training-material.detail-exam',$item->id) }}" class="badge badge-success" title="Result Exam"><i class="fa fa-table"></i> Result</a>
                                        @else
                                            <a href="{{ route('mobile-apps.insert-exam',$item->id) }}" class="badge badge-info" title="Create Exam"><i class="fa fa-plus"></i> Exam</a>
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

                <div wire:ignore.self class="modal fade" id="modal_group_training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        @livewire('training-material.group')
                    </div>
                </div>
                
                <div wire:ignore.self class="modal fade" id="modal_add_training" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form wire:submit.prevent="store" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Training Material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Group Training</label>
                                        <select class="form-control" wire:model="training_material_group_id">
                                            <option value=""> -- Select -- </option>
                                            @foreach($group_training as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('training_material_group_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name Training</label>
                                        <input type="text" class="form-control" wire:model="name" />
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" wire:model="description"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Materi(pdf,docs)</label>
                                        <input type="file" wire:model="file" multiple />
                                        @error('file.*')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                        <span class="sr-only">{{ __('Loading...') }}</span>
                                    </span>
                                    <button type="button" class="btn btn-light close-btn" data-dismiss="modal">Cancel</button>
                                    <button wire:loading.remove type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @push('after-scripts')
                <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
                <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
                <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
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
                @endpush
            </div>
        </div>
    </div>
</div>