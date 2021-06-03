<div>
    @if($edit)
        <select class="form-control" wire:model="field_team_id" wire:keydown.escape="$set('edit',false)" wire:change="save">
            <option value=""> --- Field Team --- </option>
            @foreach(get_user_from_access('po-tracking-nonms.create-bast-form') as $user)
            <option value="{{$user->employee_id}}">{{$user->name}}</option>
            @endforeach
        </select>
    @else
        <a href="javascript:;" wire:click="$set('edit',true)">{!!isset($data->field_team->name)? $data->field_team->name:'<i style="border-bottom:2px dotted #007bff">Empty</i>'!!}</a>
    @endif
</div>
