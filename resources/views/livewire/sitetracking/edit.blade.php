@section('title', __('Site Tracking Data Detail'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                
                
            </div>
            <div class="body pt-0">

                <div class="row">
                    <div class="col-md-2">
                        <b><h4>Original</h4></b> 
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Collection</th>  
                                <th>{{__('NO PO')}}</th>  
                                <!-- <th>NO PO</th> -->
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
                                <th>Remark</th>  
                                <th>QTY PO</th>  
                                <th>Actual QTY</th>  
                                <th>NO BAST</th>  
                                <th>DATE BAST APPROVAL</th>  
                                <th>DATE BAST APPROVAL BY SYSTEM</th>  
                                <th>Date GR Req</th>  
                                <th>No GR</th>  
                                <th>Date GR Share</th>  
                                <th>NO INV</th>  
                                <th>INV Date</th>  
                                <th>Payment Date</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{ $k+1 }}</td>
                                <td>{{ $item->collection }}</td>
                                <td> 
                                    <?php 
                                        if(check_duplicate_sitelist($item->no_po) == 'ada'){ 
                                            echo '<a href="#" id="nopo" onclick="modalduplicate('.$item->no_po.')" title="Upload" ><b style="color:red;">'.$item->no_po.'</b></a>'; 
                                        }else{ 
                                            echo $item->no_po; 
                                        } 
                                    ?>
                                </td>
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

            
            @if(check_sitelist_temp($id_site_master))
                                                  
            <div class="body pt-0">

                <div class="row">
                    <div class="col-md-2">
                        <b><h4>Duplicate </h4></b> 
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Collection</th>  
                                <th>{{__('NO PO')}}</th>  
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
                                <th>Remark</th>  
                                <th>QTY PO</th>  
                                <th>Actual QTY</th>  
                                <th>NO BAST</th>  
                                <th>DATE BAST APPROVAL</th>  
                                <th>DATE BAST APPROVAL BY SYSTEM</th>  
                                <th>Date GR Req</th>  
                                <th>No GR</th>  
                                <th>Date GR Share</th>  
                                <th>NO INV</th>  
                                <th>INV Date</th>  
                                <th>Payment Date</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(check_sitelist_temp($id_site_master) as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{ $k+1 }}</td>
                                <td>{{ $item->collection }}</td>
                                <td> 
                                    <?php 
                                        if(check_duplicate_sitelist($item->no_po) == 'ada'){ 
                                            echo '<a href="#" id="nopo" onclick="modalduplicate('.$item->no_po.')" title="Upload" ><b style="color:red;">'.$item->no_po.'</b></a>'; 
                                        }else{ 
                                            echo $item->no_po; 
                                        } 
                                    ?>
                                </td>
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
            
            @endif
            
            <?php

                $user = \Auth::user();
                // $access = App\Models\UserAccess::where('id', $user->user_access_id)->first();
                // print_r($access);
                // echo $user->user_access_id;
                // print_r($user);
                if($user->id == '4'){
            ?>
            <div class="body pt-0">
                <div class="row">
                   <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" <?php if($status[0]['status'] == '1'){ echo "checked";} ?>>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Approve
                            </label>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" <?php if($status[0]['status'] == '2'){ echo "checked";} ?>>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Reject
                            </label>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div href="#" class="btn btn-primary" onclick="approvesitelisttracking()"><i class="fa fa-search"></i>Submit</div>
                    </div>
                </div>
            </div>   
            <?php
                }
            ?>                                     
        </div>
    </div>
</div>



<div class="modal fade bd-example-modal-lg" id="modal-preview-duplicate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:sitetracking.duplicateupdate />

        </div>
    </div>
</div>


<script>
    function modalduplicate($nopo){
        
        $("#modal-preview-duplicate").modal('show');
        $('.title_no_po').html('Preview Duplicate ' + $nopo);
        $('#deleteoriginal').attr('onclick','deleteoriginal(' + $nopo + ')');
        $('#deleteduplicate').attr('onclick','deleteduplicate(' + $nopo + ')');
        var no_po = $nopo;
        $.ajax({
            url: "{{ route('site-tracking.cekdataOri') }}", 
            type: "POST",
            data: {'no_po' : no_po, '_token' : $("meta[name='csrf-token']").attr('content')},
            dataType: 'json',
            success: function(result){
                console.log(result[0]['collection']);
                $('#ori_collection').html(result[0]['collection']);
                $('#ori_no_po').html(result[0]['no_po']);
                $('#ori_item_number').html(result[0]['item_number']);
                $('#ori_date_po_release').html(result[0]['date_po_release']);
                $('#ori_pic_rpm').html(result[0]['pic_rpm']);
                $('#ori_pic_sm').html(result[0]['pic_sm']);
                $('#ori_type').html(result[0]['type']);
                $('#ori_item_description').html(result[0]['item_description']);
                $('#ori_period').html(result[0]['period']);
                $('#ori_region').html(result[0]['region']);
                $('#ori_region1').html(result[0]['region1']);
                $('#ori_project').html(result[0]['project']);
                $('#ori_penalty').html(result[0]['penalty']);
                $('#ori_last_status').html(result[0]['last_status']);
                $('#ori_remark').html(result[0]['remark']);
                $('#ori_qty_po').html(result[0]['qty_po']);
                $('#ori_actual_qty').html(result[0]['actual_qty']);
                $('#ori_date_bast_approval').html(result[0]['date_bast_approval']);
                $('#ori_date_bast_approval_by_system').html(result[0]['date_bast_approval_by_system']);
                $('#ori_date_gr_req').html(result[0]['date_gr_req']);
                $('#ori_no_gr').html(result[0]['no_gr']);
                $('#ori_no_inv').html(result[0]['no_inv']);
                $('#ori_inv_date').html(result[0]['inv_date']);
                $('#ori_payment_date').html(result[0]['payment_date']);
            }
        });

        $.ajax({
            url: "{{ route('site-tracking.cekdataTemp') }}", 
            type: "POST",
            data: {'no_po' : no_po, '_token' : $("meta[name='csrf-token']").attr('content')},
            dataType: 'json',
            success: function(result){
                console.log(result[0]['collection']);
                $('#temp_collection').html(result[0]['collection']);
                $('#temp_no_po').html(result[0]['no_po']);
                $('#temp_item_number').html(result[0]['item_number']);
                $('#temp_date_po_release').html(result[0]['date_po_release']);
                $('#temp_pic_rpm').html(result[0]['pic_rpm']);
                $('#temp_pic_sm').html(result[0]['pic_sm']);
                $('#temp_type').html(result[0]['type']);
                $('#temp_item_description').html(result[0]['item_description']);
                $('#temp_period').html(result[0]['period']);
                $('#temp_region').html(result[0]['region']);
                $('#temp_region1').html(result[0]['region1']);
                $('#temp_project').html(result[0]['project']);
                $('#temp_penalty').html(result[0]['penalty']);
                $('#temp_last_status').html(result[0]['last_status']);
                $('#temp_remark').html(result[0]['remark']);
                $('#temp_qty_po').html(result[0]['qty_po']);
                $('#temp_actual_qty').html(result[0]['actual_qty']);
                $('#temp_date_bast_approval').html(result[0]['date_bast_approval']);
                $('#temp_date_bast_approval_by_system').html(result[0]['date_bast_approval_by_system']);
                $('#temp_date_gr_req').html(result[0]['date_gr_req']);
                $('#temp_no_gr').html(result[0]['no_gr']);
                $('#temp_no_inv').html(result[0]['no_inv']);
                $('#temp_inv_date').html(result[0]['inv_date']);
                $('#temp_payment_date').html(result[0]['payment_date']);
            }
        });

    }


    function approvesitelisttracking(){
        var status = $("input[name='flexRadioDefault']:checked").val();
        // alert(status);
        var id = '<?php echo $id_site_master;?>';
        $.ajax({
            url: "{{ route('site-tracking.approvesitelisttracking') }}", 
            type: "POST",
            data: {'id' : id, 'status' : status, '_token' : $("meta[name='csrf-token']").attr('content')},
            dataType: 'json',
            success: function(result){
                // console.log(result);
                location.reload();
            }
        });
    }
</script>

@section('page-script')
Livewire.on('preview-duplicate',()=>{
    $("#modal-preview-duplicate").modal('hide');
});

@endsection
