<div>
    <div x-data="{ insert:false }">
        <span x-show="insert==false">
            <a href="javascript:void(0)" @click="insert = true">{{get_setting_sow($data)}}</a>
        </span>
        <span x-show="insert" @click.away="insert = false">
            <input type="number" class="form-control" style="width:80px;" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="sow" />
        </span>
    </div>
    <span wire:loading>
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </span>
</div>
