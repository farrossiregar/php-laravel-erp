<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title title_no_po" id="exampleModalLabel"><i class="fa fa-eye"></i> Preview Duplicate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header row">
                        <div class="col-md-2">
                            <b>Original</b> 
                        </div>
                        <div class="col-md-3">
                            <a href="#" id="deleteoriginal"  class="text-danger" data-toggle="modal" title="Delete"><div class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</div></a>
                            <!-- <a href="#" id="deleteoriginal" class="text-danger" wire:click="$emit('emit-delete',$item->id)" data-toggle="modal" data-target="#modal_keep" title="Delete"><div class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</div></a> -->
                            <!-- <button type="submit" class="btn btn-danger"><i class="fa fa-upload"></i> Delete</button> -->
                        </div>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                                             
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
                                    <tr>
                                        
                                        <td id="ori_collection">  </td>
                                        <td id="ori_no_po"></td>
                                        <td id="ori_item_number"></td>
                                        <td id="ori_date_po_release"></td>
                                        <td id="ori_pic_rpm"></td>
                                        <td id="ori_pic_sm"></td>
                                        <td id="ori_type"></td>
                                        <td id="ori_item_description"></td>
                                        <td id="ori_period"></td>
                                        <td id="ori_region"></td>
                                        <td id="ori_region1"></td>
                                        <td id="ori_project"></td>
                                        <td id="ori_penalty"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        <td id="ori_last_status"></td>
                                        
                                    </tr>
                                </tbody>
                                <br>
                            </table>
                        </div>
                        <br />
                    </div>
                </div>
                <br>


                <div class="card">
                    <div class="header row">
                        <div class="col-md-2">
                            <b>Duplicate</b> 
                        </div>
                        <div class="col-md-3">
                            <a href="#" id="deleteduplicate" onclick="deleteduplicate('4523974444');" class="text-danger" data-toggle="modal" title="Delete"><div class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</div></a>
                        </div>
                    </div>
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                                             
                                        <th>Collection</th>  
                                        <th><i class="fa fa-plus"></i> {{__('NO PO')}}</th>  
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
                                    <tr>
                                        <td id="temp_collection">  </td>
                                        <td id="temp_no_po"></td>
                                        <td id="temp_item_number"></td>
                                        <td id="temp_date_po_release"></td>
                                        <td id="temp_pic_rpm"></td>
                                        <td id="temp_pic_sm"></td>
                                        <td id="temp_type"></td>
                                        <td id="temp_item_description"></td>
                                        <td id="temp_period"></td>
                                        <td id="temp_region"></td>
                                        <td id="temp_region1"></td>
                                        <td id="temp_project"></td>
                                        <td id="temp_penalty"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        <td id="temp_last_status"></td>
                                        
                                    </tr>
                                </tbody>
                                <br>
                            </table>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</form>


<div class="modal-footer">
    <!-- <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button> -->
</div>
<div wire:loading>
    <div class="page-loader-wrapper" style="display:block">
        <div class="loader" style="display:block">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
            <p>Please wait...</p>
        </div>
    </div>
</div>



<!-- 
<div class="modal fade" id="modal_keep" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
    </div>
</div>

<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        
    </div>
</div> -->


<script>
    // $("#deleteoriginal").click(function(){
    function deleteoriginal($no_po){
        var no_po = $no_po;
        $.ajax({
            url: "{{ route('site-tracking.deleteoriginal') }}", 
            type: "POST",
            data: {'no_po' : no_po, '_token' : $("meta[name='csrf-token']").attr('content')},
            dataType: 'json',
            success: function(result){
                console.log(result);
                location.reload();
            }
        });
        
    }
    // });

    function deleteduplicate($no_po){
        var no_po = $no_po;
        $.ajax({
            url: "{{ route('site-tracking.deleteduplicate') }}", 
            type: "POST",
            data: {'no_po' : no_po, '_token' : $("meta[name='csrf-token']").attr('content')},
            dataType: 'json',
            success: function(result){
                console.log(result);
                location.reload();
            }
        });
        
    }
</script>

@section('page-script')
@if(check_access('cluster.delete'))
Livewire.on('emit-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});
@endif
@endsection