<div class="row">
    <div class="col-md-1">
        <input type="date" class="form-control" wire:model="date" />
    </div>
    <div class="col-md-1">
        <select onclick="" class="form-control" required wire:model="employee_id">
            <option value=""> --- Field Team --- </option>
            @foreach(\App\Models\Employee::orderBy('id', 'asc')->get() as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" placeholder="Site ID" wire:model="site_id" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" placeholder="Klasifikasi Insiden" wire:model="klasifikasi_insiden" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" placeholder="Jenis Insiden" wire:model="jenis_insiden" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" placeholder="Kronologis" wire:model="kronologis" />
    </div>
    <div class="col-md-1">
        <input type="text" class="form-control" placeholder="Nik dan Nama" wire:model="nik_and_nama" />
    </div>
    
    <!-- <div class="col-md-2">
        <a href="#" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Dana STPL')}}</a>
    </div> -->
    @if(check_access('accident-report.input'))
    <div class="col-md-2">
        <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Accident Report')}}</a>
    </div>
    @endif
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Site ID</th> 
                        <th>Employee ID</th> 
                        <th>Date</th>  
                        <th>Klasifikasi Insiden</th> 
                        <th>Jenis Insiden</th> 
                        <th>Kronologis</th> 
                        <th>Nik dan Nama</th> 
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><a href="javascript:;" wire:click="$emit('modalpreview','{{ $item->id }}')" >{{ $item->site_id }}</a></td>
                        <td>
                            <?php
                                $employee_name = \App\Models\Employee::where('id', $item->employee_id)->first();
                                // print_r($employee_name);
                                echo @$employee_name->name;
                            ?>
                        </td>
                        <td>{{ date_format(date_create($item->date), 'd M Y') }}</td>
                        <td>{{ $item->klasifikasi_insiden }}</td>
                        <td>{{ $item->jenis_insiden }}</td>
                        <td>{{ $item->rincian_kronologis }}</td>
                        <td>{{ $item->nik_and_nama }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>