<form wire:submit.prevent="save">
    @csrf
    <div class="modal-header">
    
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-upload"></i> Upload Plan Team Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
       
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

        <br><br>
        <div class="form-group">
            <div class="row">
                <div class="col-md-4">                
                    <select class="form-control" wire:model="filteryear">
                        <option value=""> --- Year --- </option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <select class="form-control" style="width:100%;" wire:model="filtermonth">
                        <option value=""> --- Month --- </option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <select class="form-control" style="width:100%;" wire:model="filterproject">
                        <option value=""> --- Project --- </option>
                        @foreach(\App\Models\ClientProject::orderBy('id', 'desc')
                                            ->where('company_id', Session::get('company_id'))
                                            ->where('is_project', '1')
                                            ->get() as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div href="#" wire:click="sampleimport()" class="btn btn-info close-modal"><i class="fa fa-download"></i> Download</div>
        </div>
        
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
