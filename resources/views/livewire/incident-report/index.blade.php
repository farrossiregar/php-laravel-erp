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
                                <th>Incident Number</th>    
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
                            </tr>
                        </thead>
                        <tbody>
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
                                            <span class="badge badge-primary">Close</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status==1)
                                            <a href="javascript:void(0)" wire:click="set_({{$item->id}})" data-toggle="modal" data-target="#modal_accept_incident" class="badge badge-danger"><i class="fa fa-arrow-right"></i> Proses</a>
                                        @else    
                                            {{$item->incident_number}}
                                        @endif
                                    </td>
                                    <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
                                    <td>{{isset($item->employee->nik) ? $item->employee->nik : ''}}</td>
                                    <td>{{isset($item->employee->telepon) ? $item->employee->telepon : ''}}</td>
                                    <td>{!!isset($item->employee->email) ? "<a href=\"mailto:{$item->employee->email}\">{$item->employee->email}</a>" : ''!!}</td>
                                    <td>{{isset($item->tanggal_kejadian) ? date('d-M-Y',strtotime($item->tanggal_kejadian)) : ''}}</td>
                                    <td>{{isset($item->employee->department->name) ? $item->employee->department->name : ''}}</td>
                                    <td>{{isset($item->lokasi) ? $item->lokasi : ''}}</td>
                                    <td>{{$item->category}}</td>
                                    <td>
                                        @if($item->risk=="High")
                                            <span class="text-danger">
                                        @endif
                                        @if($item->risk=="Medium")
                                            <span class="text-warning">
                                        @endif
                                        @if($item->risk=="Low")
                                            <span class="text-success">
                                        @endif
                                            {{$item->risk}}
                                        </span>
                                    </td>
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
                                            <a href="javascript:void(0)" wire:click="set_({{$item->id}})" data-toggle="modal" data-target="#modal_solved_incident" class="badge badge-danger btn-block"><i class="fa fa-check"></i> Resolve</a>
                                        @endif
                                        @if($item->end_date)
                                            {{date('d-M-Y H:i',strtotime($item->end_date))}}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if($data->count()==0)
                                <tr>
                                    <td class="text-center" colspan="18"><i>Empty...</i></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" x-data="" wire:ignore.self id="modal_solved_incident" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="approve">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Solve Incident Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Impact</label>
                            <textarea class="form-control" wire:model="impact"></textarea>
                            @error('impact')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Root Cause</label>
                            <textarea class="form-control" wire:model="root_cause"></textarea>
                            @error('risk')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Action plan</label>
                            <textarea class="form-control" wire:model="action_plan"></textarea>
                            @error('action_plan')
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
                    </div>
                    <div class="modal-footer" wire:loading.remove wire:target="save">
                        <button type="button" wire:click="submit_solved(4)" class="btn btn-danger">Unsolved Incident</button>
                        <button type="button" wire:click="submit_solved(3)" class="btn btn-success">Solved Incident</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" x-data="" wire:ignore.self id="modal_accept_incident" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form wire:submit.prevent="approve">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Generate Incident Number & Approve</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Accept Inciden Report and Generate Incident Number</p>
                        </div>
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
                        <button type="submit" class="btn btn-success">Generate Incident Number & Approve</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
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
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Incident Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal Kejadian (*default today) </label>
                            <input type="date" class="form-control" wire:model="tanggal_kejadian" />
                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <select class="form-control" wire:model="lokasi">
                                <option value=""> --- Pilih --- </option>
                                <option>Head Office</option>
                                <option>Diluar Kantor / Remote</option>
                            </select>
                            @error('lokasi')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group" x-data="">
                            <label>Kategori Masalah </label>
                            <select class="form-control" wire:model="category">
                                <option value=""> --- Select --- </option>
                                @foreach(config('vars.kategori_masalah_insiden') as $item)
                                    <option>{{$item}}</option>
                                @endforeach
                                <option value="others">Others ( Free Text )</option>
                            </select>
                            <div x-show="$wire.show_category_others" class="mt-2">
                                <input type="text" class="form-control" wire:model="trouble_ticket_category_others" placeholder="Free Text">
                            </div>
                            @error('category')
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
                    <div class="modal-footer" wire:loading.remove wire:target="save">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                        <span wire:loading wire:target="save">
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('after-scripts')
        <script>
            Livewire.on('hide-modal',()=>{
                $("#modal_insert_trouble_ticket").modal("hide");
            });
            Livewire.on('hide-modal-approve',()=>{
                $("#modal_accept_incident").modal("hide");
            });
        </script>
    @endpush
</div>