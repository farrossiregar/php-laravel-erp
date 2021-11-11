<div>
    <div x-data="{ insert:false }">
        <span x-show="insert==false">
            {{get_setting_sow($data)}}
        </span>
        <span x-show="insert">
            <input type="text" class="form-control" style="width:100px;" wire:keydown.enter="save" x-on:keydown.enter="insert = false" x- wire:model="sow" />
        </span>
        <a href="javascript:void(0)" @click="insert = true"><i class="fa fa-edit"></i></a>
    </div>
</div>
