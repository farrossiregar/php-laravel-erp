@section('title', 'Position')
<div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <h6>Project</h6>
                </div>
                <div class="col-md-5">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_insert_project" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Position</a>
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
                            @foreach($projects as $k => $item)
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
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <h6>Non Project</h6>
                </div>
                <div class="col-md-5">
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
                            @foreach($non_projects as $k => $item)
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

    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal_insert_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="save_project">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> {{ __('Position') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>{{ __('Name') }}</label>
                            <input type="text" class="form-control" wire:model="name_project" >
                            @error('name_project')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Description') }}</label>
                            <input type="text" class="form-control"  wire:model="description_project" >
                            @error('description_project')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-save"></i> Submit</button>
                    </div>
                </form>

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