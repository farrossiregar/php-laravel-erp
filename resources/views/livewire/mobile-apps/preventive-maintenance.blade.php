<div>
    <div class=" row">
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
                    <th>Description</th>   
                    <th>Site ID / Name</th>   
                    <th>Site Owner</th>   
                    <th>Region</th>   
                    <th>Due Date</th>   
                    <th>Status</th>
                    <!-- <th>File</th>
                    <th>Start Submit</th>
                    <th>End Submit</th> -->
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{isset($item->site->name) ? $item->site->site_id .' / '.$item->site->name : ''}}</td>
                        <td>{{isset($item->site->site_owner) ? $item->site->site_owner : ''}}</td>
                        <td>{{isset($item->site->region->region) ? $item->site->region->region : ''}}</td>
                        <td>{{date('d F Y',strtotime($item->due_date))}}</td>
                        <td></td>
                        <td>
                            @if($item->site->site_owner)
                                <a href="javascript:;" wire:click="set_report({{$item->id}},'{{$item->site->site_owner}}')" class="badge badge-success" data-toggle="modal" data-target="#modal_download_report"><i class="fa fa-download"></i> Report</a>
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

    <div wire:ignore.self class="modal fade" id="modal_download_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-download"></i> Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if(isset($site_report))
                            @if($site_owner=='TMG')
                                <p><h6>PM Monthly</h6>
                                    <ul>
                                        <li><a href="{{route('pm-report-tmg-monthly',$site_report->id)}}" target="_blank"><i class="fa fa-download"></i> PM Report TMG Monthly</a></li>
                                    </ul>
                                </p>
                                <p>
                                    <h6>PM Quarterly</h6>
                                    <ul>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG Quarterly</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Checklist & DG)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Electricity)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Rectifier)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (PMS) - Selected sites only</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG (Solar Panel) - Selected sites only</a></li>
                                    </ul>
                                </p>
                                <p>
                                    <h6>PM Half Year</h6>
                                    <ul>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG Half Year</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Checklist & DG)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Electricity)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (Rectifier)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG RAN (PMS) - Selected sites only</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TMG (Solar Panel) - Selected sites only</a></li>
                                    </ul>
                                </p>
                            @endif

                            @if($site_owner=='TLP')
                                <p>
                                    <h6>PM Quarterly</h6>
                                    <ul>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Checklist & DG)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Electricity)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Rectifier)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (PMS) - Selected sites only</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP (Solar Panel) - Selected sites only</a></li>
                                    </ul>
                                </p>
                                <p>
                                    <h6>PM Half Year</h6>
                                    <ul>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Checklist & DG)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Electricity)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (Rectifier)</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP RAN (PMS) - Selected sites only</a></li>
                                        <li><a href=""><i class="fa fa-download"></i> PM Report TLP (Solar Panel) - Selected sites only</a></li>
                                    </ul>
                                </p>
                            @endif
                        @endif
                    </div>
                </form>
            </div>
        </div>
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
                        <div class="form-group">
                            <label>Site ID / Site Name</label>
                            <select class="form-control" wire:model="site_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Site::orderBy('name','ASC')->limit(100)->get() as $item)
                                <option value="{{$item->id}}">{{$item->site_id}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Project</label>
                            <select class="form-control" wire:model="project_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Project::orderBy('name','ASC')->limit(100)->get() as $item)
                                <option value="{{$item->id}}">{{$item->project_code}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <input type="date" class="form-control" wire:model="due_date" />
                        </div>
                    </div>
                    <div class="modal-footer">
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
