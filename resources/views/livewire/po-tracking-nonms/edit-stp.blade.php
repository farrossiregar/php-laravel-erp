@section('title', __('PO Tracking Non MS STP Detail'))
@section('parentPageTitle', 'Home Detail')

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
                                    <th>%</th>                               
                                    <th>Total Price</th>                               
                                    <th>Action</th>           
                                </tr>
                                @foreach($data as $key => $item)
                                <?php
                                    $key = $key+1;
                                ?>
                                <tr>
                                    <td>{{ $key + 1 }}</td>                               
                                    <td>{{ $item->material }}</td>                               
                                    <td>{{ $item->item_code }}</td>                               
                                    <td>{{ $item->qty }}</td>                               
                                    <td>{{ $item->unit }}</td>                               
                                    <td>{{ $item->price }}</td>                               
                                    <td>{{ $item->input_price }}</td>                               
                                    <td>%</td>                               
                                    <td>{{ $item->total_price }}</td>                               
                                    <td>
                                        <a href="javascript:;" wire:click="$emit('modalinputstpprice','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Price')}}</a>
                                    </td>          
                                </tr>
                                @endforeach
                            </table>
                        </div>
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
            <livewire:po-tracking.importesar />
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






