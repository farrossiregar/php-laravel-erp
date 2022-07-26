@section('title', __('Additional Opex'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
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
                                <th>Period</th>          
                                <th>PIC</th>          
                                <th>Description</th>          
                                <th>Cash Transaction No</th>
                                <th class="text-right">Additional Amount</th>      
                                <th>Supporting Document</th>     
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
                                            <span class="badge badge-success">Accepted</span>
                                        @endif
                                        @if($item->status==3)
                                            <span class="badge badge-danger" onclick="alert('{{$item->app_staff_note}}')" title="{{$item->app_staff_note}}">Reject</span>
                                        @endif
                                    </td>
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->region}}</td>
                                    <td>{{$item->month}}</td>
                                    <td>{{isset($item->employee->name) ? $item->employee->name : '-'}}</td>
                                    <td>
                                        @php($description_ = [])
                                        @foreach(\App\Models\OtherOpexItem::where('other_opex_id', $item->id)->get() as $i)
                                            @php($description_[] = $i->description)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    </td>
                                    <td>@livewire('finance.other-opex.other-opex-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td class="text-right">{{format_idr($item->total_settlement)}}</td>
                                    <td class="text-center">
                                        @if(isset($item->master->additional_doc))
                                            <a href="{{asset($item->master->additional_doc)}}"><i class="fa fa-download"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->status==0 and $is_apstaff)
                                            <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process"><i class="fa fa-check-circle"></i> Process</a>
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
<div class="modal fade" id="modal_other_opex_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex.other-opex-budget />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_other_opex_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex.other-opex-type />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex.other-opex-process />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_other_opex_settle" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex.other-opex-settle />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_other_opex_settle_detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex.other-opex-settle-detail />
        </div>
    </div>
</div>