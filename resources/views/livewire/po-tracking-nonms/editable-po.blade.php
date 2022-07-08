<div  x-data="{ insert:false }">
    <div class="form-group" x-show="insert" @click.away="insert = false">
        @if($field=='gr_date')
            <input type="date" @keyup.escape="insert = false" placeholder="{{$field}}" class="form-control" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="value" />
        @else
            <input type="text" @keyup.escape="insert = false" placeholder="{{$field}}" class="form-control" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="value" />
        @endif
        <a href="javascript:void(0)" @click="insert = false" wire:click="save"><i class="fa fa-save text-success"></i></a>
        <a href="javascript:void(0)" @click="insert = false"><i class="fa fa-close text-danger"></i></a>
    </div>
    <a href="javascript:;" x-show="insert==false" @click="insert = true">
        @if(is_int($value))
            {{format_idr($value)}}
        @else
            {!!$value?$value:'<i>empty</i>'!!}
        @endif
    </a>
    <div wire:loading wire:loading.target="save">
        <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div> 
</div>
