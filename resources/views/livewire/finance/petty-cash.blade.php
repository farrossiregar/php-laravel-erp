@section('title', __('Petty Cash'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2" wire:ignore>
                    <select class="form-control" style="width:100%;" wire:model="filtermonth">
                        <option value=""> --- Month --- </option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 form-group">
                    <select onclick="" class="form-control" wire:model="subrequest_type">
                        <option value=""> --- Request Type --- </option>
                        @foreach(\App\Models\RequestDetailOption::where('id_request_type', '1')->get() as $items)
                            <option value="{{ $items->id_request_detail_option }}">{{ $items->request_detail_option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5" style="margin: 0 10px;">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_petty_cash_budget" class="btn btn-success"><i class="fa fa-database"></i> Budget</a>
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_petty_cash_type" class="btn btn-info"><i class="fa fa-database"></i> Type</a>
                </div>
                <div class="col-md-8">
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <thead style="background:#eee;">
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Dept</th>               
                                <th>Employee</th>               
                                <th>Project</th>               
                                <th>Advance Request No</th>    
                                <th class="text-right">Budget</th>
                                <th>Period(Bulan)</th>          
                                <th>Description</th>          
                                <th>Advance Date</th>          
                                <th class="text-right">Advance Nominal</th>          
                                <th class="text-right">Difference</th>          
                                <th class="text-right">Settlement Nominal</th>     
                                <th>Submitted Date</th>          
                                <th>Cash Transaction No</th> 
                                <th class="text-center">Attachment Document For Advance</th>      
                                <th></th>    
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                @php($total_settlement=0)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>
                                        @if($item->status==0)
                                            <span class="badge badge-warning">Waiting AP Staff</span>
                                        @endif
                                        @if($item->status==1)
                                            <span class="badge badge-info">Finance in review</span>
                                        @endif
                                        @if($item->status==2)
                                            <span class="badge badge-success">Settled</span>
                                        @endif
                                        @if($item->status==3)
                                            <span class="badge badge-danger" onclick="alert('{{$item->app_staff_note}}')" title="{{$item->app_staff_note}}">Reject</span>
                                        @endif
                                    </td>
                                    <td>{{$item->department}}</td>
                                    <td>{{isset($item->employee->name) ?  $item->employee->nik .' / '. $item->employee->name : '-'}}</td>
                                    <td>
                                        @if(isset($item->employee->employee_project))
                                            @foreach($item->employee->employee_project as $project)
                                                {{isset($project->project->name) ? $project->project->name : ''}}
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{$item->advance_req_no}}</td>
                                    <td class="text-right">{{format_idr($item->budget)}}</td>
                                    <td>{{date('F', mktime(0, 0, 0, (int)$item->month, 10))}}</td>
                                    
                                    <td>
                                        @php($description_ = [])
                                        @foreach($item->items as $i)
                                            @php($description_[] = $i->description)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    </td>
                                    <td>{{ $item->settlement_date ? date_format(date_create($item->settlement_date), 'd M Y') : '-'}}</td>
                                    <td class="text-right">
                                        @if($item->total_settlement)
                                            <a href="javascript:void(0)" wire:click="$emit('set_id',{{$item->id}})" data-target="#modal_petty_cash_settle_detail" data-toggle="modal">{{format_idr($item->total_settlement)}}</a>
                                        @endif
                                    </td>
                                    <td class="text-right">{{ $item->total_settlement ? format_idr($item->budget-$item->total_settlement) : '-' }}</td>
                                    <td class="text-right">{{format_idr($item->advance_nominal)}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_date'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td class="text-center">
                                        @if($item->doc_settlement)
                                            <a href="{{asset($item->doc_settlement)}}" target="_blank"><i class="fa fa-download"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status==0 and $is_apstaff)
                                            <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process"><i class="fa fa-check-circle"></i> Process</a>
                                        @endif
                                        @if($item->status==1 and $is_finance)
                                            <a href="javascript:;" wire:click="$emit('set_id','{{ $item->id }}')" data-toggle="modal" data-target="#modal_petty_cash_settle" class="badge badge-warning badge-active"><i class="fa fa-edit"></i> Advance</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @if($data->count()==0)
                                <tr>
                                    <td colspan="18" class="text-center"><i>empty</i></td>
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
</div>
<div class="modal fade" id="modal_petty_cash_settle" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.petty-cash-settle />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_petty_cash_settle_detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.petty-cash-settle-detail />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_petty_cash_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.petty-cash-type />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_petty_cash_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.petty-cash-budget />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:finance.petty-cash-process />
        </div>
    </div>
</div>
