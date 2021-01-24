@section('title', 'Data')
@section('parentPageTitle', 'Work Flow Management')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-1 px-0">
                    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#modal_upload"><i class="fa fa-upload"></i> Upload</a>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DATE</th>                                    
                                <th>NAME</th>                                    
                                <th>ID</th>                                    
                                <th>SERVICEAREA4</th>
                                <th>CITY</th>
                                <th>SERVICEAREA2</th>
                                <th>REGION</th>
                                <th>ASP</th>
                                <th>REGION & ASP INFO</th>
                                <th>SKILLS</th>
                                <th>WO ASSIGN</th>
                                <th>WO ACCEPT</th>
                                <th>WO CLOSE MANUAL</th>
                                <th>WO CLOSE AUTO</th>
                                <th>MTTR</th>
                                <th>REMARK WO ASSIGN</th>
                                <th>REMARK WO ACCEPT</th>
                                <th>REMARK WO CLOSE MANUAL</th>
                                <th>FINAL REMARK</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                            <tr>
                                <td style="width: 50px;">{{$k+1}}</td>
                                <td>{{$item->date}}</td> 
                                <td>{{$item->name}}</td> 
                                <td>{{$item->id_}}</td> 
                                <td>{{$item->servicearea4}}</td> 
                                <td>{{$item->city}}</td> 
                                <td>{{$item->servicearea2}}</td> 
                                <td>{{$item->region}}</td> 
                                <td>{{$item->asp}}</td> 
                                <td>{{$item->region_dan_asp_info}}</td> 
                                <td>{{$item->skills}}</td> 
                                <td>{{$item->wo_assign}}</td> 
                                <td>{{$item->wo_accept}}</td> 
                                <td>{{$item->wo_close_manual}}</td> 
                                <td>{{$item->wo_close_auto}}</td> 
                                <td>{{$item->mttr}}</td> 
                                <td>{{$item->remark_wo_assign}}</td> 
                                <td>{{$item->remark_wo_accept}}</td> 
                                <td>{{$item->remark_wo_close_manual}}</td> 
                                <td>{{$item->final_remark}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:work-flow-management.upload />
        </div>
    </div>
</div>