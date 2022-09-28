@section('title', __('PO Tracking MS'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
                </div>
                <div class="col-md-10">
                    @if($is_e2e)
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-potrackingms-importhuawei" class="btn btn-info"><i class="fa fa-upload"></i> Upload</a>
                    @endif
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body">    
                <div class="table-responsive" style="min-height:200px;">
                    <table class="table table-striped m-b-0 c_list table-nowrap-th">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>PO No</th>    
                                <th>Region</th>    
                                <th>PO Period</th>    
                                <th>Type PO</th>    
                                <th>PO Category</th>    
                                <th  class="text-right">Total Amount</th>    
                                <th class="text-center">Deduction (%)</th>    
                                <th class="text-center">EHS Deduction / Other Deduction</th>    
                                <th class="text-center">Total Amount After Deduction</th>    
                                <th>Scar No</th>    
                                <!-- <th>PDS</th> -->
                                <th>Regional Reconciliation</th>
                                <th>BOS Approval</th>
                                <th>Customer GM Approval</th>
                                <th>Customer GH Approval</th>
                                <th>Customer OD (Operation Director) Approval</th>
                                <th>Verification</th>
                                <th class="text-center">VAT (%) </th>
                                <th class="text-right">Total Price</th>
                                <th class="text-center">WHT (%)</th>
                                <th class="text-right">Invoice Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><a href="{{route('po-tracking-ms.huawei.detail',$item->po_no)}}">{{ $item->po_no }}</a></td>
                                    <td>{{ $item->region }}</td>
                                    <td>{{ $item->po_period }}</td>
                                    <td>{{ $item->type_po }}</td>
                                    <td>{{ $item->po_category }}</td>
                                    <td class="text-right">{{ format_idr($item->details_sum_total_amount) }}</td>
                                    <td class="text-center">{{ $item->details_sum_deduction >0 ? format_idr(abs($item->details_sum_deduction / $item->details_count),2) : '0' }}</td>
                                    <td class="text-center">
                                        {{format_idr($item->details_sum_ehs_other_deduction)}}
                                    </td>
                                    <td class="text-center">{{format_idr($item->details_sum_rp_deduction,2)}}</td>
                                    <td>{{$item->scar_no}}</td>
                                    <td class="text-center">{{@abs($item->count_regional_recon_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{@abs($item->count_bos_approved_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{@abs($item->count_customer_gm_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{@abs($item->count_customer_gh_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{@abs($item->count_customer_od_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{@abs($item->count_verification_count/$item->details_count*100)}}%</td>
                                    <td class="text-center">{{ $item->details_sum_vat >0 ? abs($item->details_sum_vat / $item->details_count) : '0' }}</td></td>
                                    <td class="text-right">{{format_idr($item->details_sum_total_amount+$item->details_sum_ehs_other_deduction+$item->details_sum_rp_deduction)}}</td>
                                    <td class="text-center">{{ $item->details_sum_wht >0 ? abs($item->details_sum_wht / $item->details_count) : '0' }}</td>
                                    <td class="text-right">{{format_idr($item->details_sum_invoice_amount)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingms-importhuawei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-ms.importhuawei />
        </div>
    </div>
</div>