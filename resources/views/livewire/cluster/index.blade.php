@section('title', __('Cluster'))
@section('parentPageTitle', 'Home')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2 px-0">
                    <select class="form-control" wire:model="region_id">
                        <option value=""> --- Region --- </option>
                        @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $region)
                        <option value="{{$region->id}}">{{$region->region}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    @if(check_access('cluster.insert'))
                    <a href="{{route('cluster.insert')}}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Cluster')}}</a>
                    @endif
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                               
                                <th>Region</th>          
                                <th>Cluster</th>          
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{isset($item->region->region)?$item->region->region:''}}</td>
                                <td>
                                    @if(check_access('cluster.edit'))
                                    <a href="{{route('cluster.edit',['id'=>$item->id])}}">{{$item->name}}</a>
                                    @else
                                    {{$item->name}}
                                    @endif
                                </td>
                                <td>
                                    @if(check_access('cluster.delete'))
                                    <a href="#" class="text-danger" wire:click="$emit('emit-delete',{{$item->id}})" data-toggle="modal" data-target="#modal_delete" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    @endif
                                </td>
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

@if(check_access('cluster.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:cluster.delete />
    </div>
</div>
@endif
@section('page-script')
@if(check_access('cluster.delete'))
Livewire.on('emit-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});
@endif
@endsection