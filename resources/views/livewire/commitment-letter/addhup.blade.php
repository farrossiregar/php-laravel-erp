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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Project</label>
                                            <select onclick="" class="form-control" wire:model="project_id">
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
                                            <select onclick="" class="form-control" wire:model="region_id">
                                                <option value=""> --- Region --- </option>
                                                @foreach($regionarealist as $item)
                                                <option value="{{$item->id}}">{{ $item->region }}</option>
                                                @endforeach
                                            </select>
                                            @error('date')
                                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Employee Name</label>
                                            <select class="form-control insert_employee_id">
                                                <option value="">-- select --</option>
                                                @foreach($employeelist as $item)
                                                    <option value="{{ $item->id }}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('employee_id')
                                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Leader</label>
                                            
                                            <select onclick="" class="form-control" wire:model="leader">
                                                <option value=""> --- Leader --- </option>
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
            $('.insert_employee_id').select2();
            $('.insert_employee_id').on('select2:select', function (e) {
                var data = e.params.data;
                @this.set('employee_id',data.id)
            });
            Livewire.on('updated',(id)=>{
                $(".insert_employee_id").select2("destroy").select2();
                $('.insert_employee_id').on('select2:select', function (e) {
                    var data = e.params.data;
                    @this.set('employee_id',data.id)
                });
                setTimeout(function(){
                    $(".insert_employee_id").select2().val(id).trigger('change');
                },1000);
            })
        </script>
    @endpush

</div>