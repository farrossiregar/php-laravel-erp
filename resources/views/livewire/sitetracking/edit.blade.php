@section('title', __('Site Tracking Data Detail'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                
                
            </div>
            <div class="body pt-0">

            
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Collection</th>  
                                <th>NO PO</th>  
                                <th>Item Number</th>  
                                <th>DATE PO RELEASED</th>  
                                <th>Pic RPM</th>  
                                <th>Pic SM</th>  
                                <th>Type</th>  
                                <th>Item Description</th>  
                                <th>Period</th>  
                                <th>Region</th>  
                                <th>Region1</th>  
                                <th>Project</th>  
                                <th>Penalty</th>  
                                <th>Last Status</th>  
                                <th>QTY PO</th>  
                                <th>Actual QTY</th>  
                                <th>NO BAST</th>  
                                <th>DATE BAST APPROVAL</th>  
                                <th>DATE BAST APPROVAL BY SYSTEM</th>  
                                <th>Date GR Req</th>  
                                <th>No GR</th>  
                                <th>Date GR Share</th>  
                                <th>NO INV</th>  
                                <th>Payment Date</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{ $k+1 }}</td>
                                <td>{{ $item->collection }}</td>
                                <td>{{ $item->no_po }}</td>
                                <td>{{ $item->item_number }}</td>
                                <td>{{ $item->date_po_release }}</td>
                                <td>{{ $item->pic_rpm }}</td>
                                <td>{{ $item->pic_sm }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td>{{ $item->period }}</td>
                                <td>{{ $item->region }}</td>
                                <td>{{ $item->region1 }}</td>
                                <td>{{ $item->project }}</td>
                                <td>{{ $item->penalty }}</td>
                                <td>{{ $item->last_status }}</td>
                                <td>{{ $item->remark }}</td>
                                <td>{{ $item->qty_po }}</td>
                                <td>{{ $item->actual_qty }}</td>
                                <td>{{ $item->no_bast }}</td>
                                <td>{{ $item->date_bast_approval }}</td>
                                <td>{{ $item->date_bast_approval_by_system }}</td>
                                <td>{{ $item->date_gr_req }}</td>
                                <td>{{ $item->no_gr }}</td>
                                <td>{{ $item->date_gr_share }}</td>
                                <td>{{ $item->no_invoice }}</td>
                                <td>{{ $item->inv_date }}</td>
                                <td>{{ $item->payment_date }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                
            </div>


                
            </div>
        </div>
    </div>
</div>

