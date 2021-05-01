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
            <h4><small>Speed Warning :</small> {{get_setting('speed_limit')}} km/h <small><a href="javascript:void(0)" data-toggle="modal" data-target="#modal_speed_warning"><i class="fa fa-edit"></i></a></small></h4>
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
                    <th>Employee</th>   
                    <th>Speed (km/h)</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $k => $item)
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                        <td>{{$item->speed}}</td>
                        <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                        <td>{{date('H:i',strtotime($item->created_at))}}</td>
                        <td>{{$item->lat}}</td>
                        <td>{{$item->long}}</td>
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
    <div wire:ignore.self class="modal fade" id="modal_speed_warning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="set_speed_warning">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-dashboard"></i> Speed Warning</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning" role="alert">Batas kecepatan maksimum yang diperbolehkan Tim Lapangan.</div>
                            </div>
                            <div class="from-group col-md-3">
                                <label>KM/H</label>
                                <input type="text" class="form-control" wire:model="speed_limit" />
                                @error('speed_limit')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
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
    </script>
    @endpush
</div>
