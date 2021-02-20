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
                                <th>Action</th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>
                                    {{ $item->upload_by }}
                                </td>
                                <td>{{ date_format($item->created_at, 'd-m-Y') }}</td>
                                <td></td>
                                <td></td>
                                
                                
                                <!-- <td><?php if($item->status == '1'){echo '<div class="btn btn-success">Approved</div>'; }else{ echo '<div class="btn btn-warning">Progress</div>'; } ?></td> -->
                                <td>
                                    <?php 
                                        if($item->status == '0'){
                                    ?>
                                        <a href="{{route('site-tracking.edit',['id'=>$item->id])}}"><button type="button" class="btn btn-warning">Waiting Approval</button></a>
                                    <?php 
                                        }elseif($item->status == '1'){
                                    ?>
                                        <a href="{{route('site-tracking.edit',['id'=>$item->id])}}"><button type="button" class="btn btn-success">Approved</button></a>
                                    <?php 
                                        }else{
                                    ?>
                                        <a href=""><button type="button" class="btn btn-danger">Revisi</button></a>
                                    <?php                                            
                                        }
                                    ?>
                                    
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


