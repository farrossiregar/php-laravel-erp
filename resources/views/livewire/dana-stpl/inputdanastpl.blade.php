@section('title', __('Penggunaan Dana STPL - Form input dana'))
@section('parentPageTitle', 'Home')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <br><br><br><br><br><br>

            <div class="tab-content">
                <div class="row">
                    <div class="col-md-12">
                        <form wire:submit.prevent="save">
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="addvaldana" title="add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Add Data Region')}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div id="valdana">
                                        <!-- <div class="row">
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="region" wire:model="region">
                                                            <option value=""> -- Region --</option>
                                                            <option value=""></option>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div href="#" title="Close" class="btn btn-danger"><i class="fa fa-close"></i> {{__('Close')}}</div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>CMI</label>
                                                        <input type="text" class="form-control" id="cmi" name="cmi" wire:model="cmi" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>H3I</label>
                                                        <input type="text" class="form-control" id="h3i" name="h3i" wire:model="h3i" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>ISAT</label>
                                                        <input type="text" class="form-control" id="isat" name="isat" wire:model="isat" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>STP</label>
                                                        <input type="text" class="form-control" id="stp" name="stp" wire:model="stp" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>XL</label>
                                                        <input type="text" class="form-control" id="xl" name="xl" wire:model="xl" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    
                                </div>
                                <br><br>
                                <!-- <div class="form-group">
                                    <a href="javascript:;" wire:click=""  data-toggle="modal" data-target="#modal-potrackingnonms-approvebast" title="Upload" class="btn btn-primary"> {{__('Approve')}}</a>
                                    <a href="javascript:;" wire:click=""  data-toggle="modal" data-target="#modal-potrackingnonms-revisebast" title="Upload" class="btn btn-danger"> {{__('Revisi')}}</a>
                                </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="submitdana" title="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Submit')}}</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#addvaldana').on('click', function(){
        var divcount = document.getElementById("valdana");
        divcount = divcount.children.length + 1;
        
        var cmi = '<div class="col-md-2" style="display: inline-block;" ><label>CMI</label><input type="text" class="form-control" id="cmi'+ divcount +'" name="cmi'+ divcount +'" wire:model="cmi" /></div>';
        var h3i = '<div class="col-md-2" style="display: inline-block;" ><label>H3I</label><input type="text" class="form-control" id="h3i'+ divcount +'" name="h3i'+ divcount +'" wire:model="h3i" /></div>';
        var stp = '<div class="col-md-2" style="display: inline-block;" ><label>STP</label><input type="text" class="form-control" id="stp'+ divcount +'" name="stp'+ divcount +'" wire:model="stp" /></div>';
        var isat = '<div class="col-md-2" style="display: inline-block;" ><label>ISAT</label><input type="text" class="form-control" id="isat'+ divcount +'" name="isat'+ divcount +'" wire:model="isat" /></div>';
        var xl = '<div class="col-md-2" style="display: inline-block;" ><label>XL</label><input type="text" class="form-control" id="xl'+ divcount +'" name="xl'+ divcount +'" wire:model="xl" /></div>';


        var deletebtn = '<div class="col-md-2" style="display: inline-block;"><div id="delete'+ divcount +'" onclick="deleteel('+ divcount +');" title="Delete" class="btn btn-danger"><i class="fa fa-close"></i></div></div>';
        var addreg = '<div class="col-md-2" style="display: inline-block;"><div id="delete'+ divcount +'" class="btn btn-primary"><i class="fa fa-search"></i></div></div>';
        var inputreg = '<div class="col-md-4" style="display: inline-block;"><input type="text" class="form-control" id="xl'+ divcount +'" name="xl'+ divcount +'" wire:model="xl" placeholder="Region" /></div>';
        var divregion = '<div id="row">' + inputreg + addreg + deletebtn + '</div>';
        
        var divinputval = '<div id="row">' + cmi + h3i + stp + isat + xl + '</div>';
        var divval = '<div id="divvaldana'+ divcount +'"><div id="row"><div class="col-md-10">' + divregion + '<br>' + divinputval + '</div></div><br><br></div>';

        $('#valdana').append(divval);
    });

    $('#submitdana').on('click', function(){
        console.log($("#valdana").serialize());
    });


    function deleteel(id){
        $('#divvaldana'+id).remove();
    }
</script>
<div class="modal fade" id="modal-potrackingnonms-approvebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.approvedetailfoto />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-potrackingnonms-revisebast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking-nonms.revisedetailfoto />
        </div>
    </div>
</div>


<script>
    Livewire.on('modalinputpono',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalimportaccdoc',(data)=>{
        console.log(data);
        $("#modal-potrackingstp-upload").modal('show');
    });
    Livewire.on('modalapprovedetailfoto',()=>{
        $("#modal-potrackingnonms-approvebast").modal('show');
    });
    Livewire.on('modalrevisedetailfoto',()=>{
        $("#modal-potrackingnonms-revisebast").modal('show');
    });
</script>




<script>
    function hidenote(){
        $('#note').css('display', 'none');
    }   

    function shownote(){
        $('#note').css('display', 'block');
    }   
</script>







