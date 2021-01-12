@section('title', 'All Project')
@section('parentPageTitle', 'Project')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <a href="{{route('project.insert')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Project</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>                                    
                                <th>Project Code</th>                                    
                                <th>Project Name</th>                                    
                                <th>PM / GA</th>
                                <th>OSM</th>
                                <th>OMG</th>
                                <th>PMG</th>
                                <th>General Manager</th>
                                <th>Region Code</th>
                                <th>Project Type</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->project_code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{isset($item->pm->name)?$item->pm->name:''}}</td>
                                <td>{{isset($item->osm->name)?$item->osm->name:''}}</td>
                                <td>{{isset($item->omg->name)?$item->omg->name:''}}</td>
                                <td>{{isset($item->pmg->name)?$item->pmg->name:''}}</td>
                                <td>{{isset($item->general_manager->name)?$item->general_manager->name:''}}</td>
                                <td>{{isset($item->region->region_code)?$item->region->region_code:''}}</td>
                                <td>{{isset($item->project_type)?$item->project_type:''}}</td>
                                <td>{{$item->status}}</td>
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