@section('title', __('Trouble Ticket'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-8">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_insert_trouble_ticket" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Trouble Ticket')}}</a>
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
                                <th>Noted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($employee_id = \Auth::user()->employee->id)
                            @php($is_field_team = check_access('trouble-ticket.field-team'))
                            @foreach($data as $k => $item)
                                <tr>
                                    <td style="width: 50px;">{{$k+1}}</td>
                                    <td>
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
                                            <span class="badge badge-primary">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status==1)
                                            @if($is_field_team)
                                                <a href="javascript:void(0)" wire:click="set_({{$item->id}})" data-toggle="modal" data-target="#modal_accept" class="badge badge-danger"><i class="fa fa-arrow-right"></i> Proses</a>
                                            @endif
                                        @else 
                                            {{$item->trouble_ticket_number}}
                                        @endif
                                    </td>
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
                                        @if($item->status==2)
                                            @if($is_field_team)
                                                <a href="javascript:void(0)" wire:click="set_({{$item->id}})" data-toggle="modal" data-target="#modal_solved" class="badge badge-danger btn-block"><i class="fa fa-check"></i> Resolve</a>
                                            @endif
                                        @endif
                                        @if($item->end_date)
                                            {{date('d-M-Y H:i',strtotime($item->end_date))}}
                                        @endif
                                    </td>
                                    <td x-data="{open:false}">
                                        @if($item->employee_id == $employee_id and $item->status==3)
                                            <template x-if="open==false">
                                                <a href="javascript:void(0)" class="badge badge-success" x-on:click="open = ! open"><i class="fa fa-check"></i> Closed</a>
                                            </template>
                                            <div x-show="open" @click.away="open = false" class="mt-2">
                                                <a href="javascript:void(0)" class="mr-2 text-danger" x-on:click="open=false"><i class="fa fa-times"></i> Cancel</a>
                                                <a href="javascript:void(0)" wire:click="set_closed({{$item->id}})" class="text-success"><i class="fa fa-arrow-right"></i> Proccess</a>
                                            </div>
                                        @endif
                                        @if($item->approve_date)
                                            {{date('d-M-Y H:i',strtotime($item->approve_date))}}
                                        @endif
                                    </td>
                                    <td>{{$item->note}}</td>
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
    <div class="modal fade" x-data="" wire:ignore.self id="modal_solved" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="solved">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Solve Trouble Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label class="fancy-radio">
                            <input type="radio" wire:model="status" value="3" required>
                            <span><i></i>Solve</span>
                        </label>
                        <label class="fancy-radio">
                            <input type="radio" wire:model="status" value="4" required>
                            <span><i></i>Not Solve</span>
                        </label>
                        @if($status == 4)
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea class="form-control" wire:model="reason"></textarea>
                                @error('reason')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Recommendation</label>
                                <textarea class="form-control" wire:model="recommendation"></textarea>
                                @error('recommendation')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" wire:model="note"></textarea>
                                @error('note')
                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer" wire:loading.remove wire:target="save">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" x-data="" wire:ignore.self id="modal_insert_trouble_ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="save">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Trouble Ticket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Trouble Ticket Number </label>
                            <input type="text" class="form-control" wire:model="trouble_ticket_number" disabled />
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kejadian </label>
                            <input type="date" class="form-control" wire:model="tanggal_kejadian" />
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select class="form-control" wire:model="lokasi_kejadian">
                                <option value=""> -- Select -- </option>
                                <option>Head Office</option>
                                <option>Diluar Kantor / Remote</option>
                            </select>
                        </div>
                        <div class="form-group" x-data="">
                            <label>Kategori Masalah </label>
                            <select class="form-control" wire:model="trouble_ticket_category">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.kategori_masalah_trouble') as $item)
                                    <option>{{$item}}</option>
                                @endforeach
                                <option value="others">Others ( Free Text )</option>
                            </select>
                            <div x-show="$wire.show_category_others" class="mt-2">
                                <input type="text" class="form-control" wire:model="trouble_ticket_category_others" placeholder="Free Text">
                            </div>
                            @error('trouble_ticket_category')
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
                            <input type="file" class="form-control" wire:model="file" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" x-data="" wire:ignore.self id="modal_accept" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="accept">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Generate Trouble Ticket Number & Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Risk</label>
                            <select class="form-control" wire:model="risk">
                                <option value=""> --- Select --- </option>
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                            </select>
                            @error('risk')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer" wire:loading.remove wire:target="save">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Accept and Generate Number</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>