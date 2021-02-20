<form wire:submit.prevent="update">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Edit Data Critical Case</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
       
        <table class="table table-hover table-bordered">
            <tr>
                <th>PIC</th>
                <td>{{ $pic }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <th>Activity Handling</th>
                <td>{{ $activity_handling }}</td>
            </tr>
            <tr>
                <th>Region</th>
                <td>{{ $region }}</td>
            </tr>
            <tr>
                <th>Last Update</th>
                <td>{{ $last_update }}</td>
            </tr>
        </table>
        
        
        <div class="form-group">
            <label>Action Point (Repetitive / Non Repetitive)</label>
            <textarea type="text" class="form-control"  wire:model="action_point" ></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Update</button>
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