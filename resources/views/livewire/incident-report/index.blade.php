@section('title', __('Incident Report'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-8">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_trouble_ticket" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Incident Report')}}</a>
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status</th>          
                                <th>Ticket Number</th>    
                                <th>Nama Pelapor / Requester</th>          
                                <th>NIK</th>          
                                <th>Nomor HP(WA)</th>          
                                <th>Email</th>          
                                <th>Tanggal Kejadian</th>          
                                <th>Departmen</th>          
                                <th>Lokasi Kejadian</th>    
                                <th>Kategori Masalah</th>   
                                <th>Risk</th>       
                                <th>Uraian Masalah</th>          
                                <th>File</th> 
                                <th>Pickup By</th>     
                                <th>Pickup Date</th> 
                                <th>Resolved Date</th> 
                                <th>Closed Date</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td style="width: 50px;">{{$k+1}}</td>
                                    <td>
                                        @if(check_access('trouble-ticket.field-team'))
                                            @if($item->status==1)
                                                <a href="javascript:void(0)" class="badge badge-info">Open</a>
                                            @endif
                                            @if($item->status==2)
                                                <a class="badge badge-warning">Progress</a>
                                            @endif
                                            @if($item->status==3)
                                                <a class="badge badge-success">Resolved</a>
                                            @endif
                                            @if($item->status==4)
                                                <a class="badge badge-primary">Close</a>
                                            @endif
                                        @else
                                            @if($item->status==1)
                                                <span class="badge badge-info">Open</span>
                                            @endif
                                            @if($item->status==2)
                                                <span class="badge badge-warning">Progress</span>
                                            @endif
                                            @if($item->status==3)
                                                <span class="badge badge-success">Resolved</span>
                                            @endif
                                            @if($item->status==4)
                                                <span class="badge badge-primary">Close</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{$item->trouble_ticket_number}}</td>
                                    <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
                                    <td>{{isset($item->employee->nik) ? $item->employee->nik : ''}}</td>
                                    <td>{{isset($item->employee->telepon) ? $item->employee->telepon : ''}}</td>
                                    <td>{!!isset($item->employee->email) ? "<a href=\"mailto:{$item->employee->email}\">{$item->employee->email}</a>" : ''!!}</td>
                                    <td>{{isset($item->tanggal_kejadian) ? date('d-M-Y',strtotime($item->tanggal_kejadian)) : ''}}</td>
                                    <td>{{isset($item->employee->department->name) ? $item->employee->department->name : ''}}</td>
                                    <td>{{isset($item->lokasi) ? $item->lokasi : ''}}</td>
                                    <td>{{$item->trouble_ticket_category}}</td>
                                    <td>{{$item->type_risk}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>
                                        @if($item->file)
                                            <div x-data="{show:false}">
                                                <template x-if="!show">
                                                    <a href="javascript:void(0)" x-on:click="show = ! show"><i class="fa fa-image"></i></a>
                                                </template>
                                                <div x-show="show">
                                                    <img src="{{asset($item->file)}}" style="width:150px;" /><br />
                                                    <a href="javascript:void(0)" x-on:click="show = ! show"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{isset($item->pic->name) ? $item->pic->name : ''}}</td>
                                    <td>
                                        @if($item->start_date)
                                            {{date('d-M-Y H:i',strtotime($item->start_date))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->end_date)
                                            {{date('d-M-Y H:i',strtotime($item->end_date))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->approve_date)
                                            {{date('d-M-Y H:i',strtotime($item->approve_date))}}
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" x-data="" wire:ignore.self id="modal_insert_trouble_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Incident Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Incident Report Number </label>
                            <input type="text" class="form-control" wire:model="incident_report_number" disabled />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kejadian </label>
                            <input type="date" class="form-control" wire:model="tanggal_kejadian" />
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select class="form-control" wire:model="lokasi">
                                <option>Head Office</option>
                                <option>Diluar Kantor / Remote</option>
                            </select>
                        </div>
                        
                        <div class="form-group" x-data="">
                            <label>Kategori Masalah </label>
                            <select class="form-control" wire:model="trouble_ticket_category_id">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.kategori_masalah_trouble') as $item)
                                    <option>{{$item}}</option>
                                @endforeach
                                <option value="others">Others ( Free Text )</option>
                            </select>
                            <div x-show="$wire.show_category_others" class="mt-2">
                                <input type="text" class="form-control" wire:model="trouble_ticket_category_others" placeholder="Free Text">
                            </div>
                            @error('trouble_ticket_category_id')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Uraian Masalah</label>
                            <small>Jelaskan masalah lebih detail</small>
                            <textarea class="form-control" wire:model="description" style="height: 80px;"></textarea>
                            @error('description')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Attachment (pdf,docs,image)</label>
                            <input type="file" class="form-control" wire:model="file" multiple />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                        <button type="submit" x-on:click="$('#modal_insert_trouble_ticket').modal('hide')" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>