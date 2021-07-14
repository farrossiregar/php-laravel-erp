
<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-download"></i> Download Report Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label>Month From</label>
                    <select onclick="" class="form-control" name="month_from" id="month_from" wire:model="month_from" >
                        <option value=""> -- Month From --</option>
                        <option  value="01">January</option>
                        <option  value="02">February</option>
                        <option  value="03">March</option>
                        <option  value="04">April</option>
                        <option  value="05">May</option>
                        <option  value="06">June</option>
                        <option  value="07">July</option>
                        <option  value="08">August</option>
                        <option  value="09">September</option>
                        <option  value="10">October</option>
                        <option  value="11">November</option>
                        <option  value="12">December</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Year From</label>
                    <select onclick="" class="form-control" name="year_from" id="year_from" wire:model="year_from">
                        <option value=""> -- Year From --</option>
                        <?php
                            for($i = date('Y'); $i >= 2010; $i--){
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <label>Month To</label>
                    <select onclick="" class="form-control"  name="month_to" id="month_to" wire:model="month_to" >
                        <option value=""> -- Month To --</option>
                        <option  value="01">January</option>
                        <option  value="02">February</option>
                        <option  value="03">March</option>
                        <option  value="04">April</option>
                        <option  value="05">May</option>
                        <option  value="06">June</option>
                        <option  value="07">July</option>
                        <option  value="08">August</option>
                        <option  value="09">September</option>
                        <option  value="10">October</option>
                        <option  value="11">November</option>
                        <option  value="12">December</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Year To</label>
                    <select onclick="" class="form-control" name="year_to" id="year_to" wire:model="year_to">
                        <option value=""> -- Year To --</option>
                        <?php
                            for($i = date('Y'); $i >= 2010; $i--){
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <!-- <div href="{{ route('dana-stpl.download-report') }}" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</div> -->
        
        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
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


<script>
    // Livewire.on('modalinputpono',(data)=>{
    //     $("modal-datastpl-inputdana").modal('show');
    // });
    function sm_id(){
        var project = $('#project').val();
        project = project.split(" | ");
        $('#project_code').val(project[0]);
        $('#project_code').attr("placeholder", project[0]);
        $('#sm').val(project[1]);
        // $('#smid').val(project[2]);
        $('#region').val(project[3]);
        console.log(project);
    }


</script>