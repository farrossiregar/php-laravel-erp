<div class="row">
    <div class="col-md-2">
        <select onclick="" class="form-control" required wire:model="employee_id">
            <option value=""> --- Employee / Field Team --- </option>
            @foreach($employees as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control" placeholder="Keyword" wire:model="keyword" />
    </div>
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
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
                        <td>{{isset($item->employee->name) ? $item->employee->name : ''}}</td>
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