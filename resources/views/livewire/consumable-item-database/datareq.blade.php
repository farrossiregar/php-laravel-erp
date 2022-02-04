<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

    
    <!-- <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="project">
            <option value=""> --- Project --- </option>
            @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get() as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2" wire:ignore>
        <select class="form-control" style="width:100%;" wire:model="region">
            <option value=""> --- Region --- </option>
            @foreach(\App\Models\Region::orderBy('id', 'desc')
                                ->get() as $item)
                <option value="{{$item->region_code}}">{{$item->region_code}}</option>
            @endforeach
        </select>
    </div> -->

    <div class="col-md-2" wire:ignore>
        <select onclick="" class="form-control" wire:model="category">
            <option value=""> --- Category Item --- </option>
            <option value="1">Stationary</option>
            <option value="2">Pantry Supplies</option>
            <option value="3">Electrical Supplies</option>
            <option value="4">Office Supplies</option>
        </select>
    </div>


    
    <div class="col-md-1" style="margin-right: 40px;">
        <a href="javascript:;" wire:click="$emit('modaladdconsumableitemdatabase')" class="btn btn-info"><i class="fa fa-plus"></i> Consumable Item Request </a>
    </div>  
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Status</th>
                        
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Item Category</th>
                        <th class="align-middle">Item Name</th>
                        <th class="align-middle">Req Amount</th>
                        <th class="align-middle">Price (Unit)</th>
                        <th class="align-middle">Approval Req</th>
                        <th class="align-middle">Approved Amount</th>
                        <th class="align-middle">Total Price</th>
                        <th class="align-middle">Approval Dana</th>
                        <th class="align-middle">Dana Release</th>
                        <th class="align-middle">Settlement</th>
                        <th class="align-middle">Unused Amount</th>
                        <th class="align-middle">Dana Return</th>
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <a href="javascript:;" wire:click="$emit('modalapprovalhistoryassetrequest','{{ $item->id }}')">
                                @if($item->status == '2')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Dana is Approved">Dana Approved</label>
                                @endif

                                @if($item->status == '1')
                                    <label class="badge badge-success" data-toggle="tooltip" title="Item Request is Approved">Request Approved</label>
                                @endif

                                @if($item->status == '0')
                                    <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                                @endif
                            </a>

                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label>
                            @endif
                        </td>
                       
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            @if($item->item_category == '1')
                                Stationary
                            @endif

                            @if($item->item_category == '2')
                                Pantry Supplies
                            @endif

                            @if($item->item_category == '3')
                                Electric Supplies
                            @endif

                            @if($item->item_category == '4')
                                Office Supplies
                            @endif

                        </td>
                        <td>{{ $item->item_name }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>Rp, {{ number_format($item->price,2,",",".") }}</td>
                        <td>
                            @if(check_access('asset-request.hq-ga'))
                                @if($item->status == '')
                                   
                                    <a href="javascript:;" wire:click="$emit('modalapproveconsumableitemdatabase',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                    <a href="javascript:;" wire:click="$emit('modaldeclineconsumableitemdatabase','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                @endif

                            @endif
                        </td>
                        <td>
                            @if(!$item->approved_amount)
                                <a href="javascript:;" wire:click="$emit('modalinputapprovedamount', '{{ $item->id }}')"><i class="fa fa-plus" style="color: #17a2b8;"></i></a>
                            @else
                                {{ $item->approved_amount }} <a href="javascript:;" wire:click="$emit('modalinputapprovedamount', '{{ $item->id }}')"><i class="fa fa-edit" style="color: #f3ad06;"></i></a>
                            @endif
                            
                        </td>
                        
                        <td>Rp, {{ number_format($item->total_price,2,",",".") }}</td>
                        <td>
                            @if(check_access('asset-request.hq-ga'))
                                @if($item->status == '1' && $item->total_price != '')
                                   
                                   <a href="javascript:;" wire:click="$emit('modalapproveconsumableitemdatabase',['{{ $item->id }}', '2'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                   <a href="javascript:;" wire:click="$emit('modaldeclineconsumableitemdatabase','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                               @endif

                            @endif
                        </td>
                        <td>Rp, {{ number_format($item->release_dana_pettycash,2,",",".") }}</td>
                        <td>
                            @if($item->status == '2')
                                @if($item->settlement)
                                    <a href="<?php echo asset('storage/Consumable_Item_Database/'.$item->settlement) ?>" target="_blank"><i class="fa fa-download"></i> </a>
                                @else
                                    <a href="javascript:;" wire:click="$emit('modalimportsettlement','{{ $item->id }}')"><i class="fa fa-plus" style="color: #17a2b8;"></i></a>
                                @endif
                            @endif
                        </td>
                        <td>{{ $item->unused_amount }}</td>
                        <td>Rp, {{ number_format($item->return_dana_pettycash,2,",",".") }}</td>
                        
                        <!-- <td>
                            <?php
                                $diff    = abs(strtotime(date('Y-m-d H:i:s')) - strtotime(date_format(date_create($item->expired_date), 'Y-m-d H:i:s')));
                                $years   = floor($diff / (365*60*60*24)); 
                                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                                $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                        
                                if($days >= 1){
                                    echo '<b><p style="color: red;">'.date_format(date_create($item->expired_date), 'd M Y').'</p></b>';
                                }else{
                                    echo '<b>'.date_format(date_create($item->expired_date), 'd M Y').'</b>';
                                }
                            ?>
                            
                        </td>
                        
                        <td><a href="javascript:;" wire:click="$emit('modaldetaillocation','{{ $item->id }}')">{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</a></td>
                       
                        <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td> -->
                    </tr>
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>