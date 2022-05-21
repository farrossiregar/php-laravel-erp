<div class="row">
    
    <div class="col-md-1" style="margin: 0 10px;">
        <a href="javascript:;" wire:click="$emit('modaladdassetrequest')" class="btn btn-info"><i class="fa fa-plus"></i> Add Request Detail Option </a>
    </div>  
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>

                    <tr>
                        <th class="align-middle">No</th>
                        <th class="align-middle">Kind of Request</th>
                        <th class="align-middle">Request Detail Option</th>
                        
                    </tr>
                   
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->request_type }}</td>
                        <td>{{ $item->request_detail_option }}</td>
                        
                    </tr>
                    
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>