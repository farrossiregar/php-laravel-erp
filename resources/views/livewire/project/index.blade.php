@section('title', 'All User')
@section('parentPageTitle', 'Management User')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <select class="form-control" wire:model="user_access_id">
                        <option value="">--- User Access ---</option>
                        @foreach(\App\Models\UserAccess::all() as $i)
                        <option value="{{$i->id}}">{{$i->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <a href="{{route('users.insert')}}" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Add User</a>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>                                    
                                <th>Phone</th>                                    
                                <th>Email</th>                                    
                                <th>Address</th>
                                <th>Access</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    <span class="phone"><i class="zmdi zmdi-phone m-r-10"></i>{{$item->telepon}}</span>
                                </td> 
                                <td>
                                    <span class="phone">{{$item->email}}</span>
                                </td>                                   
                                <td>{{$item->address}}</td>
                                <td>{{isset($item->access->name)?$item->access->name:''}}</td>
                                <td>                                            
                                    <a href="#" class="text-danger" wire:click="delete({{$item->id}})"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>