@section('title', __('PO Tracking Non MS Ericson Detail'))
@section('parentPageTitle', 'Home Detail')


<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <b><h5>PO Tracking Non MS Ericson</h5></b> 
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped m-b-0 c_list">
                                            <tr>
                                                <th>Total Ericson Price</th>                               
                                                <th>Total Price After Input</th>                                                          
                                                <th>Total Profit After Input (%)</th>         
                                            </tr>

                                            <tr>
                                                <td>Rp {{ format_idr($total_before[0]->price) }}</td>                               
                                                <td>Rp {{ format_idr($total_after[0]->input_price) }}</td>    
                                                <td>
                                                    <?php
                                                        if($total_profit >= 30){
                                                            $color = 'success';
                                                        }else{
                                                            $color = 'danger';
                                                        }
                                                    ?>
                                                    <div class="btn btn-<?php echo $color; ?>">{{ $total_profit }}%</div>
                                                </td>       
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                </div>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>Project Code</th>                               
                                    <th>Item Code</th>                               
                                    <th>Site Id</th>                               
                                    <th>Site Name</th>                               
                                    <th>Item Description</th>                               
                                    <th>UOM</th>                               
                                    <th>Quantity</th>                               
                                    <th>Supplier</th>                               
                                    <th>Region</th>                               
                                    <th>Remark</th>                               
                                    <th>Reff</th>                                
                                    <th>Price</th>     
                                    <th>Total Price</th>                              
                                    <th>Input Price</th>    
                                    <th>Total After Input</th>                               
                                    <th>Profit (%)</th>                               
                                                                     
                                </tr>
                                @foreach($data as $key => $item)
                                <?php
                                    $key = $key+1;
                                ?>
                                <tr>
                                    <td>{{ $key }}</td>                               
                                    <td>{{ $item->project }}</td>                               
                                    <td>{{ $item->item_code }}</td>                               
                                    <td>{{ $item->site_id }}</td>                               
                                    <td>{{ $item->site_name }}</td>                               
                                    <td>{{ $item->item_description }}</td>                               
                                    <td>{{ $item->uom }}</td>                               
                                    <td>{{ $item->qty }}</td>                               
                                    <td>{{ $item->supplier }}</td>                               
                                    <td>{{ $item->region }}</td>                               
                                    <td>{{ $item->remark }}</td>                               
                                    <td>{{ $item->reff }}</td>                               
                                    <td>Rp {{ format_idr($item->price) }}</td>   
                                    <td>
                                        <?php
                                            echo 'Rp '. format_idr($item->qty * $item->price);
                                        ?>
                                    </td>                             
                                    <td>
                                    
                                        @if(check_access('po-tracking-nonms.input-price'))
                                            @if($item->input_price == null || $item->input_price == '')
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Price')}}</a>
                                            @else
                                                <a href="javascript:;" wire:click="$emit('modalinputboqprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-inputprice" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                            @endif
                                        @endif
                                        
                                        Rp {{ format_idr($item->input_price) }}
                                    </td>  
                                    <td>
                                        <?php
                                            echo 'Rp '. format_idr($item->qty * $item->input_price);
                                        ?>
                                    </td>                                                             
                                    <td>
                                        <?php
                                            if($item->profit >= 30){
                                                $color = 'success';
                                            }else{
                                                $color = 'danger';
                                            }
                                        ?>
                                        <div class="btn btn-<?php echo $color; ?>">{{ $item->profit }}%</div>
                                    </td>                                   
                                                             
                                                              
                                    <!-- <td>{{ $item->total_price }}</td>              -->
                                                
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TOTAL -->
                <br><br>
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>Total Ericson Price</th>                               
                                    <th>Total Price After Input</th>                               
                                    <th>Extra Budget</th>                               
                                    <th>Total Profit After Input (%)</th>         
                                </tr>

                                <tr>
                                    <td>Rp {{ format_idr($total_before[0]->price) }}</td>                               
                                    <td>Rp {{ format_idr($total_after[0]->input_price) }}</td>    
                                    <td>Rp <?php echo format_idr(($total_before[0]->price - $total_after[0]->input_price)); ?></td>                           
                                    <td>
                                        <?php
                                            if($total_profit >= 30){
                                                $color = 'success';
                                            }else{
                                                $color = 'danger';
                                            }
                                        ?>
                                        <div class="btn btn-<?php echo $color; ?>">{{ $total_profit }}%</div>
                                    </td>       
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> -->
                
                <br><br><br>
                <!--    Approve BOQ by PMG   -->
                
                @if(check_access('po-tracking-nonms.approve-pmg'))
                    @if($status[0]->status == '3')
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" wire:click="$emit('modalapprovepononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-approve" title="Upload" class="btn btn-primary"> {{__('Approve')}}</a>
                            </div>
                        </div>
                    @else
                        @if($status[0]->status == '1')
                            <div class="btn btn-success"> Approved </div>
                        @endif

                        @if($status[0]->status == '2')
                            <div class="btn btn-danger"> Revised </div>
                        @endif

                        @if($status[0]->status == '0')
                            <div class="btn btn-warning"> Waiting to Submitted </div>
                        @endif
                    @endif
                @endif

                <!--    End Approve BOQ by PMG   -->

                
                <!--    Submit to Finance or PMG by Regional   -->
                
                @if(check_access('po-tracking-nonms.submit-doc'))
                    @if($status[0]->status == '1')

                    <div class="row">
                            <div class="col-md-1">
                                <div class="btn btn-success"> Approved </div>
                            </div>
                            <div class="col-md-4">
                                <a href="javascript:;" wire:click="$emit('modalsubmitfinreg','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submitfinreg" title="Upload" class="btn btn-primary"> {{__('Submit To Finance Regional')}}</a>
                            </div>
                    </div>                    
                    @endif

                    @if($status[0]->status == '2')
                        <div class="btn btn-danger"> Revised </div>
                    @endif


                    @if($status[0]->status == '0' || $status[0]->status == '' || $status[0]->status == null || $status[0]->status == '3' || $status[0]->status == '2')
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="javascript:;" wire:click="$emit('modalsubmitdocpononms','{{$id_master}}')"  data-toggle="modal" data-target="#modal-potrackingnonms-submit" title="Upload" class="btn btn-primary"> {{__('Submit')}}</a>
                                <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingnonms-submit" title="Submit" class="btn btn-primary"> {{__('Submit')}}</a> -->
                            </div>
                        </div>
                    @endif
                @endif
                <!--    End Submit to Finance or PMG by Regional    -->


                
                
                @if(check_access('po-tracking-nonms.status-doc'))
                    @if($status[0]->status == '3' || $status[0]->status == '0' || $status[0]->status == '' || $status[0]->status == null)
                        <div class="btn btn-warning"> Waiting Approval</div>
                    @endif
                @endif
                




                <br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{route('po-tracking-nonms.index')}}">
                            <div class="btn btn-danger"><i class="fa fa-arrow-left"></i> Return</div>
                        </a>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>



<!--    MODAL INPUT PRICE BOQ      -->
<div class="modal fade" id="modal-pononmsboq-priceinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.inputpriceboq />
        </div>
    </div>
</div>


<!--    END MODAL INPUT PRICE BOQ        -->


<!--    MODAL SUBMIT DOCUMENT      -->
<div class="modal fade" id="modal-potrackingnonms-submit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.submitdoc />
        </div>
    </div>
</div>


<!--    END MODAL MODAL SUBMIT DOCUMENT        -->


<!--    MODAL SUBMIT TO FINANCE REGIONAL      -->
<div class="modal fade" id="modal-potrackingnonms-submitfinreg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.submitfinreg />
        </div>
    </div>
</div>

<!--    END MODAL SUBMIT TO FINANCE REGIONAL        -->


<!--    MODAL APPROVE DOCUMENT PMG      -->
<div class="modal fade" id="modal-potrackingnonms-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.approvedocpmg />
        </div>
    </div>
</div>


<!--    END MODAL APPROVE DOCUMENT PMG        -->

@push('after-scripts')
<script>
    Livewire.on('modalinputboqprice',(data)=>{
        console.log(data);
        $("#modal-pononmsboq-priceinput").modal('show');
    });

    Livewire.on('modalsubmitdocpononms',(data)=>{
        $("#modal-potrackingnonms-submit").modal('show');
    });


    Livewire.on('modalsubmitfinreg',(data)=>{
        $("#modal-potrackingnonms-submitfinreg").modal('show');
    });

    Livewire.on('modalapprovepononms',(data)=>{
        $("#modal-potrackingnonms-approve").modal('show');
    });
</script>
@endpush






