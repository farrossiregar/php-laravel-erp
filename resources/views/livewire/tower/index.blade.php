@section('title', 'Tower')
<div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-6">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-4">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_insert" class="btn btn-primary"><i class="fa fa-plus"></i> Tower</a>
                    <label wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </label>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>                                    
                                <th>Tower</th>                                    
                                <th>Site ID</th>                                    
                                <th>Site Name</th>    
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num=$data->firstItem())
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$num}}</td>
                                <td>{{$item->name}}</td> 
                                <td>{{isset($item->site->site_id)?$item->site->site_id:''}}</td>
                                <td>{{isset($item->site->name)?$item->site->name:''}}</td>
                                <td> <a href="javascript:;" wire:click="delete({{$item->id}})" class="text-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @php($num++)
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
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:tower.insert />
        </div>
    </div>
</div>
@push('after-scripts')
<script>
    Livewire.on('refresh-page',()=>{
        $('.modal').modal('hide');
    });
</script>
@endpush