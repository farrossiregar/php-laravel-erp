<form wire:submit.prevent="update">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Action Point</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body table-responsive">
        <table class="table table-bordered table-nowrap">
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
            <tr>
                <td colspan="2">
                    <label class="fancy-radio">
                        <input type="radio" wire:model="type" value="1" required data-parsley-errors-container="#error-radio">
                        <span><i></i> Repetitive</span>
                    </label>
                    <label class="fancy-radio">
                        <input type="radio" wire:model="type" value="2">
                        <span><i></i>Non Repetitive</span>
                    </label>
                    @error('type')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                    @enderror
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <textarea type="text" class="form-control"  wire:model="action_point" placeholder="Action Point" ></textarea>
                    @error('action_point')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                    @enderror
                </td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-save"></i> Update</button>
    </div>
</form>