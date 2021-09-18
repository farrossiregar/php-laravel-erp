<div class="row">
    <!-- <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div> -->

    
    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="nama_dop" placeholder="Nama DOP" />
    </div>
    
    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="project" placeholder="Project" />
    </div>

    <div class="col-md-1">
        <input type="text" class="form-control" wire:model="region" placeholder="Region" />
    </div>
                        

    <div class="col-md-2">
        <a wire:click="save()" href="" title="Add" class="btn btn-primary"><i class="fa fa-download"></i> {{__('Export Duty roster')}}</a>
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->

<!-- 
    @if(check_access('duty-roster-dophomebase.importhrd'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Duty roster')}}</a>
    </div>
    
    @endif

    @if(check_access('duty-roster-dophomebase.importsm'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-dutyroster-importdutyroster" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Duty roster')}}</a>
    </div>
    
    @endif -->
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Remarks</th>
                        <th>Nama DOP</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Alamat</th>
                        <th>Long</th>
                        <th>Lat</th>
                        <th>Pemilik DOP</th>
                        <th>Telepon Pemilik</th>
                        <th>Opex Region/GA</th>
                        <th>Type Homebase/DOP</th>
                        <th>Expired</th>
                        <th>Budget</th>

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if(check_access('duty-roster-dophomebase.audit'))
                            <input type="checkbox"  wire:click="checkdata({{ $item->id }})" wire:model="data_id.{{ $item->id }}" />
                            @else
                                @if($item->remarks == '1')
                                    <a href="javascript:;" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                @else
                                    <a href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i></a>
                                @endif
                            @endif
                        </td>
                        <td>{{ $item->nama_dop }}</td>
                        <td>{{ $item->project }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->long }}</td>
                        <td>{{ $item->lat }}</td>
                        <td>{{ $item->pemilik_dop  }}</td>
                        <td>{{ $item->telepon_pemilik }}</td>
                        <td>{{ $item->opex_region_ga }}</td>
                        <td>{{ $item->type_homebase_dop }}</td>
                        <td>
                            
                            <?php  
                                if(substr($item->expired, 0, 11) > date('Y-m-d')){
                                    echo '<label class="badge badge-danger" data-toggle="tooltip" title="Expired"><b>'.date_format(date_create($item->expired), 'd M Y').'</b></label>';
                                }

                                if(substr($item->expired, 0, 11) < date('Y-m-d')){
                                    echo '<label class="badge badge-success" data-toggle="tooltip" title="In Progress"><b>'.date_format(date_create($item->expired), 'd M Y').'</b></label>';
                                }
                            ?>
                            
                        </td>
                        <td><?php echo 'Rp.'. @format_idr($item->budget); ?></td>
  
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>