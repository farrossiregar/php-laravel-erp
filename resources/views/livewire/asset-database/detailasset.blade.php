@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Detail Asset Database</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12" >
                                    <div class="row  form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto;">
                                        <br>

                                      

                                        <div class="col-md-6 form-group">
                                            <label>Type of Asset</label>
                                            <!-- <input type="text" class="form-control"  wire:model="asset_type" > -->
                                            <select onclick="" class="form-control" wire:model="asset_type">
                                                <option value=""> --- Type of Asset --- </option>
                                                <option value="1">Air Conditioner & Fan</option>
                                                <option value="2">Furniture & Fixture</option>
                                                <option value="3">Computer Equipment</option>
                                                <option value="4">Printer & Device</option>
                                            </select>

                                            @error('asset_type')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            
                                            <label>Name of Asset</label>
                                            <input list="asset_name1" class="form-control"  wire:model="asset_name">
                                            <datalist id="asset_name1" >
                                                @foreach($dataassetname as $item)
                                                <option value="{{ $item->asset_name }}">
                                                @endforeach
                                            </datalist>

                                            @error('asset_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Region</label>
                                            
                                            <select name="" id="" class="form-control"  wire:model="region">
                                                <option value="" selected>-- Region --</option>
                                                @foreach(\App\Models\Region::orderBy('id', 'asc')->get() as $item)
                                                    <option value="{{$item->region}}">{{$item->region}}</option>
                                                @endforeach
                                            </select>

                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Project</label>
                                            
                                            <select name="" id="" class="form-control"  wire:model="project">
                                                <option value="" selected>-- Project --</option>
                                                @foreach(\App\Models\ClientProject::where('company_id', Session::get('company_id'))
                                                                        ->where('is_project', '1')
                                                                        ->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>

                                            @error('region')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Location</label>
                                            
                                            <select name="" id="" class="form-control"  wire:model="location">
                                                <option value="" selected>-- Location --</option>
                                                <option value="007">Jakarta (HQ)</option>
                                                @foreach(\App\Models\DophomebaseMaster::where('status', '1')->orderBy('id', 'asc')->get() as $item)
                                                    <option value="{{$item->id}}">{{$item->nama_dop}}</option>
                                                @endforeach
                                            </select>

                                            @error('location')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Dimension (H/L/W)</label>
                                            <input type="text"  class="form-control"  wire:model="dimension" >
                                           

                                            @error('dimension')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                       
                                        <!-- <div class="col-md-6 form-group">
                                            <label>Reference Picture</label>
                                            <input type="file" class="form-control" name="file" wire:model="file" />
                                            <img src="<?php echo asset('storage/Asset_database/'.$file); ?>" class="img-rounded" alt="" width="160" height="90">
                                            @error('file')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Link</label>
                                            <input type="text"  class="form-control"  wire:model="link" >
                                            @error('link')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror

                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Serial Number</label>
                                            <input type="text"  class="form-control"  wire:model="serial_number" >
                                           

                                            @error('quantity')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                        <div class="col-md-6 form-group">
                                            <label>Expired Date</label>
                                            <input type="date"  class="form-control"  wire:model="expired_date" >
                                            @error('expired_date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror

                                            
                                        </div>

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Detail Asset</label>
                                            <textarea name="" id="" cols="30" rows="6" class="form-control"  wire:model="detail"></textarea>

                                            @error('detail')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Reason Request</label>
                                            <textarea name="" id="" cols="30" rows="6" class="form-control"  wire:model="reason_request"></textarea>

                                            @error('detail')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div> -->

                                       
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('after-scripts')
    
        <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
        <script>
            $('.asset_name').select2();
            $('.asset_name').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('filter_asset_name',data.id)
            });
            $('.insert_asset_name').select2();
            $('.insert_asset_name').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('asset_name',data.id)
            });
            
            
        </script>
        <script type="text/javascript">
        

        $("input[data-type='currency']").on({
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() { 
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            var input_val = input.val();
            
            // don't validate empty input
            if (input_val === "") { return; }
            
            // original length
            var original_len = input_val.length;

            // initial caret position 
            var caret_pos = input.prop("selectionStart");
                
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);
                input_val = "Rp" + left_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = "Rp" + input_val;
            }
            
            input.val(input_val);
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
        </script>

        
        @endpush
</div>