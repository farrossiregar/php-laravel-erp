@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Transfer Asset</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6" >
                                            <div class="form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto;">
                                                <div class="col-md-12 form-group">
                                                    <h5>Transfer From</h4>
                                                </div>
                                                <br>
                                                <!-- <input type="text" class="form-control" wire:model="transferid" readonly/> -->
                                                
                                                <div class="col-md-12 form-group">
                                                    <label>PIC</label>
                                                    <!-- <input type="text" class="form-control" wire:model="transfer_from"/> -->
                                                    <input list="pic_from" type="text" class="form-control" wire:model="transfer_from">
                                                    <datalist id="pic_from" >
                                                        @foreach(\App\Models\Employee::get() as $item)
                                                        <option value="{{ $item->name }} - {{ $item->nik }}">
                                                        @endforeach
                                                    </datalist>
                                                    @error('file')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="col-md-6" >
                                            <div class="form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto;">
                                                <div class="col-md-12 form-group">
                                                    <h5>Transfer To</h4>
                                                </div>
                                                <br>
                                                
                                                <div class="col-md-12 form-group">
                                                    <label>PIC</label>
                                                    <!-- <input type="text" class="form-control" wire:model="pic_asset"/> -->
                                                    <input list="pic_to" type="text" class="form-control" wire:model="pic_asset">
                                                    <datalist id="pic_to" >
                                                        @foreach(\App\Models\Employee::get() as $item)
                                                        <option value="{{ $item->name }} - {{ $item->nik }}">
                                                        @endforeach
                                                    </datalist>
                                                    @error('file')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 form-group">
                                                    <label>Location</label>
                                                    <select name="" id="" class="form-control"  wire:model="location">
                                                        <option value="" selected>-- Location --</option>
                                                        <option value="Jakarta (HQ)">Jakarta (HQ)</option>
                                                        @foreach(\App\Models\DophomebaseMaster::where('status', '1')->orderBy('id', 'asc')->get() as $item)
                                                            <option value="{{$item->nama_dop}}">{{$item->nama_dop}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <br><br>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <div class="form-group" style="border: 1px solid lightgrey; border-radius: 5px; padding: 10px 0; width: 100%; margin: auto;">
                                                <div class="col-md-12 form-group">
                                                    <label>Reason of Transfering</label>
                                                    <textarea name="" id="" cols="30" rows="2" class="form-control" wire:model="transfer_reason" ></textarea>
                                                

                                                    @error('reason_transfer')
                                                    <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                                    @enderror
                                                </div>
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Update</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <table class="table">
                                        <thead style="background: #eee;">
                                            <tr>
                                                <th>No</th>
                                                <th>Asset Type</th>
                                                <th>Asset Name</th>
                                                <th>Serial Number</th>
                                                <th>Project</th>
                                                <th>Region</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <!-- foreach(\App\Models\AssetTransferRequestDetail::select('asset_transfer_request_detail.*', 'asset_database.asset_type', 'asset_database.serial_number', 'asset_database.project', 'asset_database.region', 'asset_database.location')->join('asset_database', 'asset_database.id', '=', 'asset_transfer_request_detail.asset_id')->where('asset_transfer_request_detail.user_id', \Auth::user()->id)->get() as $k => $item) -->
                                            @foreach($data_asset as $k => $item)
                                                <tr>
                                                    <td>{{$k+1}}</td>
                                                    <td>
                                                        @if($item->asset_type == '1')
                                                            Air Conditioner & Fan
                                                        @endif

                                                        @if($item->asset_type == '2')
                                                            Furniture & Fixture
                                                        @endif

                                                        @if($item->asset_type == '3')
                                                            Computer Equipment
                                                        @endif
                                                    </td>
                                                    <td>{{ @$item->asset_name }}</td>
                                                    <td>{{ @$item->serial_number }}</td>
                                                    <td>{{ @\App\Models\ClientProject::where('id', $item->project)->first()->name }}</td>
                                                    <td>{{ @$item->region }}</td>
                                                    <td>{{ @\App\Models\DopHomebaseMaster::where('id', $item->location)->first()->nama_dop }}</td>
                                                </tr>
                                            @endforeach
                                        
                                        
                                        </tbody>
                                    </table>
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