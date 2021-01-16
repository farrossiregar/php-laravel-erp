@section('title', __('Company'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                @if(check_access('company.insert'))
                <div class="col-md-1">
                    <a href="{{route('company.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Company')}}</a>
                </div>
                @endif
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Name</th>          
                                <th>Telephone</th>          
                                <th>Address</th>          
                                <th>Code</th>          
                                <th>Website</th>          
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>
                                    @if(check_access('company.edit'))
                                    <a href="{{route('company.edit',['id'=>$item->id])}}">{{$item->name}}</a>
                                    @else
                                    {{$item->name}}
                                    @endif
                                </td>
                                <td>{{$item->telepon}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->code}}</td>
                                <td>{{$item->website}}</td>
                                <td><a href="{{ route('company.delete', $item->id) }}" class="btn btn-danger">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>