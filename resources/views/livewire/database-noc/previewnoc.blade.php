<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <?php
            
            $monthyear = explode('-', $selected_id);
            
            $data = \App\Models\Employee::whereYear('resign_date', $year)->whereMonth('resign_date', $month)->get();
        ?>
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Preview Database NOC <?php echo date('F', mktime(0, 0, 0, $month, 10)).' '.$year; ?></h5>
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
                        <th>Position</th> 
                        <th>NIK</th> 
                        <th>Contract Start</th> 
                        <th>Contract End</th> 
                        <th>Resign Date</th> 
                        <th>Resignation Reason</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php

                        for($i = 0; $i < count($data); $i++){
                            $position = \App\Models\UserAccess::where('id', $data[$i]->user_access_id)->first();
                    ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo @$position->name; ?></td>
                        <td><?php echo $data[$i]->nik; ?></td>
                        <td><label class="badge badge-success" data-toggle="tooltip"><?php echo date_format(date_create($data[$i]->join_date), 'd M Y'); ?></label></td>
                        <td><label class="badge badge-danger" data-toggle="tooltip"><?php echo date_format(date_create($data[$i]->contract_end), 'd M Y'); ?></label></td>
                        <td><label class="badge badge-danger" data-toggle="tooltip"><?php echo date_format(date_create($data[$i]->resign_date), 'd M Y'); ?></label></td>
                        <td><?php echo $data[$i]->resignation_reason; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
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
