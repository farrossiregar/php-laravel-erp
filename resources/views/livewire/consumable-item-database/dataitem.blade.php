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


    
    <div class="col-md-1" style="margin-right: 40px;">
        <a href="javascript:;" wire:click="$emit('modalimportasset')" class="btn btn-info"><i class="fa fa-upload"></i> Consumable Item Database </a>
    </div>  
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Action</th>
                        <th class="align-middle">Date Create</th>
                        <th class="align-middle">Item Category</th>
                        <th class="align-middle">Item Name</th>
                        <th class="align-middle">Stock</th>
                        <th class="align-middle">Price (unit)</th>
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="javascript:;" wire:click="$emit('modaldetailimage','{{ $item->id }}')"><i class="fa fa-edit"></i></a></td>
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
                        <td>{{ $item->stock }}</td>
                        <td>Rp, {{ number_format($item->price,2,",",".") }}</td>
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