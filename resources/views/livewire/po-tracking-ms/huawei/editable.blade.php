<div>
    @if($insert)
        <div wire:loading.remove wire:target="save">
            <input type="text" class="form-control" wire:model="value" style="min-width:100px;" />
            <a href="javascript:void(0)" class="text-info" wire:click="save"><i class="fa fa-save"></i></a>
            <a href="javascript:void(0)" class="text-danger" wire:click="$set('insert',false)"><i class="fa fa-close"></i></a>
        </div>
    @else
        <a href="javascript:void(0)" class="editable" wire:click="$set('insert',true)" title="Edit">
            @if($field=='deduction' || $field=='rp_deduction')
                {{format_idr($value,2)}}
            @else
                {!!$value?$value : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'!!}
            @endif
        </a>
        
    @endif
    <span wire:loading wire:target="insert,save">
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </span>
</div>