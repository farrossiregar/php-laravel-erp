@section('title', __('Weekly Opex'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_weekly_opex_budget" class="btn btn-success"><i class="fa fa-database"></i> Budget</a>
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_weekly_opex_type" class="btn btn-info"><i class="fa fa-database"></i> Type</a>
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
                                <th>Project Name</th>          
                                <th>Region</th>          
                                <th>Sub Region</th>          
                                <th>Month (Bulanan)</th>          
                                <th>Budget Opex</th>          
                                <th class="text-center">Period (Perminggu)</th>   
                                <th>Description</th> 
                                <th>Advance Date</th>         
                                <th>Advance Nominal</th>
                                <th>Difference</th>          
                                <th>Settlement Nominal</th>
                                <th>Submitted Date</th>          
                                <th>Cash Transaction No</th>
                                <th>Attachment Document For Advance</th>     
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
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
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->region}}</td>
                                    <td>{{$item->subregion}}</td>
                                    <td>{{$item->month}}</td>
                                    <td>{{format_idr($item->budget_opex)}}</td>
                                    <td class="text-center">{{$item->week}}</td>
                                    <td>
                                        @php($description_ = [])
                                        @foreach(\App\Models\WeeklyOpexItem::where('weekly_opex_id', $item->id)->get() as $i)
                                            @php($description_[] = $i->description)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    </td>
                                    <td>{{$item->settlement_date ? date('d-F-Y',strtotime($item->settlement_date)) : '-'}}</td>
                                    <td>{{format_idr($item->total_settlement)}}</td>
                                    <td>{{format_idr($item->previous_balance) }}</td>
                                    <td>{{format_idr($item->total_transfer)}}</td>
                                    <td>{{$item->transfer_date}}</td>
                                    <td>@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td class="text-center">
                                        @if($item->doc_settlement)
                                            <a href="{{asset($item->doc_settlement)}}"><i class="fa fa-download"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status==0 and $is_apstaff)
                                            <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process"><i class="fa fa-check-circle"></i> Process</a>
                                        @endif
                                        @if($item->status==1 and $is_finance)
                                            <a href="javascript:;" wire:click="$emit('set_id','{{ $item->id }}')" data-toggle="modal" data-target="#modal_weekly_opex_settle" class="badge badge-warning badge-active"><i class="fa fa-edit"></i> Advance</a>
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
<div class="modal fade" id="modal_weekly_opex_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-budget />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_weekly_opex_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-type />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-process />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_weekly_opex_settle" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-settle />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_weekly_opex_settle_detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-settle-detail />
        </div>
    </div>
</div>