<div>
    @if($is_edit)
        <input type="text" class="form-control" wire:model="value" wire:keydown.enter="save" placeholder="{{$field}}"  />
        <a href="javascript:void(0)" wire:click="$set('is_edit',false)"><i class="fa fa-close text-danger"></i></a>
        <a href="javascript:void(0)" wire:click="save"><i class="fa fa-save text-success"></i></a>
    @else
        @if($field=='amount')
            <a href="javascript:void(0)" wire:click="$set('is_edit',true)">{!!$value?format_idr($value):'<i><u>edit</u></i>'!!}</a>
        @else
            <a href="javascript:void(0)" wire:click="$set('is_edit',true)">{!!$value?$value:'<i><u>edit</u></i>'!!}</a>
        @endif
    @endif
</div>
