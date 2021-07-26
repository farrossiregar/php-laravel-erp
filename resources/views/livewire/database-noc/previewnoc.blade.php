<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Preview Database NOC</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User ID</th> 
                        <th>NIK</th> 
                        <th>Contract Start</th> 
                        <th>Contract End</th> 
                        <th>Resign Date</th> 
                        <th>Resignation Reason</th> 
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div> -->
</form>
