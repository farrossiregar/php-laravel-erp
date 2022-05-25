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
                
                <div class="col-md-1" style="margin: 0 10px;">
                    <a href="javascript:;" wire:click="$emit('modaladdpettycashaccountpayable')" class="btn btn-info"><i class="fa fa-plus"></i> Add Request</a>
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
                                <th>Detail Request Option</th>          
                                <th>Advance Request No</th>          
                                <th>Period(Bulan)</th>          
                                <th>Advance Nominal</th>          
                                <th>Advance Date</th>          
                                <th>Cash Transaction No</th> 
                                <th>Description</th>          
                                <th>Settlement Date</th>          
                                <th>Settlement Description</th>          
                                <th>Settlement Nominal</th>          
                                <th>Total Settlement</th>          
                                <th>Difference</th>          
                                <th>Attachment Document For Settlement</th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                @php($total_settlement=0)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>
                                        @if($item->status==1)
                                            <span class="badge badge-info">Account Payable Staff</span>
                                        @endif
                                    </td>
                                    <td>{{$item->department}}</td>
                                    <td>{{ @\App\Models\RequestDetailOption::where('id_request_detail_option', $item->subrequest_type)->first()->request_detail_option }}</td>
                                    <td>{{$item->advance_req_no}}</td>
                                    <td>{{date('F', mktime(0, 0, 0, (int)$item->month, 10))}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_nominal'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_date'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td>
                                        <?php foreach(\App\Models\AdvanceSettlementAP::where('id_master', $item->id_master)->get() as $items){ ?>
                                            {{ $items->description }}<br>
                                        <?php } ?>
                                    </td>
                                    <td>{{ $item->settlement_date ? date_format(date_create($item->settlement_date), 'd M Y') : '-'}}</td>
                                    <td></td>
                                    <td>
                                        <?php foreach(\App\Models\AdvanceSettlementAP::where('id_master', $item->id_master)->get() as $items){ ?>
                                            {{ ($items->settlement) ? 'Rp,'.format_idr($items->settlement) : '' }} <br>
                                            @php($total_settlement += $items->settlement)
                                        <?php } ?>
                                    </td>
                                    <td>
                                        @if(!$item->settlement_nominal)
                                            @if($is_apstaff)
                                                <a href="javascript:;" wire:click="$emit('modalupdatepettycashaccountpayable','{{ $item->id }}')" class="badge badge-info badge-active"><i class="fa fa-edit"></i> Settlement</a>
                                            @endif
                                        @else
                                            <!-- @if($is_apstaff)
                                                @if(@\App\Models\AccountPayable::where('id', @$item->id_master)->first()->status == '2')
                                                    <a href="javascript:;" wire:click="$emit('modalupdatepettycashaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i> {{$item->total_settlement}}</a>
                                                @endif
                                            @else
                                                <a href="javascript:;" ><i class="fa fa-edit " style="color: #22af46;"></i> {{$item->total_settlement}}</a>
                                            @endif -->
                                        @endif
                                        {{format_idr($total_settlement)}}
                                    </td>
                                    <td>Rp, {{ format_idr($item->difference) }}</td>
                                    
                                    <td><a href="{{asset($item->doc_settlement)}}" target="_blank"><i class="fa fa-download"></i></a></td>
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

<div class="modal fade" id="modal-accountpayable-addpettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.addpettycash />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-accountpayable-updatepettycash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:account-payable.updatepettycash />
        </div>
    </div>
</div>


@section('page-script')

    Livewire.on('modaladdpettycashaccountpayable',(data)=>{
        
        $("#modal-accountpayable-addpettycash").modal('show');
    });

    Livewire.on('modalupdatepettycashaccountpayable',(data)=>{
        
        $("#modal-accountpayable-updatepettycash").modal('show');
    });

@endsection