@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Input Commitment Letter</h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Company Name</label>
                                            
                                            <select onclick="" class="form-control" wire:model="company_name">
                                                <option value=""> --- Company --- </option>
                                                <option value="1">HUP</option>
                                                <option value="2">PMT</option>
                                                
                                            </select>
                                            @error('company_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Project</label>
                                            <select onclick="" class="form-control" wire:model="project">
                                                <option value=""> --- Project --- </option>

                                                @foreach($dataproject as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
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
                                            <label>Region Area</label>
                                            <!-- <input type="text" class="form-control" wire:model="region_area" readonly/> -->
                                            <select onclick="" class="form-control" wire:model="region_area">
                                                <option value=""> --- Region Area --- </option>
                                                @foreach($regionarealist as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Employee Name</label>
                                            <input list="employee_name" class="form-control"  wire:model="employee_name">
                                            <datalist id="employee_name" >
                                                @foreach($employeelist as $item)
                                                <option value="{{ $item->name }}">
                                                @endforeach
                                            </datalist>

                                           


                                            <!-- <select onclick="" class="form-control" wire:model="employee_name">
                                                <option value=""> --- Employee Name NOC--- </option>
                                                @foreach($employeelist as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> -->


                                           
                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                       

                                        

                                        <div class="col-md-12 form-group">
                                            <label>KTP ID</label>
                                            <input type="text" class="form-control" wire:model="ktp_id" readonly/>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>NIK PMT</label>
                                            <input type="text" class="form-control" wire:model="nik_pmt" readonly/>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Leader</label>
                                            
                                            <select onclick="" class="form-control" wire:model="leader">
                                                <option value=""> --- Leader --- </option>
                                                <!-- foreach(\App\Models\UserEpl::orderBy('id', 'desc')->get() as $item) -->
                                                @foreach($leaderlist as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('leader')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Type of Commitment Letter</label>
                                            <select onclick="" class="form-control" wire:model="type_letter">
                                                <option value=""> --- Type of Commitment Letter --- </option>
                                                
                                                <option value="1">BCG</option>
                                                <option value="2">Cyber Security</option>
                                                <option value="3">Others</option>
                                                
                                            </select>
                                           <br>
                                           @if($inputletter == '1')
                                           <input type="text" class="form-control" wire:model="title_letter"/>
                                           @endif
                                            @error('employee_name')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        
                                       
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    <!-- <a href="{{route('accident-report.index')}}" class="mr-2"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a> -->
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>