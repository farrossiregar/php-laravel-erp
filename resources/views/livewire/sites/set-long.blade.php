<div>
    @if($edit)
        <input type="text" class="form-control" wire:model="long" wire:keydown.escape="$set('edit',false)" style="width:150px;" wire:keydown.enter="save" />
    @else
        <a href="javascript:;" wire:click="$set('edit',true)">{{$data->long?$data->long:'.....'}}</a>
    @endif
</div>
