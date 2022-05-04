@section('title', __('Petty Cash'))
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
                                    <td>{{$item->month}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_nominal'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'advance_date'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'cash_transaction_no'],key($item->id))</td>
                                    <td>{{$item->settlement_date}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'description'],key($item->id))</td>
                                    <td>{{$item->settlement_nominal}}</td>
                                    <td>{{$item->total_settlement}}</td>
                                    <td>{{$item->difference}}</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'account_no_recorded'],key($item->id))</td>
                                    <td>@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'account_name_recorded'],key($item->id))</td>
                                    <td>{{$item->nominal_recorded}}</td>
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