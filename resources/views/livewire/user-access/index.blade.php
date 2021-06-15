@section('title', 'Position')
<div class="row clearfix">
    <div class="col-lg-7">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_insert" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Position</a>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Position</th>                                    
                                <th>Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td><a href="{{ route('user-access.edit',['id'=>$item->id]) }}">{{ $item->name }}</a></td>
                                <td>{{$item->description}}</td> 
                                <td>                            
                                    @if(check_access('user-acess.delete'))       
                                    <a href="javascript:void(0)" class="text-danger" wire:click="delete({{$item->id}})"><i class="fa fa-trash-o"></i></a>
                                    @endif
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
<!-- Modal -->
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:user-access.insert />
        </div>
    </div>
</div>
@push('after-scripts')
<script>
    Livewire.on('refresh-page',()=>{
        $(".modal").modal('hide');
    })
</script>
@endpush