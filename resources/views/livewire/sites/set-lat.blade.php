<div>
    @if($edit)
        <input type="text" class="form-control" wire:model="lat" wire:keydown.escape="$set('edit',false)" style="width:150px;" wire:keydown.enter="save" />
    @else
        <a href="javascript:;" wire:click="$set('edit',true)">{{$data->lat?$data->lat:'.....'}}</a>
    @endif
</div>
