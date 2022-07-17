<div>
    @if($is_edit)
        <input type="text" class="form-control" wire:model="value" wire:keydown.enter="save" placeholder="{{$field}}"  />
        <a href="javascript:void(0)" wire:click="$set('is_edit',false)"><i class="fa fa-close text-danger"></i></a>
        <a href="javascript:void(0)" wire:click="save"><i class="fa fa-save text-success"></i></a>
    @else
        @if(is_numeric($value))
            <a href="javascript:void(0)" class="editable" wire:click="$set('is_edit',true)">{!!$value?format_idr($value):'<span class="text-danger">edit</span>'!!}</a>
        @else
            <a href="javascript:void(0)" class="editable" wire:click="$set('is_edit',true)">{!!$value?$value:'<span class="text-danger">edit</span>'!!}</a>
        @endif
    @endif
</div>
