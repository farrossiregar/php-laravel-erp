@section('title', __('Site Tracking Data Master'))
@section('parentPageTitle', 'Home')

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
                                <th>Date Upload</th>          
                                <th>Upload By</th>          
                                <th>Status</th>          
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{ date_format($item->created_at, 'd-m-Y') }}</td>
                                <td>
                                    {{ $item->upload_by }}
                                </td>
                                <td><a href="{{route('site-tracking.edit',['id'=>$item->id])}}"><?php if($item->status == '1'){echo '<div class="btn btn-success">Approved</div>'; }else{ echo '<div class="btn btn-warning">Progress</div>'; } ?></a></td>
                                <td><button type="button" class="btn btn-primary">Approve</button></td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                
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


