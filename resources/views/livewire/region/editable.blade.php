<div>
    @if($insert)
        <div class="form-group" wire:loading.remove wire:target="save">
            <input type="text" wire:model="field" class="form-control" wire:keydown.enter="save" />
            <a href="javascript:void(0)" wire:click="save" class="text-info"><i class="fa fa-save"></i></a>
            <a href="javascript:void(0)" wire:click="$set('insert',false)" class="text-danger"><i class="fa fa-times"></i></a>
        </div>
    @else
        <a href="javascript:;" wire:click="set_insert">{{$data->name}}</a>
    @endif
    <div wire:loading wire:target="save">
        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div> 
</div>
