@section('title', 'Region')
@section('parentPageTitle', 'Data Master')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2 pl-0">
                    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"><i class="fa fa-plus"></i> Region</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Region Code</th>                                    
                                <th>Region</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>
                                    @if(check_access('region.edit'))
                                        <a href="javascript:;" wire:click="$emit('emit-edit',{{$item->id}})" data-target="#modal_edit" data-toggle="modal">{{$item->region_code}}</a>
                                    @else
                                        {{$item->region_code}}
                                    @endif
                                </td>
                                <td>{{$item->region}}</td>
                                <td>
                                    @if(check_access('region.delete'))
                                    <a href="javascript:;" wire:click="$emit('emit-delete',{{$item->id}})" data-target="#modal_delete" data-toggle="modal" class="text-danger"><i class="fa fa-trash"></i></a>
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

@if(check_access('region.delete'))
<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.delete />
    </div>
</div>
@endif

@if(check_access('region.edit'))
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.edit />
    </div>
</div>
@endif

@if(check_access('region.insert'))
<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.insert />
    </div>
</div>
@endif
@section('page-script')
Livewire.on('emit-delete-hide',()=>{
    $("#modal_delete").modal('hide');
});
Livewire.on('emit-edit-hide',()=>{
    $("#modal_edit").modal('hide');
});
Livewire.on('emit-insert-hide',()=>{
    $("#modal_insert").modal('hide');
});
@endsection