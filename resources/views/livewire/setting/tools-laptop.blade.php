<div class="col-md-4">
    <h6>Laptop Type / Merk</h6>
    <div class="table-responsive">
        <table class="table table-striped m-b-0 c_list">
            <thead style="white-space: nowrap;">
                @foreach($laptop as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                    </tr>
                @endforeach
            </thead>
        </table>
        <div x-data="{ insert:false }">
            <div class="form-group" x-show="insert" @click.away="insert = false">
                <input type="text" @keyup.escape="insert = false" placeholder="Merk Laptop..." class="form-control" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="name" />
            </div>
            <a href="javascript:;" @click="insert = true"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</div>