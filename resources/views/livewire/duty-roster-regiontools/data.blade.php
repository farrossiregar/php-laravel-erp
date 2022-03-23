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
    
    <!-- if(check_access('accident-report.input')) -->
    <div class="col-md-2">
        <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-arrow-down"></i> Distribute Tools</a>
    </div>
    <!-- endif -->

    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Tools</th> 
                        <th>Qty</th> 
                        <th>Due Date</th> 
                        <th>FT PIC</th> 
                        <th>FT Region</th> 
                        <th>Condition</th> 
                        <th>Date Borrowed</th> 
                        <th>Date Return</th> 
                        <th>Status</th> 
                        <th>Action</th> 
                        
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->tools_name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->due_date }}</td>
                        <td>{{ $item->ft_pic }}</td>
                        <td>{{ $item->ft_region }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>{{ date_format(date_create($item->date_borrow), 'd M Y') }}</td>
                        <td>{{ date_format(date_create($item->date_return), 'd M Y') }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-info" data-toggle="tooltip" title="Borrowed">Borrowed</label>
                            @endif

                            @if($item->status == '0')
                                <label class="badge badge-primary" data-toggle="tooltip" title="Returned">Returned</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a> <!-- Return Tools from Field Team -->

                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-arrow-up"></i> Return</a> <!-- Return Tools from Field Team -->
                            
                            <!-- Approve Distribution to Field Team -->
                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>

                            <!-- Approve Return Tools to Logistic -->
                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                            <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>