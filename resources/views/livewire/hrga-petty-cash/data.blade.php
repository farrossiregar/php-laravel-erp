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

    <div class="col-md-2" wire:ignore>
        <select onclick="" class="form-control" wire:model="category">
            <option value=""> --- Category --- </option>
            <option value="1">Air Conditioner & Fan</option>
            <option value="2">Furniture & Fixture</option>
            <option value="3">Computer Equipment</option>
            <option value="4">Printer & Device</option>
        </select>
    </div>


<!--     
    <div class="col-md-1" style="margin-right: 40px;">
        <a href="javascript:;" wire:click="$emit('modalimportasset')" class="btn btn-info"><i class="fa fa-upload"></i> Upload Asset Database </a>
    </div>   -->
    <!-- <div class="col-md-2" style="margin-left: 20px;">
        <a href="javascript:;" wire:click="$emit('modaladdassetdatabase')" class="btn btn-info"><i class="fa fa-plus"></i> Add Asset Database </a>
    </div>  
     -->
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Status</th>
                        <th class="align-middle">Action</th>
                        <th class="align-middle">Request From</th>
                        <th class="align-middle">Dana Request</th> 
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date_format(date_create($item->date_create), 'd M Y') }}</td>
                        <td>
                            @if($item->status != '' || $item->status != NULL)
                                <label class="badge badge-info" data-toggle="tooltip" title="Dana Request">Dana Request</label>
                            @else
                                
                                <label class="badge badge-success" data-toggle="tooltip" title="Dana Release">Dana Release</label>
                            @endif
                        </td>
                        <td>
                            @if($item->status == '')
                                
                                <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])" class="btn btn-info"><i class="fa fa-check "></i> Release Dana</a>
                                
                                <!-- <a href="javascript:;" wire:click="$emit('modalapproveassetrequest',['{{ $item->id }}', '1'])"><i class="fa fa-check " style="color: #22af46;"></i></a>
                                <a href="javascript:;" wire:click="$emit('modaldeclineassetrequest','{{ $item->id }}')"><i class="fa fa-close " style="color: #de4848;"></i></a> -->
                            @endif
                        </td>
                        <td>{{ $item->request_from }}</td>
                        <td>{{ "Rp " . number_format($item->dana_release,2,',','.') }}</td>
                        <!-- <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
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
                        <td>{{ $item->pic }}</td>
                        <td>{{ $item->pic_telephone }}</td>
                        <td>{{ $item->pic_bank_account }}</td>                     
                        

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
                        
                       
                        <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-eye"></i></a></td> -->
                    </tr>
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>