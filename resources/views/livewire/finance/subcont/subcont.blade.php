@section('title', __('Subcont'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_subcont_budget" class="btn btn-success"><i class="fa fa-database"></i> Budget</a>
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_subcont_type" class="btn btn-info"><i class="fa fa-database"></i> Type</a>
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
                                <th>Contract No</th>          
                                <th>Period</th>          
                                <th>Subcont Name</th>          
                                <th>Invoice No</th>          
                                <th>Invoice Date</th>          
                                <th>PR No</th>          
                                <th>PO No</th>          
                                <th>Other Cost</th>          
                                <th>Total Nominal</th>          
                                <th>VAT</th>          
                                <th>WHT</th>          
                                <th>Item Transfer Amount</th>
                                <th>Total Transfer</th>
                                <th>Transfer Date</th>         
                                <th>Cash Transaction No</th>
                                <th>Settlement Date</th>          
                                <th>Settlement Amount</th>
                                <th>Total Settlement</th>
                                <th>Difference</th>       
                                <!-- <th>Attachment Document For Advance</th>      -->
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
                                        @if($item->status==4)
                                            <span class="badge badge-info" >Waiting PMG</span>
                                        @endif
                                    </td>
                                    <td>{{$item->project_name}}</td>
                                    <td>{{$item->region}}</td>
                                    <td>{{$item->subregion}}</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'contract_no'],key($item->id))</td>
                                    <td>{{$item->month}} {{$item->year}}</td>
                                    <td>
                                        @php($description_ = [])
                                        @foreach(\App\Models\SubcontItem::where('subcont_id', $item->id)->get() as $i)
                                            @php($description_[] = $i->description)
                                        @endforeach
                                        {{implode(", ", $description_)}}
                                    </td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'invoice_no'],key($item->id))</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'invoice_date'],key($item->id))</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'pr_no'],key($item->id))</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'po_no'],key($item->id))</td>
                                    <td>{{$item->other_cost}}</td>
                                    <td>{{format_idr($item->total_nominal)}}</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'vat'],key($item->id))</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'wht'],key($item->id))</td>
                                    <td>
                                        @php($itembudget_ = [])
                                        @foreach(\App\Models\SubcontItem::where('subcont_id', $item->id)->get() as $i)
                                            @php($itembudget_[] = $i->amount)
                                        @endforeach
                                        {{implode(", ", $itembudget_)}}
                                    </td>
                                    <td>{{format_idr($item->total_transfer)}}</td>
                                    <td>{{$item->transfer_date}}</td>
                                    <td>@livewire('finance.subcont.subcont-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td>{{$item->settlement_date ? date('d-F-Y',strtotime($item->settlement_date)) : '-'}}</td>
                                    <td>
                                        @php($itemsettlement_ = [])
                                        @foreach(\App\Models\SubcontItem::where('subcont_id', $item->id)->get() as $i)
                                            @php($itemsettlement_[] = $i->amount_settle)
                                        @endforeach
                                        {{implode(", ", $itemsettlement_)}}
                                    </td>
                                    <td>{{format_idr($item->total_settlement)}}</td>
                                    <td>{{format_idr($item->difference) }}</td>
                                    

                                    <!-- <td class="text-center">
                                        @if($item->doc_settlement)
                                            <a href="{{asset($item->doc_settlement)}}"><i class="fa fa-download"></i></a>
                                        @endif
                                    </td> -->
                                    <td>
                                        <!-- if($item->status==0 and $is_apstaff) -->
                                            <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process"><i class="fa fa-check-circle"></i> Process</a>
                                        <!-- endif -->

                                        <!-- if($item->status==4 and $is_pmg) -->
                                         <a href="javascript:void(0)" wire:click="$emit('check_id',{{$item->id}})" class="badge badge-info badge-active" data-toggle="modal" data-target="#modal_process"><i class="fa fa-check-circle"></i> Process</a>
                                        <!-- endif -->

                                        <!-- if($item->status==1 and $is_finance) -->
                                            <a href="javascript:;" wire:click="$emit('set_id','{{ $item->id }}')" data-toggle="modal" data-target="#modal_subcont_settle" class="badge badge-warning badge-active"><i class="fa fa-edit"></i> Advance</a>
                                        <!-- endif -->
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
<div class="modal fade" id="modal_subcont_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.subcont.subcont-budget />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_subcont_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.subcont.subcont-type />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:finance.subcont.subcont-process />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_subcont_settle" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.subcont.subcont-settle />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_subcont_settle_detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.subcont.subcont-settle-detail />
        </div>
    </div>
</div>