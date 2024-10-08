@section('title', $data->name)
@section('parentPageTitle', 'Insert Exam')
<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" class="pl-3" wire:submit.prevent="save">
                    @foreach($data_soal as $k_soal => $item)
                        <h4 style="position: absolute;left:5px;">{{$k_soal+1}}</h4>
                        <p>{!!nl2br($item->soal)!!}</p>
                        <p>Jenis Soal : <b>{{$item->jenis_soal==1 ? 'Uraian' : 'Pilihan Tunggal'}}</b></p>
                        @if($item->jenis_soal==2)
                            <ol type="A">
                                @foreach(\App\Models\TrainingExamJawaban::where('training_exam_id',$item->id)->get() as $jawaban)
                                    <li>{{$jawaban->jawaban}}</li>
                                @endforeach
                            </ol>
                            <p>Jawaban : <strong>{{$alphabet[$item->kunci_jawaban]}}</strong></p>
                        @endif
                        <hr />
                    @endforeach
                    @if($data_soal->count()==0)
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Schedule</label>
                                <input type="text" class="form-control schedule_date" placeholder="Date" />
                            </div>
                            <div class="form-group col-md-3">
                                <label>Duration (minutes)</label>
                                <select class="form-control" wire:model="duration">
                                    <option value="1">None</option>
                                    <option value="60">60</option>
                                    <option value="90">90</option>
                                    <option value="120">120</option>
                                </select>
                            </div>
                        </div>
                        @foreach($list_soal as $k => $i)
                        <h4 style="position: absolute;left:5px;">{{$k+1}}</h4>
                            <div class="form-group" style="position:relative;">
                                <a  href="javascript:void(0);" wire:click="delete_soal({{$k}})" style="position: absolute;right: -17px;top: 0;color: #dccece;font-size:20px;"><i class="fa fa-times"></i></a>
                                <textarea class="form-control" wire:model="soal.{{$k}}" placeholder="Soal" style="height:100px;"></textarea>
                            </div>
                            <div class="form-group row px-3">
                                <select class="form-control" wire:model="jenis_soal.{{$k}}" style="width:200px;">
                                    <option value=""> --- Jenis Soal --- </option>
                                    <option value="1">Uraian</option>
                                    <option value="2">Pilihan Ganda</option>
                                    <!-- <option value="3">Pilihan Ganda</option> -->
                                </select>
                                <input type="number" wire:model="nilai_soal.{{$k}}" data-toggle="tooltip" title="Nilai Soal" placeholder="Nilai Soal" class="form-control ml-3" style="width:200px;"  />
                            </div>
                            {{-- Pilihan Tunggal --}}
                            @if($jenis_soal[$k]==2)
                                <div class="form-group">
                                    <ol type="A">
                                    @foreach($list_jawaban[$k] as $jk => $j)
                                        <li wire:key="{{$k+$jk}}">
                                            <div class="row mb-2 ml-1">
                                                <input type="radio" wire:model="kunci_jawaban.{{$k}}" value="{{$jk}}" data-toggle="tooltip" title="Set Kunci Jawaban" class="ml-2 mt-2">
                                                <input type="text" class="form-control ml-2" style="width:90%;" placeholder="Jawaban" wire:model="list_jawaban.{{$k}}.{{$jk}}" />
                                                <a href="javascript:void(0)" wire:click="delete_({{$k}},{{$jk}})" class="mt-2 ml-2"><i class="fa fa-times"></i></a>
                                            </div>
                                        </li>
                                    @endforeach
                                    </ol>
                                    <a href="javascript:void(0)" wire:click="add_jawaban({{$k}})"><i class="fa fa-plus"></i> Jawaban</a>
                                </div>
                            @endif
                            {{-- Pilihan Ganda --}}
                            <!-- @if($jenis_soal[$k]==3)
                                <div class="form-group">
                                    @foreach($list_jawaban[$k] as $jk => $j)
                                        <div class="row mb-2" wire:key="{{$k+$jk}}">
                                            <input type="checkbox" wire:model="kunci_jawaban.{{$k}}" value="{{$jk}}" data-toggle="tooltip" title="Set Kunci Jawaban" class="ml-2 mt-2">
                                            <input type="text" class="form-control ml-2" style="width:90%;" placeholder="Jawaban" wire:model="list_jawaban.{{$k}}.{{$jk}}" />
                                            <a href="javascript:void(0)" wire:click="delete_({{$k}},{{$jk}})" class="mt-2 ml-2"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endforeach
                                    <a href="javascript:void(0)" wire:click="add_jawaban({{$k}})"><i class="fa fa-plus"></i> Jawaban</a>
                                </div>
                            @endif -->
                            <hr />
                        @endforeach
                        <a href="javascript:void(0)" wire:click="add_soal"><i class="fa fa-plus"></i> Tambah Soal</a>
                        <hr />
                        <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> {{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ml-3"><i class="fa fa-save"></i> {{ __('Submit Exam') }}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="body">
            <table class="table" style="width:60%;">
                <tr>
                    <th>Schedule</th>
                    <td>{{date('d-M-Y',strtotime($data->start_exam))}} - {{date('d-M-Y',strtotime($data->end_exam))}}</td>
                </tr>
                <tr>
                    <th>Duration</th>
                    <td>{{$data->duration}} Minutes</td>
                </tr>
                <tr>
                    <th>Total Soal</th>
                    <td>{{$data_soal->count()}}</td>
                </tr>
            </table>
            @if($data_soal->count()!=0)
                <hr />  
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <thead>
                            <tr style="background:#eee;">
                                <th style="width:50px;">No</th>                                    
                                <th>Employee</th>   
                                <th>Score</th>          
                                <th>Date Submited</th>   
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\TrainingExamResult::where(['training_material_id'=>$data->id])->get() as $k => $result)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{isset($result->employee->name)?$result->employee->name:''}}</td>
                                <td>{{$result->nilai}}</td>
                                <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
    <script>
        $('.schedule_date').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            @this.set("start_exam", start.format('YYYY-MM-DD'));
            @this.set("end_exam", end.format('YYYY-MM-DD'));
        });

    </script>
@endpush