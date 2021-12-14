<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                
                <div class="col-md-1">
                    
                    <a href="#" data-toggle="modal" data-target="#modal-sitetracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Site Tracking')}}</a>
                    
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>    
                                <th>Upload By</th>                            
                                <th>Date Upload</th>          
                                <th>Approved By</th>          
                                <th>Date Approve</th>          
                                <th></th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td><a href="{{route('site-tracking.edit',['id'=>$item->id])}}">{{ $item->upload_by }}</a></td>
                                <td>{{ date_format($item->created_at, 'd-m-Y') }}</td>
                                <td>{{isset($item->approved->name) ? $item->approved->name : ''}}</td>
                                <td>{{$item->approved_date ? date('d-M-Y',strtotime($item->approved_date)) : '' }}</td>
                                <td>
                                    @if($item->status == 0)
                                        <a href="{{route('site-tracking.edit',['id'=>$item->id])}}" class="badge badge-warning">Waiting Approval</a>
                                    @elseif($item->status == 1)
                                        <a href="{{route('site-tracking.edit',['id'=>$item->id])}}" class="badge badge-success">Approved</a>
                                    @elseif($item->status == 2)
                                        <a href="{{route('site-tracking.edit',['id'=>$item->id])}}" class="badge badge-danger">Rejected</a>
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
</div>



<div class="modal fade" id="modal-sitetracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:sitetracking.insert />

        </div>
    </div>
</div>



@section('page-script')
Livewire.on('sitetracking-upload',()=>{
    $("#modal-sitetracking-upload").modal('hide');
});

@endsection


