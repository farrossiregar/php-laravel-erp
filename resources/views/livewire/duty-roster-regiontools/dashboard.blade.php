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
        <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Region Tools')}}</a>
    </div>
    @endif
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Tools</th> 
                        <th>Qty</th> 
                        <th>Brand</th> 
                        <th>Condition</th> 
                        <th>Serial Number</th> 
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $key + 1 }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>