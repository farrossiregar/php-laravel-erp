<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    <div class="col-md-1">                
        <select class="form-control" wire:model="filteryear">
            <option value=""> --- Year --- </option>
            <option value="2022">2022</option>
            <option value="2021">2021</option>
            <option value="2020">2020</option>
            <option value="2019">2019</option>
            <option value="2018">2018</option>
            <option value="2017">2017</option>
        </select>
    </div>
    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filtermonth">
            <option value=""> --- Month --- </option>
            @for($i = 1; $i <= 12; $i++)
                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
            @endfor
        </select>
    </div>
    

     <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="filterproject">
            <option value=""> --- Project --- </option>
            @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2 form-group">
        <input type="text" class="form-control" wire:model="cust_name">
        
    </div>

    @if(check_access('sales-account-receivable.e2e'))
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('addposalesar')" class="btn btn-info"><i class="fa fa-plus"></i> Add PO Listing </a>
    </div>  
    @endif
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <!-- <th rowspan="2" class="align-middle">Status</th>  -->
                        <!-- <th rowspan="2" class="align-middle">Action</th>  -->
                        <th rowspan="2" class="align-middle">Date Create</th>
                        <th rowspan="2" class="align-middle" style="text-align:center;">PO</th> 
                        <th rowspan="2" class="align-middle">Period</th> 
                        <th rowspan="2" class="align-middle">Customer Name</th> 
                        <th rowspan="2" class="align-middle" style="text-align:center;">Project</th> 
                        
                        <th rowspan="2" class="align-middle" style="text-align:center;">Invoice</th> 
                        <th rowspan="2" class="align-middle">Payment Info</th> 
                        <th rowspan="2" class="align-middle">TOP</th> 
                        <th rowspan="2" class="align-middle">Due Date</th> 
                        
                        <th rowspan="2" class="align-middle">Credit Note</th> 
                        <th rowspan="2" class="align-middle">Invoice Net Amount</th> 
                        
                        <th rowspan="2" class="align-middle">Treasury</th> 
                        
                        <th rowspan="2" class="align-middle">Aging</th> 
                        <th rowspan="2" class="align-middle">Sales Invoice</th> 
                        <th rowspan="2" class="align-middle">Credit Note</th> 
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                       
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td style="text-align:center;" >
                            <b>{{ $item->po_no }}</b><br>
                            {{ date_format(date_create($item->po_date), 'd M Y') }}
                        </td>
                        <td><b>{{ date('F', mktime(0, 0, 0, $item->month, 10)) }} {{ $item->year }}</b></td>
                        <td>
                            {{ $item->cust_name }}
                        </td>
                        <td style="text-align:center;" class="align-middle">
                            <b>{{ $item->project_name }}</b><br>
                            {{ $item->region }}
                        </td>

                        
                        
                        <td style="text-align:center;" class="align-middle">
                            @if($item->invoice_no)
                                <a href="javascript:;" wire:click="$emit('modaladdinvoice', '{{ $item->id }}')">
                                    <b>{{ $item->invoice_no }}</b>
                                </a><br> 
                                {{ $item->tax_invoice_no }}
                            @else
                                <span><a href="javascript:;" wire:click="$emit('modaladdinvoice', '{{ $item->id }}')"><i class="fa fa-plus"></i></a></span>
                            @endif
                            
                        </td>
                        <td>
                            <!-- if(check_access('sales-account-receivable.treasury')) -->
                                @if($item->paid_amount_bank)
                                    <a href="javascript:;" wire:click="$emit('addpaymentinfo','{{ $item->id }}')"><i class="fa fa-eye" style="color: #17a2b8;"></i></a>
                                @else
                                    <a href="javascript:;" wire:click="$emit('addpaymentinfo','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                                @endif
                            <!-- endif -->
                        </td>
                        <td>{{ $item->top }}</td>
                        <td>{{ date_format(date_create($item->due_date), 'd M Y') }}</td>
                        
                        
                        <td><b>{{ $item->credit_note_number }}</b></td>
                        <td><b><a href="javascript:;" wire:click="$emit('detailinvoicedesc','{{ $item->id }}')">Rp, {{ format_idr($item->total) }}</a></b></td>
                        
                        <td>
                            @if(check_access('sales-account-receivable.treasury'))
                                @if($item->paid_amount_bank)
                                    <a href="javascript:;" wire:click="$emit('treasurysalesar','{{ $item->id }}')"><b>{{ $item->cash_transaction_no }}</b></a>
                                @else
                                    <a href="javascript:;" wire:click="$emit('treasurysalesar','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a>
                                @endif
                            @endif
                        </td>
                       
                        <td>
                            <?php
                                if($item->due_date){
                                    $date_evaluation = date('Y-m-d', strtotime("+90 days", strtotime($item->supplier_registered_date)));
                                    $diff = abs(strtotime($item->due_date) - strtotime(date_format(date_create($item->created_at), 'Y-m-d')));
                                    
                                    $years   = floor($diff / (365*60*60*24)); 
                                    $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                    $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                    $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                                    $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                            
                                    $waktu = '';
                                    if($months > 0){
                                        $waktu .= $months.' month ';
                                    }else{
                                        $waktu .= '';
                                    }
                            
                                    if($days > 0){
                                        $waktu .= $days.' days ';
                                    }else{
                                        $waktu .= '';
                                    }
                                    

                                    echo '<label class="badge badge-info" data-toggle="tooltip" title="">'.$waktu.'</label>';
                                }
                            ?>
                            @if(check_access('sales-account-receivable.acc'))
                                <!-- <a href="javascript:;" wire:click="$emit('updateaging','{{ $item->id }}')"><i class="fa fa-edit" style="color: #22af46;"></i></a> -->
                            @endif
                        </td>
                        <td>
                            <a href="#" wire:click="exportsalesinvoice({{ $item->id }})" title="Export Sales Invoice" ><i style="color: #17a2b8;" class="fa fa-download"></i> </a>
                        </td>
                        <td>
                            <a href="#" wire:click="exportcreditnote({{ $item->id }})" title="Export Credit Note" ><i style="color: #17a2b8;" class="fa fa-download"></i> </a>
                        </td>

                        
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>