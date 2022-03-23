@section('title', __('Business Opportunities - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="">
            <div class="tab-content">      
                <div class="header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Contract Registration</h5>
                </div>
                <hr />
                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Quotation Number</label>
                                            <input type="text" class="form-control" wire:model="quotation_number" readonly {{$is_readonly}} />
                                            @error('quotation_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>PO Number</label>
                                            <input type="text" class="form-control" wire:model="po_number" readonly {{$is_readonly}} />
                                            @error('po_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>PO Amount</label>
                                            <input type="text" class="form-control" wire:model="po_amount" required {{$is_readonly}} />
                                            @error('po_amount')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project Code</label>
                                            <input type="text" class="form-control" wire:model="project_code" required {{$is_readonly}} />
                                            @error('project_code')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Sub Project Code</label>
                                            <input type="text" class="form-control" wire:model="sub_project_code" required {{$is_readonly}}/>
                                            @error('sub_project_code')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="start_contract" required {{$is_readonly}} />
                                            @error('start_contract')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="end_contract" required {{$is_readonly}} />
                                            @error('end_contract')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Note</label>
                                            <textarea name="" id="" cols="30" class="form-control" wire:model="remarks" required rows="5" {{$is_readonly}} ></textarea>
                                            @error('remarks')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Document Contract</label>
                                            @if(isset($data->is_submit_contract) and $data->is_submit_contract==0)
                                                <input type="file" class="form-control" name="file" wire:model="file" />
                                            @else
                                                @if(isset($data->is_submit_contract) and $data->contract)
                                                    <a href="{{asset('storage/contract_registration_flow/Contract/'.$data->contract)}}"><i class="fa fa-download"></i> Download</a>
                                                @endif
                                            @endif
                                            @error('file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                            <!-- <div wire:loading wire:target="file">Uploading...</div> -->
                                        </div>  
                                    </div>
                                </div>
                                @if(isset($data->is_submit_contract) and $data->is_submit_contract==0)
                                    <hr />
                                    <div class="col-md-12 form-group" wire:loading.remove wire:target="file">
                                        <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>