<div>
    <div wire:loading.remove>
        <a href="javascript:;" class="badge badge-warning" wire:click="revisi"><i class="fa fa-warning"></i> Revise</a>
        <a href="javascript:;" class="badge badge-success" wire:click="verify"><i class="fa fa-check"></i> Verify</a>
    </div>
    <div wire:loading>
        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
        <span class="sr-only">{{ __('Loading...') }}</span>
    </div>
</div>
