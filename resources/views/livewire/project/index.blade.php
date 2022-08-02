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
                                <th>Project Code</th>                                    
                                <th>Project Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td style="width: 50px;">{{$k+1}}</td>
                                    <td>{{$item->code}}</td>
                                    <td><a href="javascript:void(0)" wire:click="set_id({{$item->id}})" data-toggle="modal" data-target="#modal_edit">{{$item->name}}</a></td>
                                    <td><a href="javascript:void(0)" wire:click="delete({{$item->id}})"><i class="fa fa-trash text-danger"></i></a></td>
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

    <div class="modal fade" wire:ignore.self id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <form wire:submit.prevent="update">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit"></i> Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Project Code</label>
                        <input type="text" class="form-control" wire:model="code" />
                        @error('code')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Project Name</label>
                        <input type="text" class="form-control" wire:model="name" />
                        @error('name')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-save"></i> Save</button>
                </div>
                <div wire:loading wire:target="save,file_invoice,file">
                    <div class="page-loader-wrapper" style="display:block">
                        <div class="loader" style="display:block">
                            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                            <p>Please wait...</p>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

</div>