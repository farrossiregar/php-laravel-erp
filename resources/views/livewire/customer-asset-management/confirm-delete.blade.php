<form wire:submit.prevent="delete">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> {{ __('Upload Data') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-hover table-bordered">
            <tr>
                <th>Uploaded</th>
                <td>{{$data->created_at}}</td>
            </tr>
            <tr>
                <th>Tower Index</th>
                <td>{{isset($data->tower->name) ? $data->tower->name : ''}}</td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger close-modal"><i class="fa fa-trash"></i> Delete</button>
    </div>
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>{{ __('Please wait...') }}</p>
            </div>
        </div>
    </div>
</form>
