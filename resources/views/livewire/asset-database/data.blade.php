<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

    
    <div class="col-md-2" wire:ignore>
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
    </div>

    <div class="col-md-1" wire:ignore>
        <select onclick="" class="form-control" wire:model="category">
            <option value=""> --- Category --- </option>
            <option value="1">Air Conditioner & Fan</option>
            <option value="2">Furniture & Fixture</option>
            <option value="3">Computer Equipment</option>
            <option value="4">Printer & Device</option>
        </select>
    </div>



    <div class="col-md-2" >
        <a href="javascript:;" wire:click="$emit('modalimportasset')" class="btn btn-info"><i class="fa fa-upload"></i> Upload Asset Database </a>
    </div> 
<!-- 
    <div class="col-md-2">
        <a href="javascript:;" wire:click="$emit('modaladdassetdatabase')" class="btn btn-info"><i class="fa fa-plus"></i> Request Asset Database </a>
    </div>  
     -->

     <div class="col-md-2">
        <a href="javascript:;" wire:click="$emit('modaladdassetdatabase')" class="btn btn-info"><i class="fa fa-plus"></i> Transfer Request </a>
    </div>  
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-bordered table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle"></th>
                        <th rowspan="2" class="align-middle">Date Create</th>
                        <th rowspan="2" class="align-middle">Asset Status</th>
                        <!-- <th rowspan="2" class="align-middle">Expired Date</th> -->
                        
                        <th colspan="6" class="text-center align-middle">1. Detail Asset</th>
                        <th colspan="3" class="text-center align-middle">2. Asset Request</th> 
                        <th colspan="3" class="text-center align-middle">3. Asset Transfer</th> 
                        
                    </tr>
                    <tr>
                        <th class="align-middle">1.1. Asset Name</th> 
                        <th class="align-middle">Asset Type</th> 
                        <th class="align-middle">Project</th> 
                        <th class="align-middle">Region - Sub Region</th> 
                        <th class="align-middle">Serial Number</th> 
                        <th class="align-middle">Expired Date</th> 
                        <!-- <th class="align-middle">Location</th>  -->

                        
                        <th class="align-middle">2.1. Request ID</th> 
                        <th class="align-middle">2.2. Req Status</th> 
                        <th class="align-middle">2.3. Dana</th> 
                        <!-- <th class="align-middle">PR No</th> 
                        <th class="align-middle">Dana Amount</th> 
                        <th class="align-middle">Dana From</th>  -->
                        

                        
                        <th class="align-middle">3.1. Transfer ID</th> 
                        <th class="align-middle">Asset PIC</th>
                        <th class="align-middle">3.2 Transfer Status</th>  
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        
                        <td>
                            @if($item->pic)
                                <label class="badge badge-info" data-toggle="tooltip" title="Used">Used</label>
                            @else
                                <label class="badge badge-success" data-toggle="tooltip" title="Idle">Idle</label>
                            @endif
                        </td>

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
                        </td> -->
                        
                        <td><a href="javascript:;" wire:click="$emit('modaldetailasset', '{{$item->id}}')"><i class="fa fa-edit"></i> {{ $item->asset_name }}</a></td>
                        <td>
                            @if($item->asset_type == '1')
                                Air Conditioner & Fan
                            @endif

                            @if($item->asset_type == '2')
                                Furniture & Fixture
                            @endif

                            @if($item->asset_type == '3')
                                Computer Equipment
                            @endif

                            @if($item->asset_type == '4')
                                Printer & Device
                            @endif

                        </td>
                        
                        
                        
                        <td>{{ \App\Models\ClientProject::where('id', $item->project)->first()->name }}</td>
                        <td>{{ $item->region }} - {{ $item->region }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->region }}</td>
                        <!-- <td><a href="javascript:;" wire:click="$emit('modaldetaillocation','{{ $item->id }}')">{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</a></td> -->
                        <!-- <td>{{ @\App\Models\DophomebaseMaster::where('id', $item->location)->first()->nama_dop }}</td> -->

                        
                        <td>
                            @if($item->request_id)
                                <a href="javascript:;" wire:click="$emit('modaldetailrequest', '{{$item->id}}')"><i class="fa fa-edit"></i> {{ $item->request_id }}  </a>
                            @else
                                <!-- if($item->status == '1') -->
                                    <a href="javascript:;" wire:click="$emit('modaldetailrequest', '{{$item->id}}')"><i class="fa fa-plus"></i></a>
                                <!-- endif -->
                            @endif
                        </td>
                        <!-- <td>{{ "Rp " . number_format($item->dana_amount,2,',','.') }}</td> -->
                        
                        <td>
                            <a href="javascript:;" wire:click="$emit('modalapprovalhistoryassetrequest','{{ $item->id }}')">
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Asset Request is Approved">Approved</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif
                            </a>

                            @if($item->status == '' || $item->status == 'null')
                                <!-- <label class="badge badge-warning" data-toggle="tooltip" title="Waiting to Approve">Waiting to Approve</label> -->
                                @if(check_access('asset-request.hq-ga'))
                                    @if($item->status == '')
                                    
                                        <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineassetrequest','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    @endif

                                @endif
                            @endif
                        </td>
                        <td>
                            <?php
                                if($item->dana_from == '1'){
                                    $danafrom = 'e-PL';
                                }else{
                                    $danafrom = 'Petty Cash';
                                }
                            ?>
                            @if($item->dana_from)
                                <a href="javascript:;" wire:click="$emit('modaldetaildana','{{ $item->id }}')"><i class="fa fa-edit"></i> {{ $danafrom }}</a>
                            @else
                                @if($item->status == '1')
                                    <a href="javascript:;" wire:click="$emit('modaldetaildana','{{ $item->id }}')"><i class="fa fa-plus"></i> </a>
                                @endif
                            @endif
                        </td>

                        
                        <!-- <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td> -->

                        
                        <td>
                            @if($item->pic)
                                <a href="javascript:;" wire:click="$emit('modaldetailtransfer', '{{$item->id}}')"><i class="fa fa-edit"></i> {{ $item->transfer_id }}  </a>
                            @else
                                <a href="javascript:;" wire:click="$emit('modaldetailtransfer', '{{$item->id}}' )"><i class="fa fa-plus"></i></a>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <b> {{ $item->pic }} </b> <br>
                            {{ $item->nik }}
                        </td>
                        <td>
                            <!-- <a href="javascript:;" wire:click="$emit('modalapprovalhistoryassettrans','{{ $item->id }}')"> -->
                            @if($item->status == '2')
                                <label class="badge badge-success" data-toggle="tooltip" title="Transfered">Transfered</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="{{$item->note}}">Decline</label>
                            @endif
                            <!-- </a> -->

                            @if($item->status == '1')
                                <!-- <label class="badge badge-success" data-toggle="tooltip" title="Asset Transfer Request is Approved">Approved</label> -->
                                @if(check_access('asset-transfer-request.ga'))
                                
                                        <a href="javascript:;" wire:click="$emit('modalapproveassettrans','{{ $item->id }}')"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                        <a href="javascript:;" wire:click="$emit('modaldeclineassettrans','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a>
                                    
                                   
                                @endif
                            @endif

                            

                            
                        </td>
                    </tr>
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>