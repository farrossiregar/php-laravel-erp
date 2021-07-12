<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Dana STPL</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label>Project</label>
                    <select wire:click="$emit('getproject')"  class="form-control" name="project" id="project" >
                        <option value=""> -- Project --</option>
                        <?php
                            $data = \App\Models\Project::select('projects.*', 'region_code as region_name', 'employees.name as sm_name', 'employees.id as smid')
                                    ->join('epl.region as region', 'region.id', 'projects.region_id')
                                    ->leftjoin('pmt.employees as employees', 'employees.id', 'projects.project_manager_id')
                                    ->get();
                        ?>
                        @foreach($data as $item)
                        <option  value="<?php echo $item->id.' | '.$item->sm_name.' | '.$item->smid.' | '.$item->region_name; ?> ">{{ $item->name }} - {{ $item->region_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <input type="text" class="form-control projectcode" name="projectcode" wire:model="projectcode" />
                </div>
                <div class="col-md-12">
                    <label>Region</label>
                    <input type="text" class="form-control" name="region" id="region" readonly/>
                </div>
                <div class="col-md-12">
                    <label>Project Manager</label>
                    <input type="text" class="form-control" name="sm" id="sm" readonly/>
                </div>
                <div class="col-md-12">
                    <label>Project Name</label>
                    <select onclick="" class="form-control" name="project_name" id="project_name" wire:model="project_name">
                        <option value=""> -- Project Name --</option>
                        <option  value="1">CMI</option>
                        <option  value="2">H3I</option>
                        <option  value="3">ISAT</option>
                        <option  value="4">STP</option>
                        <option  value="5">XL</option>
                        
                    </select>
                </div>
                <div class="col-md-12">
                    <label>Value</label>
                    <input type="text" class="form-control" name="danastpl" wire:model="danastpl" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
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


@section('page-script')

    Livewire.on('getproject',()=>{
        var project = $('#project').val();
        project = project.split(" | ");
        $('.projectcode').val(project[0]);
        $('#sm').val(project[1]);
        $('#region').val(project[3]);
        console.log(project);
    });

    Livewire.on('getprojectedit',()=>{
        var project = $('#projectedit').val();
        project = project.split(" | ");
        $('.projectcode').val(project[0]);
        $('#smedit').val(project[1]);
        $('#regionedit').val(project[3]);
        console.log(project);
    });

    Livewire.on('modalrevisidana',(data)=>{
        $("#modal-datastpl-revisidana").modal('show');
    });

    Livewire.on('modalapprovedana',(data)=>{
        $("#modal-datastpl-approved").modal('show');
    });
 
    Livewire.on('modaldeclinedana',(data)=>{
        $("#modal-datastpl-decline").modal('show');
    });

    Livewire.on('modaluploadir',(data)=>{
        $("#modal-datastpl-uploadir").modal('show');
    });
@endsection

<script>
    // Livewire.on('modalinputpono',(data)=>{
    //     $("modal-datastpl-inputdana").modal('show');
    // });
    // function sm_id(){
    //     var project = $('#project').val();
    //     project = project.split(" | ");
    //     // $('#project_code').val(project[0]);
    //     // $('#project_code').attr("placeholder", project[0]);
    //     $('#sm').val(project[1]);
    //     // $('#smid').val(project[2]);
    //     $('#region').val(project[3]);
    //     // console.log(project);
    // }

    // Livewire.on('test',(data)=>{
    //     alert(data);
    // });

</script>