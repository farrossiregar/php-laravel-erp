<div  x-data="{ insert:false }">
    <div class="form-group" x-show="insert" @click.away="insert = false">
        @if($field=='gr_date' || $field=='invoice_date' || $field=='po_date' || $field=='date_of_payment')
            <input type="date" @keyup.escape="insert = false" placeholder="{{$field}}" class="form-control" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="value" />
        @else
            <input type="text" @keyup.escape="insert = false" placeholder="{{$field}}" class="form-control" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="value" />
        @endif
    </div>
    <a href="javascript:;" class="editable" x-show="insert==false" @click="insert = true">
        @if(is_int($value))
            {{format_idr($value)}}
        @else
            {!!$value?$value:'<i style="color:red">Empty</i>'!!}
        @endif
    </a>
    <div wire:loading wire:loading.target="save">
        <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div> 
</div>