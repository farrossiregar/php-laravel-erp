<div>
    <div x-data="{ insert:false }">
        <span x-show="insert==false">
            <a href="javascript:void(0)" class="border-bottom" @click="insert = true">{{$sow}}</a>
        </span>
        <span x-show="insert" @click.away="insert = false">
            <input type="number" class="form-control" @keyup.escape="insert = false"  style="width:80px;margin:auto" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="sow" />
        </span>
    </div>
    <span wire:loading>
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </span>
</div>
