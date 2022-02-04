
@section('title', 'Region Tools')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="dashboard">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                            </div>
                            <div class="col-md-1 form-group">
                                <input type="text" class="form-control date_created" placeholder="Date" />
                            </div>
                            <div class="col-md-2" wire:ignore>
                                <select class="form-control" wire:model="region_id">
                                    <option value=""> -- Region -- </option>
                                    @foreach($regions as $item)
                                        <option value="{{$item->id}}">{{$item->region}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">                                        
                                        <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target="#modal_import_pm"><i class="fa fa-upload"></i> Import</a>
                                    </div>
                                </div>    
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
                                        <th>Date Uploaded</th>
                                        <th>Service Manager</th>
                                        <th>Region</th>
                                        <th>Tools</th>
                                        <th>Qty</th>
                                        <th>Branch</th>
                                        <th>Serial Number</th>
                                        <th>PIC Responsible</th>
                                        <th>NIK</th>
                                        <th>Remark / Alokasi</th>
                                        <th>Current Position</th>
                                        <th>Status Asset</th>
                                    </tr>    
                                </thead>
                                <tbody>
                                    @php($num=$data->firstItem())
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                                            <td>{{isset($item->sm->name)?$item->sm->name:''}}</td>
                                            <td>{{isset($item->region->region)?$item->region->region:''}}</td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-danger pull-left mr-2" wire:click="delete({{$item->id}})"><i class="fa fa-trash"></i></a>
                                                @livewire('region-tools.editable',['data'=>$item,'field'=>'tools_name'],key((int)$item->id))
                                            </td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'qty'],key((int)$item->id))</td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'branch'],key((int)$item->id))</td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'serial_number'],key((int)$item->id))</td>
                                            <td>{{isset($item->pic->name)?$item->pic->name:'-'}}</td>
                                            <td>{{isset($item->pic->nik)?$item->pic->nik:'-'}}</td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'remark'],key((int)$item->id))</td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'current_position'],key((int)$item->id))</td>
                                            <td>@livewire('region-tools.editable',['data'=>$item,'field'=>'status_asset'],key((int)$item->id))</td>
                                        </tr>
                                        @php($num++)
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal_import_pm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="import">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Region Tools</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File (xlsx)</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                            <a href="{{asset('template/region-tools.xlsx')}}"><i class="fa fa-download"></i> Template Uploader</a> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="submit" wire:loading.remove class="btn btn-success"><i class="fa fa-save"></i> Upload</button>
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
            $(document).ready(function() {    
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
            });
        </script>
    @endpush
</div>