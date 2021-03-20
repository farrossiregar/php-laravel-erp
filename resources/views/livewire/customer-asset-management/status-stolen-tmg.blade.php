<div>
    <div wire:loading.remove>
        @if($confirm_stolen)
            <a href="javascript:;" class="btn btn-warning btn-sm" wire:click="revisi"><i class="fa fa-warning"></i> Revise</a>
            <a href="javascript:;" class="btn btn-success btn-sm" wire:click="verify"><i class="fa fa-check"></i> Verify</a>
            <a href="javascript:;" class="text-danger" wire:click="$set('confirm_stolen',false)"><i class="fa fa-times"></i></a>
        @else
            <a href="javascript:;" class="badge badge-danger" wire:click="$set('confirm_stolen',true)"><i class="fa fa-warning"></i> STOLEN</a>
        @endif
    </div>
    <div wire:loading>
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </div>
</div>
