@section('title', __('PO Tracking Non MS STP Detail'))
@section('parentPageTitle', 'Home Detail')


<?php
    $user = \Auth::user();
?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>Auto Generated Esar</h5></b> 
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                    <br>
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <div class="col-md-2">
                        <select class="form-control" name="status" wire:model="status">
                            <option value=""> --- Status --- </option>
                            <option value="1">Completed</option>
                            <option value="">Waiting Approval</option>
                        </select>
                    </div>

                </table>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>Material</th>                               
                                    <th>Item Code</th>                               
                                    <th>Quantity</th>                               
                                    <th>Unit</th>                               
                                    <th>Price</th>                               
                                    <th>Input Price</th>                               
                                    <th>Profit (%)</th>                               
                                    <th>Total Price</th>                                     
                                </tr>
                                @foreach($data as $key => $item)
                                <?php
                                    $key = $key+1;
                                ?>
                                <tr>
                                    <td>{{ $key }}</td>                               
                                    <td>{{ $item->material }}</td>                               
                                    <td>{{ $item->item_code }}</td>                               
                                    <td>{{ $item->qty }}</td>                               
                                    <td>{{ $item->unit }}</td>                               
                                    <td>Rp {{ $item->price }}</td>                               
                                    <td>
                                        <?php
                                            if($item->input_price == null || $item->input_price == ''){
                                        ?>
                                            <a href="javascript:;" wire:click="$emit('modalinputstpprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Price')}}</a>
                                        <?php
                                            }else{
                                        ?>
                                            <a href="javascript:;" wire:click="$emit('modalinputstpprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                        <?php
                                            }
                                        ?>
                                        
                                        Rp {{ $item->input_price }}
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
                                    <td>{{ $item->total_price }}</td>             
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- TOTAL -->
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>Total BOQ / STP Price</th>                               
                                    <th>Total Price After Input</th>                               
                                    <th>Total Profit After Input (%)</th>         
                                </tr>

                                <tr>
                                    <td>Rp {{ $total_before[0]->price }}</td>                               
                                    <td>Rp {{ $total_after[0]->input_price }}</td>                               
                                    <td>{{ $total_profit }} %</td>    
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <?php
                    if($user->user_access_id != '222'){ // PMG
                ?>
                <br><br><br>
                <div class="row">
                   <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="1" >
                            <label class="form-check-label" for="flexRadioDefault1">
                                Approve
                            </label>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="2" >
                            <label class="form-check-label" for="flexRadioDefault2">
                                Revise
                            </label>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- <div href="#" class="btn btn-primary" onclick="approvesitelisttracking()"><i class="fa fa-search"></i>Submit</div> -->
                        <div href="#" class="btn btn-primary"><i class="fa fa-search"></i>Submit</div>
                    </div>
                </div>
                <?php
                    }
                ?>

                <!--    Submit to Finance or PMG    -->
                <?php
                    if($user->user_access_id != '222'){ // Regional
                ?>
                <br><br>
                <div class="row">
                    <div class="col-md-12">
                        <div href="#" class="btn btn-primary"><i class="fa fa-search"></i>Submit</div>
                    </div>
                </div>
                <?php
                    }
                ?>
                <!--    End Submit to Finance or PMG    -->



                <br><br><br>
                <div class="row">
                    <div class="col-md-12">
                        <div href="#" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Return</div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>



<!--    MODAL INPUT PRICE STP      -->
<div class="modal fade" id="modal-pononmsstp-priceinput" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.inputprice />
        </div>
    </div>
</div>


<!--    END MODAL INPUT PRICE STP        -->

@push('after-scripts')
<script>
    Livewire.on('modalinputstpprice',(data)=>{
        console.log(data);
        $("#modal-pononmsstp-priceinput").modal('show');
    });
</script>
@endpush






