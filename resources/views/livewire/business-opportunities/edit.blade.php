@section('title', __('Business Opportunities - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="">
            <div class="tab-content">      
                <div class="header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Edit Business Opportunities</h5>
                </div>
                <hr />
                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>Quotation Number</label>
                                            <input type="text" class="form-control" wire:model="quotation_number"/>
                                            @error('quotation_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>PO Number</label>
                                            <input type="text" class="form-control" wire:model="po_number"/>
                                            @error('po_number')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Customer</label>
                                            <input type="text" class="form-control" wire:model="customer" required/>
                                            @error('customer')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Project Name</label>
                                            <input type="text" class="form-control project_name_edit" wire:model="project_name" required/>
                                            @error('project_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Region</label>
                                            <input type="text" class="form-control region_name_edit" wire:model="region" />
                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <div class="row">
                                                <div class="col-md-6 form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" class="form-control" wire:model="qty" required/>
                                                    @error('qty')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Unit</label>
                                                    <select class="form-control" wire:model="unit">
                                                        <option value="">-- Unit --</option>
                                                        <option value="sites">Sites</option>
                                                        <option value="team">Team</option>
                                                        <option value="km">KM</option>
                                                    </select>
                                                    @error('unit')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Price / Unit (IDR)</label>
                                            <input type="number" class="form-control" wire:model="price_or_unit" required/>
                                            @error('price_or_unit')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>Estimated Revenue (IDR)</label>
                                            <!-- <input onchange="currency()" id="estimated_revenue" type="text" class="form-control" wire:model="estimate_revenue"/> -->
                                            <input type="number" class="form-control" wire:model="estimate_revenue" required/>
                                            @error('estimate_revenue')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <script>
                                            function currency(){
                                                var numb = document.getElementById("estimated_revenue").value;
                                                var formatter = new Intl.NumberFormat('en-US', {
                                                    style: 'currency',
                                                    currency: 'IDR',
                                                });
                                                document.getElementById("estimated_revenue").value = formatter.format(numb);
                                            }
                                        </script>
                                        <div class="col-md-6 form-group">
                                            <label>Start Duration</label>
                                            <input type="date" class="form-control" wire:model="startdate" required/>
                                            @error('startdate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Duration</label>
                                            <input type="date" class="form-control" wire:model="enddate" required/>
                                            @error('enddate')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Brief Description of Project</label>
                                            <textarea class="form-control" wire:model="brief_description" required></textarea>
                                            @error('start_dur')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label>Customer_type</label>
                                            <select class="form-control" wire:model="customer_type" x-data="" required>
                                                <option value="">-- Customer Type --</option>
                                                <option value="Tower Provider">Tower Provider</option>
                                                <option value="Vendor">Vendor</option>
                                                <option value="Operators">Operator</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            @error('customer_type')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Note</label>
                                            <textarea class="form-control" wire:model="note"></textarea>
                                            @error('note')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <hr />
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Update</button>
                                    @if($quotation_number=="" and $po_number=="")
                                        <a href="javascript:void(0);" wire:click="cancel" class="btn btn-danger">Cancel</a>
                                    @endif
                                    @if($quotation_number and $po_number=="")
                                        <a href="javascript:void(0);" wire:click="failed" class="btn btn-danger">Failed</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-scripts')
        <script type="text/javascript">
            setTimeout(function(){
                $(function(){
                    var data_project_name = [];
                    @foreach(\App\Models\ClientProject::where('is_project',1)->get() as $item)
                    data_project_name.push("{{$item->name}}");
                    @endforeach
                    $(".project_name_edit").autocomplete({
                        autoFocus:true,
                        source: data_project_name,
                        change: function (event, ui) {
                            if(ui.item.label != undefined) @this.set('project_name',ui.item.label)
                        },
                    })

                    var region_name = [];
                    @foreach(\App\Models\Region::get() as $item)
                        region_name.push("{{$item->region}}");
                    @endforeach
                    $(".region_name_edit").autocomplete({
                        autoFocus:true,
                        source: region_name,
                        change: function (event, ui) {
                            if(ui.item.label != undefined) @this.set('region',ui.item.label)
                        },
                    });
                });
            },2000);
        </script>
    @endpush
</div>