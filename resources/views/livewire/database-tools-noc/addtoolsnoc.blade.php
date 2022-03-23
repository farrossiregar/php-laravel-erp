@section('title', __('Accident Report'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <?php
                        if($type == '1'){
                            $titleadd = 'Tools NOC';
                        }else{
                            $titleadd = 'Escalation Record';
                        }
                    ?>
                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update {{$titleadd}} </h5>
                </div>

                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Employee Name NOC</label>
                                            <input type="text" class="form-control" wire:model="name" readonly/>
                                            <!-- <select onclick="" class="form-control" wire:model="name">
                                                <option value=""> --- Employee Name NOC--- </option>
                                                @foreach( \App\Models\Employee::where('is_noc',1)->orderBy('id', 'desc')->get() as $item)
                                                
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                                @endforeach
                                            </select> -->
                                            @error('site_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control" wire:model="nik" readonly/>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 form-group">
                                            <label>Tools</label>
                                            <input list="tools" class="form-control" wire:model="tools">
                                            <datalist id="tools">
                                                @foreach(\App\Models\ToolsNoc::orderBy('id', 'desc')->groupBy('tools')->get() as $item)
                                                <option value="{{ $item->tools }}">
                                                @endforeach
                                            </datalist>
                                            @error('employee_id')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label>Software</label>
                                            <input list="software" class="form-control" wire:model="software">
                                            <datalist id="software">
                                                @foreach(\App\Models\ToolsNoc::orderBy('id', 'desc')->groupBy('software')->get() as $item)
                                                <option value="{{ $item->software }}">
                                                @endforeach
                                            </datalist>
                                            @error('employee_id')
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