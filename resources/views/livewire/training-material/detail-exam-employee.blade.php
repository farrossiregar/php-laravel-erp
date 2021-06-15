@section('title', $data->name)

<div class="row clearfix">
    <div class="col-md-8">
        <div class="card">
            <div class="body">
                <form id="basic-form" method="post" class="pl-3" wire:submit.prevent="save">
                    @foreach($list_soal as $k => $i)
                    <h4 style="position: absolute;left:5px;">{{$k+1}}</h4>
                        <div class="form-group" style="position:relative;">
                            <p>{{$i->soal->soal}}</p>
                        </div>
                        <p>
                        <strong>Jenis Soal :</strong> 
                            @if($i->soal->jenis_soal==1)
                                Uraian
                            @endif
                            @if($i->soal->jenis_soal==2)
                                Pilihan Ganda
                            @endif
                        </p>
                        <p>
                        <strong>Jawaban :</strong> 
                            @if($i->soal->jenis_soal ==2)
                                {{$alphabet[$i->jawaban]}}
                                @php($alphabet_jawaban = \App\Models\TrainingExamJawaban::where(['training_exam_id'=>$i->training_exam_id,'key'=>$i->jawaban])->first())
                                . {{ isset($alphabet_jawaban->jawaban) ? $alphabet_jawaban->jawaban : ""}} 
                                @if($i->jawaban==$alphabet_jawaban->jawaban)
                                    <span class="text-success"><i class="fa fa-check"></i></span>
                                @else
                                    <span class="text-danger"><i class="fa fa-times"></i></span>
                                    <p>
                                        <span>
                                            @php($alphabet_jawaban = \App\Models\TrainingExamJawaban::where(['training_exam_id'=>$i->training_exam_id,'key'=>$i->soal->kunci_jawaban])->first())
                                            <strong>Kunci Jawaban :</strong> {{$alphabet[$i->soal->kunci_jawaban]}} . {{isset($alphabet_jawaban->jawaban) ? $alphabet_jawaban->jawaban : ''}}
                                        </span>
                                    </p>
                                @endif
                            @else
                                {{$i->jawaban}}
                            @endif
                        </p>
                        <hr />
                    @endforeach
                        
                </form>
                @if($result->status==0)
                    <form class="px-2" wire:submit.prevent="submit_score">
                        <div class="form-group">
                            <label>Total Skor</label>
                            <input type="number" class="form-control" style="width:130px" wire:model="score">
                            @error('score')
                            <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <hr />
                        <div class="form-group">
                            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Submit Score</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="body">
                <table class="table">
                    <tr>
                        <th>NIK</th>
                        <td>{{isset($result->employee->nik)?$result->employee->nik:''}}</td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{isset($result->employee->name)?$result->employee->name:''}}</td>
                    </tr>
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
                    <tr>
                        <th>Skor</th>
                        <td>{{$result->nilai}}</td>
                    </tr>
                </table>
                <hr />
            </div>
        </div>
    </div>
</div>