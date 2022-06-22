<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
    
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Asset Database </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="">Project</label>
                    <select class="form-control" name="project" wire:model="project">
                        <option value=""> -- Project -- </option>
                        @foreach(\App\Models\ClientProject::where('company_id', Session::get('company_id'))->where('is_project', 1)->get() as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('project')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="">Region</label>
                    <select class="form-control" name="region" wire:model="region">
                        <option value=""> -- Region -- </option>
                        @foreach($regionlist as $item)
                        <option value="{{ $item->id }}">{{ $item->region }}</option>
                        @endforeach
                    </select>
                    @error('region')
                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                    @enderror
                </div>
            </div>
            
        </div>

        <div class="form-group">
            <input type="file" class="form-control" name="file" wire:model="file" />
            @error('file')
            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
            @enderror
        </div>

        

        <br>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-upload"></i> Upload</button>
        </div>

        <br>
       
        <a href="#" wire:click="sampleimport()"><i class="fa fa-download"></i> Download Sample Asset Database</a>
        <br>
        <br>
        <!-- <div class="modal-footer">
            <div href="#" wire:click="sampleimport()" class="btn btn-info close-modal"><i class="fa fa-download"></i> Download</div>
        </div> -->
        
        <!-- <a href="#" wire:click="sampleimport()"><i class="fa fa-download">Download Sample Import Actual Schedule</i></a> -->
    </div>
   
    <div wire:loading>
        <div class="page-loader-wrapper" style="display:block">
            <div class="loader" style="display:block">
                <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                <p>Please wait...</p>
            </div>
        </div>
    </div>
</form>
