@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Hotel & Flight Ticket Request</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Employee Name</label>
                                            <input list="petty_cash_category1" class="form-control"  wire:model="employee_name" readonly>
                                           

                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Project</label>
                                            <input type="text" class="form-control" wire:model="project" readonly/>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Region</label>
                                            <input type="text" class="form-control" wire:model="region" readonly/>
                                            
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Position</label>
                                            <input type="text" class="form-control" wire:model="position" readonly/>
                                            
                                            @error('position')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label>Date </label>
                                            <input type="date" class="form-control" wire:model="date">
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Category</label>
                                            <select onclick="" class="form-control" wire:model="claim_category">
                                                <option value=""> --- Category --- </option>
                                                <option value="1">Meeting</option>
                                                <option value="2">Training</option>
                                                <option value="3">Other</option>
                                                
                                            </select>
                                        </div>

                                        @if($this->claim_category == '3')
                                        <div class="col-md-12 form-group">
                                            <label>Other Category</label>
                                            <input type="text" class="form-control"  wire:model="claim_category2">
                                           

                                            @error('claim_category')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        @endif

                                        <div class="col-md-12 form-group">
                                            <label>Ticket Type</label></span>
                                            <select onclick="" class="form-control" wire:model="ticket_type">
                                                <option value=""> --- Ticket Type --- </option>
                                                <option value="1">Hotel & Flight</option>
                                                <option value="2">Hotel only</option>
                                                
                                            </select>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        @if($tickettype == true)
                                        <?php
                                            // $airport = file_get_contents('https://gist.githubusercontent.com/tdreyno/4278655/raw/7b0762c09b519f40397e4c3e100b097d861f5588/airports.json');
                                            // echo $airport[0]->code;
                                            // print_r($airport);
                                            $airport = '[{"code":"cgk","city":"jakarta"},{"code":"sub","city":"surabaya"},{"code":" DPS","city":"Denpasar"},{"code":"UPG","city":"Makassar"},{"code":"BPN","city":"balikpapan"},{"code":"jog","city":"yogyakarta"},{"code":"srg","city":"semarang"},{"code":"bth","city":"batam"},{"code":"pku","city":"pekanbaru"},{ "code":"ard","city":"alor Island"},{"code":"AMQ","city":"Ambon"},{"code":"ABU","city":"Atambua"},{"code":"btj","city":"banda Aceh"},{"code":"TKG","city":"Bandar Lampung"},{"code":"BDO","city":"Bandung"},{"code":"BDJ","city":"Banjarmasin "},{"code":"bwx","city":"banyuwangi"},{"code":"buw","city":"baubau"},{"code ":"BKS","city":"Bengkulu"},{"code":"BEJ","city":"Berau"},{"code":"BIK","city":"biak"},{"code":"bmu","city":"bima"},{"code":"wub","city":"buli"},{"code ":"ENE","city":"Ende"},{"code":"FKQ","city":"Fak Fak"},{"code":"GTO","city":"Gorontalo"},{"code":"GNS","city":"Gunung Sitoli"},{"code":"HLP","city":"Jakarta Halim"},{"code":"DJB","city":"Jambi"},{"code":"DJJ","city":"Jayapura"},{"code":"kbu","city":"kotabaru"},{"code":"kng","city":"kaimana"},{"code":"kdi", "city":"kendari"},{"code":"ktg","city":"ketapang"},{"code":"koe","city":"ku pang"},{"code":"lbj","city":"labuanbajo"},{"code":"lah","city":"labuha"},{"code":"lka","city":"larantuka"},{"code":"lsw","city":"lhokseumawe"},{"code" :"LOP","city":"Lombok"},{"code":"LUW","city":"Luwuk"},{"code":"MLG","city": "Malang"},{"code":"MJU","city":"Mamuju"},{"code":"MDC","city":"Manado"},{"code":"mkw","city":"manokwari"},{"code":"mof","city":"maumere"},{"code":"kno ","city":"medan"},{"code":"mna","city":"melonguane"},{"code":"mkq","city":" Merauke"},{"code":"MEQ","city":"Meulaboh"},{"code":"NBX","city":"Nabire"},{ "code":"ntx","city":"natuna"},{"code":"nnx","city":"nunukan"},{"code":"pdg","city":"padang"},{"code":"pky","city":"palangkaraya"},{"code":"plm","city" :"Palembang"},{"code":"PLW","city":"Palu"},{"code":"NSW","city":"Pangandara n"},{"code":"pgk","city":"pangkal Pinang"},{"code":"PKN","city":"Pangkalan Bun"},{"code":"PUM","city":"Pomala"},{"code":"PNK","city":"Pontianak"},{"code":"psj","city":"poso"},{"code":"rtg","city":"ruteng"},{"code":"sri","city ":"Samarinda"},{"code":"SMQ","city":"Sampit"},{"code":"FLZ","city":"Sibolga "},{"code":"dtb","city":"silangit"},{"code":"soc","city":"solo"}]';
                                            $airport = json_decode($airport);
                                        ?>
                                        <div class="col-md-6 form-group">
                                            <label>Departure Airport</label>
                                            <input list="airport1" type="text" class="form-control" wire:model="departure_airport">
                                            
                                            <datalist id="airport1" >
                                            <?php
                                                foreach($airport as $item){
                                                    // if($item->country != 'Indonesia'){
                                                    //     continue;
                                                    // }else{
                                            ?>
                                                        <option value="{{strtoupper(@$item->city)}} - {{strtoupper(@$item->code)}}">
                                            <?php
                                                    // }
                                                }
                                            ?>
                                            </datalist>
                                           
                                            @error('departure_airport')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Arrival Airport</label>
                                            <input list="airport2" type="text" class="form-control" wire:model="arrival_airport">
                                            
                                            <datalist id="airport2" >
                                            <?php
                                                foreach($airport as $item){
                                                //     if($item->country != 'Indonesia'){
                                                //         continue;
                                                //     }else{
                                            ?>
                                                        <option value="{{strtoupper(@$item->city)}} - {{strtoupper(@$item->code)}}">
                                            <?php
                                                //     }
                                                }
                                            ?>
                                            </datalist>
                                           
                                            @error('arrival_airport')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        @endif

                                        <div class="col-md-12 form-group">
                                            <label>Meeting Location</label>
                                            <!-- <input type="text" class="form-control" wire:model="meeting_location"> -->
                                           <textarea name="" id="" cols="30" rows="2" class="form-control" wire:model="meeting_location"></textarea>
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Attachment</label>
                                            <input type="file" class="form-control" name="file" wire:model="file" />
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                       

                                        <!-- <div class="col-md-6 form-group">
                                            <label>Start Plan Schedule</label>
                                            <input type="time" class="form-control" wire:model="start_time_plan">
                                           
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>End Plan Schedule</label>
                                            <input type="time" class="form-control"  wire:model="end_time_plan">
                                           
                                            @error('leader')
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