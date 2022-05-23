@section('title', __('Petty Cash'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-1" style="margin: 0 10px;">
                    <a href="javascript:;" wire:click="$emit('modaladdpettycashaccountpayable')" class="btn btn-info"><i class="fa fa-plus"></i> Add Request</a>
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
                                <th>Dept</th>          
                                <th>Advance Request No</th>          
                                <th>Period(Bulan)</th>          
                                <th>Advance Nominal</th>          
                                <th>Advance Date</th>          
                                <th>Cash Transaction No</th>          
                                <th>Settlement Date</th>          
                                <th>Description</th>          
                                <th>Settlement Nominal</th>          
                                <th>Total Settlement</th>          
                                <th>Difference</th>          
                                <th>Account No Recorded</th>          
                                <th>Account Name Recorded</th>          
                                <th>Nominal Recorded</th>
                                <th>Attachment Document For Settlement</th>          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td>{{$item->department}}</td>
                                    <td>{{$item->advance_req_no}}</td>
                                    <td>{{date('F', mktime(0, 0, 0, (int)$item->month, 10))}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_nominal'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_date'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td>{{ date_format(date_create($item->settlement_date), 'd M Y')}}</td>
                                    <!-- <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'description'],key($item->id))</td> -->
                                    <td>
                                        <?php foreach(\App\Models\AdvanceSettlementAP::where('id_master', $item->id_master)->get() as $items){ ?>
                                            <b>{{ $items->description }} </b> <br>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php foreach(\App\Models\AdvanceSettlementAP::where('id_master', $item->id_master)->get() as $items){ ?>
                                            <b> {{ ($items->settlement) ? 'Rp,'.$items->settlement : '' }} </b> <br>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <!-- <?php echo \App\Models\AccountPayable::where('id', $item->id_master)->first(); ?> -->
                                        
                                        @if(!$item->settlement_nominal)
                                            @if($is_apstaff)
                                                @if(@\App\Models\AccountPayable::where('id', @$item->id_master)->first()->status == '2')
                                                    <a href="javascript:;" wire:click="$emit('modalupdatepettycashaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i></a>
                                                @endif
                                            @endif
                                        @else
                                            @if($is_apstaff)
                                                @if(@\App\Models\AccountPayable::where('id', @$item->id_master)->first()->status == '2')
                                                    <a href="javascript:;" wire:click="$emit('modalupdatepettycashaccountpayable','{{ $item->id }}')"><i class="fa fa-edit " style="color: #22af46;"></i> {{$item->total_settlement}}</a>
                                                @endif
                                            @else
                                                <a href="javascript:;" ><i class="fa fa-edit " style="color: #22af46;"></i> {{$item->total_settlement}}</a>
                                            @endif
                                        @endif
                                        
                                    </td>
                                    <td>Rp, {{ format_idr($item->difference) }}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'account_no_recorded'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'account_name_recorded'],key($item->id))</td>
                                    <td>Rp, {{ format_idr(@$item->nominal_recorded) }}</td>
                                    <td>{{$item->doc_settlement}}</td>
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