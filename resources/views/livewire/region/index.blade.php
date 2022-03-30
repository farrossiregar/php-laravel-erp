@section('title', 'Region')
@section('parentPageTitle', 'Data Master')

<div class="row clearfix">
    <div class="col-lg-6">
        <div class="card">
            <div class="header row">
                <div class="col-md-4">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2 pl-0">
                    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"><i class="fa fa-plus"></i> Region</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr x-data="{insert:false}">
                                    <td style="width: 50px;">{{$k+1}}</td>
                                    <td>
                                        <a href="javascript:;" wire:click="$emit('emit-edit',{{$item->id}})" data-toggle="modal" data-target="#modal_edit" >{{$item->region}}</a>
                                        <div x-show="insert" @click.away="insert = false">
                                            <input type="text" wire:keydown.enter="insert_sub_region({{$item->id}})" wire:model="name_insert_sub_region" x-on:keydown.enter="insert = false" class="form-control" />
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" title="add sub region under {{$item->region}}" @click="insert = true"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:;" wire:click="$emit('emit-delete',{{$item->id}})" data-target="#modal_delete" data-toggle="modal" class="text-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @foreach(\App\Models\SubRegion::where('region_id',$item->id)->get() as $key_sub => $sub)
                                    <tr>
                                        <td></td>
                                        <td>
                                            @livewire('region.editable',['data'=>$sub],key($sub->id))
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" wire:click="delete_sub_region({{$sub->id}})" class="text-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
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

<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.delete />
    </div>
</div>

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.edit />
    </div>
</div>

<div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <livewire:region.insert />
    </div>
</div>

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