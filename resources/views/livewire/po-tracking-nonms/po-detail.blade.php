
@section('title', $data->po_number)
@section('parentPageTitle', 'PO Tracking Non MS')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body pt-0">    
                <div class="row">
                    <div class="table-responsive col-md-4 pt-3">
                        <table class="table table-striped m-b-0 c_list table-nowrap-th">
                            <tbody>
                                <tr>
                                    <th>PO No</th>
                                    <td>{{$data->po_number}}</td>
                                </tr>
                                <tr>    
                                    <th>Date PO Release (sc)</th>    
                                    <td>{{date('d-M-Y',strtotime($data->date_po_sc))}}</td>
                                </tr>
                                <tr>
                                    <th>Date PO Release (sys)</th>
                                    <td>{{date('d-M-Y',strtotime($data->date_po_sys))}}</td>
                                </tr>
                                <tr>
                                    <th>Contract Number</th>
                                    <td>{{$data->contract_number}}</td>
                                </tr>
                                <tr>
                                    <th>Contract Date</th>
                                    <td>{{$data->date_contract?date('d-M-Y',strtotime($data->date_contract)):'-'}}</td>
                                </tr>
                                <tr>
                                    <th>BAST Number</th>
                                    <td>
                                        {{$data->bast_number}}
                                        @if($data->bast_file)
                                            <a href="{{asset($data->bast_file)}}"><i class="fa fa-download"></i> Document</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>BAST Date</th>
                                    <td>{{$data->bast_date?date('d-M-Y',strtotime($data->bast_date)):'-'}}</td>
                                </tr>
                                <tr>
                                    <th>BAST Note</th>
                                    <td>{{$data->bast_note}}</td>
                                </tr>
                                @if($is_e2e and $data->status==1)
                                    <tr>
                                        <th>BAST</th>
                                        <td>
                                            <input type="file" wire:model="bast_file" class="form-control"  />
                                            *xls,xlsx,pdf<br />
                                            @error('bast_file')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                            <a href="{{route('po-tracking-nonms.po-generate-bast',['data'=>$data->id])}}" target="_blank"><i class="fa fa-download"></i> Generate BAST</a>
                                        </td>
                                    </tr>
                                @endif
                            </head>
                        </table>
                    </div>
                    <div class="table-responsive col-md-4 pt-3">
                        <table class="table table-striped m-b-0 c_list table-nowrap-th">
                            <tbody>
                                <tr>
                                    <th>GR Number</th>
                                    <td>
                                        {{$data->gr_number}}
                                        @if($data->gr_file)
                                            <a href="{{asset($data->gr_file)}}"><i class="fa fa-download"></i> Document</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>GR Date</th>
                                    <td>{{$data->gr_date?date('d-M-Y',strtotime($data->gr_date)):'-'}}</td>
                                </tr>
                                @if($is_e2e and $data->status==1)
                                    <tr>
                                        <th>GR</th>
                                        <td>
                                            <input type="file" wire:model="gr_file" class="form-control"  />
                                            *xls,xlsx,pdf
                                            @error('gr_file')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </td>
                                    </tr>
                                @endif
                                </tr>
                                    <th>Invoice No</th>
                                    <td>{{$data->invoice_number}}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Date</th>
                                    <td>{{$data->invoice_date?date('d-M-Y',strtotime($data->invoice_date)):'-'}}</td>
                                </tr>
                                </tr>
                                    <th>Payment Date</th>
                                    <td>{{$data->payment_date?date('d-M-Y',strtotime($data->payment_date)):'-'}}</td>
                                </tr>
                                </tr>
                                    <th>Payment Amount</th>
                                    <td>{{format_idr($data->payment_amount)}}</td>
                                </tr>
                                </tr>
                                    <th>Transfer</th>
                                    <td>
                                        @if(isset($data->bukti_transfer))
                                            @foreach($data->bukti_transfer as $bukti_transfer)
                                                <a href="{{asset($bukti_transfer->file)}}" title="Finance - Budget Successfully Transfered" target="_blank"><i class="fa fa-image"></i> </a> 
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div class="table-responsive col-md-4 pt-3"></div>
                    @if($is_e2e and $data->status==1)
                        <div class="col-md-4">
                            <label>Note</label>
                            <textarea class="form-control" wire:model="bast_note"></textarea>
                        </div>
                    @endif
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>WO Number</th>    
                                <th>Region</th>    
                                <!-- <th class="text-center">Status</th>     -->
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Coordinator</th>
                                <th>Field Team</th>
                                <th>Extra Budget</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data->wos))
                                @foreach($data->wos as $k => $item)
                                    <tr>
                                        <td>{{$k+1}}</td>
                                        <td><a href="{{ route('po-tracking-nonms.edit-boq',['id'=>$item->id]) }}">{{ $item->no_tt }}</a></td>  
                                        <td>{{ $item->region }}</td>    
                                        <!-- <td class="text-center">
                                            @if($item->status==0 || $item->status == null || $item->status == '0')
                                                <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting to Submit">Waiting to Submit</label>
                                            @endif
                                            @if($item->status==1)
                                                <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                                            @endif
                                            @if($item->status==2)
                                                <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                            @endif
                                            @if($item->status==3)
                                                <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">Revise</label>
                                            @endif
                                            @if($item->status==4)
                                                <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                            @endif
                                            @if($item->status==5)
                                                <label class="badge badge-info" data-toggle="tooltip">Budget Transfer</label>
                                            @endif
                                            @if($item->status==6)
                                                <label class="badge badge-info" data-toggle="tooltip">Proccess Field Team</label>
                                            @endif
                                            @if($item->status==7 && $item->bast_status == 1)
                                                <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Waiting Approved Bast by E2E">BAST - Waiting Approval </label>
                                            @endif
                                            @if($item->status==7 && $item->bast_status == 2)
                                                <label class="badge badge-info" data-toggle="tooltip" title="E2E - Bast Approved">Bast Approved </label>
                                            @endif
                                            @if($item->status==7 && $item->bast_status == 3)
                                                <label class="badge badge-danger" data-toggle="tooltip" title="Regional - Revise Bast">Bast Revisi</label>
                                            @endif
                                            @if($item->status==8)
                                                <label class="badge badge-info" data-toggle="tooltip" title="E2E - Upload approved BAST & GR from customer">Upload BAST & GR</label>
                                            @endif
                                            @if($item->status==9)
                                                <label class="badge badge-danger" data-toggle="tooltip" title="Finance - Upload Approved Acceptance docs and Invoice">Finance</label>
                                            @endif
                                            @if($item->status==10)
                                                <a href="javascript:void(0)" class="badge badge-success"  wire:click="set_data({{$item->id}})" data-toggle="modal" data-target="#modal_end"><i class="fa fa-check-circle"></i> End</a>
                                            @endif
                                        </td> -->
                                        <td>{{$item->site_id}}</td>
                                        <td>{{$item->site_name}}</td>
                                        <!-- <td class="text-center">
                                            @if(isset($item->bukti_transfer))
                                                @foreach($item->bukti_transfer as $bukti_transfer)
                                                    <a href="{{asset($bukti_transfer->file)}}" title="Finance - Budget Successfully Transfered" target="_blank"><i class="fa fa-image"></i> </a> 
                                                @endforeach
                                            @endif
                                        </td> -->
                                        <td>{{isset($item->coordinator->name)?$item->coordinator->name : ''}}</td>
                                        <td>{{isset($item->field_team->name)?$item->field_team->name : ''}}</td>
                                        <td>
                                            @if(empty($item->extra_budget))
                                                -
                                            @else
                                                @if($item->extra_budget!="")
                                                    @if($item->status_extra_budget==1)
                                                        <span class="badge badge-warning">Waiting Approval</span>
                                                    @endif
                                                    @if($item->status_extra_budget==2)
                                                        {{format_idr($item->extra_budget)}}
                                                    @endif      
                                                @endif                  
                                            @endif
                                        </td>
                                        <td>
                                            @if(check_access('po-tracking-nonms.detail-photo'))
                                                @if($item->bast_status == '')
                                                    <a href="{{route('po-tracking-nonms.detailfoto',['id'=>$item->id]) }}" ><i class="fa fa-eye"></i> Detail Foto</a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            
                <hr />
                <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</a>
                @if($is_e2e and $data->status==1)
                    <a href="javascript:void(0)" class="btn btn-danger mx-2"><i class="fa fa-edit"></i> Revisi</a>
                    <a href="javascript:void(0)" wire:click="approve_bast" class="btn btn-success"><i class="fa fa-check-circle"></i> Approve</a>
                @endif
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
            </div>
        </div>
    </div>
</div>
