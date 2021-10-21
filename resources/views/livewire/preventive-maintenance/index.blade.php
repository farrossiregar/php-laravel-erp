
@section('title', 'Preventive Maintenance')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class="row">
                    <div class="col-md-2">
                        <input type="text" class="form-control" wire:model="keyword" />
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control date_created" placeholder="Date" />
                    </div>
                    <div class="col-md-3">
                        <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#modal_add_preventive_maintenance"><i class="fa fa-plus"></i> Preventive Maintenance</a>
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
                                <th>Site ID</th>
                                <th>Site Name</th>   
                                <th>Task Description</th>   
                                <th>Site Category</th>   
                                <th>Site Type</th>   
                                <th>PM Type</th>
                                <th>Region</th>
                                <th>Sub Region</th>
                                <th>Cluster</th>
                                <th>Sub Cluster</th>
                                <th>NIK Karyawan</th>
                                <th>Nama Karyawan</th>
                                <th>Admin Project</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$item->site_id}}</td>
                                    <td>{{$item->site_name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->site_category}}</td>
                                    <td>{{$item->site_type}}</td>
                                    <td>{{$item->pm_type}}</td>
                                    <td>{{isset($item->region->region) ? $item->region->region : ''}}</td>
                                    <td>{{isset($item->sub_region->name) ? $item->sub_region->name : ''}}</td>
                                    <td>{{ $item->cluster }}</td>
                                    <td>{{ $item->sub_cluster }}</td>
                                    <td>{{ isset($item->employee->nik) ? $item->employee->nik : '' }}</td>
                                    <td>{{ isset($item->employee->name) ? $item->employee->name : '' }}</td>
                                    <td>{{ isset($item->admin->nama) ? $item->admin->nama : '' }}</td>
                                    <td>
                                        @if($item->status==0)
                                            <span class="badge badge-info">Open</span>
                                        @endif
                                        @if($item->status==1)
                                            <span class="badge badge-warning">Onprogress</span>
                                        @endif
                                        @if($item->status==2)
                                            <span class="badge badge-success">Submited</span>
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
                <div wire:ignore.self class="modal fade" id="modal_add_preventive_maintenance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form wire:submit.prevent="store">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Preventive Maintenance</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true close-btn">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label>Site ID</label>
                                            <input type="text" class="form-control" wire:model="site_id" />
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Site Name</label>
                                            <input type="text" class="form-control" wire:model="site_name" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Task Description</label>
                                        <textarea class="form-control" wire:model="description"></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Site Category</label>
                                            <input type="text" class="form-control" wire:model="site_category" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Site Type</label>
                                            <select class="form-control" wire:model="site_type">
                                                <option value="">-- Select --</option>
                                                <option>TLP</option>
                                                <option>TMG</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>PM Type</label>
                                            <select class="form-control" wire:model="pm_type">
                                                <option value="">-- Select --</option>
                                                @if($site_type=='TLP')
                                                    <option>3M</option>
                                                    <option>6M</option>
                                                @endif
                                                @if($site_type=='TMG')
                                                    <option>1M</option>
                                                    <option>3M</option>
                                                    <option>6M</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Region</label>
                                            <select class="form-control" wire:model="region_id">
                                                <option value="">-- Select --</option>
                                                @foreach($regions as $item)
                                                    <option value="{{$item->id}}">{{$item->region}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Sub Region</label>
                                            <select class="form-control" wire:model="sub_region_id">
                                                <option value="">-- Select --</option>
                                                @foreach($sub_regions as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Cluster</label>
                                            <input type="text" class="form-control" wire:model="cluster" />
                                        </div>    
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Sub Cluster</label>
                                            <input type="text" class="form-control" wire:model="sub_cluster" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Employee (TE Only)</label>
                                            <select class="form-control" wire:model="employee_id">
                                                <option value="">-- Select --</option>
                                                @foreach($employees as $item)
                                                    <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <span wire:loading>
                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                        <span class="sr-only">{{ __('Loading...') }}</span>
                                    </span>
                                    <button type="button" class="btn btn-light close-btn" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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
