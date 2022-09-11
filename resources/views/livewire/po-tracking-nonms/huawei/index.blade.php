@section('title', __('PO Tracking Non MS'))
@section('parentPageTitle', 'Huawei')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#tab_huawei_work_order">Purchase Order</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="tab_huawei_work_order">
                    <div class="header row px-0">
                        <div class="col-md-2">
                            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
                        </div>
                        <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" wire:model="filter_field_team_id">
                                <option value=""> -- Field Team -- </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            @if($is_e2e)
                                <a href="#" data-toggle="modal" data-target="#modal-huawei-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import')}}</a>
                            @endif 
                            <span wire:loading>
                                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                <span class="sr-only">{{ __('Loading...') }}</span>
                            </span>
                        </div>
                    </div>
                    <div class="body pt-0 px-0">    
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center">PO Status</th>   
                                        <th>PO NO</th>   
                                        <th>Sub Region</th>   
                                        <th class="text-right">Total Price</th>
                                        <th class="text-right">Budget Request</th>
                                        <th class="text-center">Total Gross Margin(%)</th>
                                        <th>Coordinator</th>
                                        <th>Field Team</th>
                                        <th>Scoope of Works</th>
                                        <th>Contract Number</th>
                                        <th>Contract Date</th>
                                        <th>BAST Number</th>
                                        <th>BAST Date</th>
                                        <th>GR Number</th>
                                        <th>GR Date</th>
                                        <th>Works</th>
                                        <th>Project</th>
                                        <th>VAT (%)</th>
                                        <th>WHT (%)</th>
                                        <th>Extra Budget</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $k => $item)
                                        <tr>
                                            <td>{{$k+1}}</td>
                                            <td class="text-center">
                                                @if($item->status==0 || $item->status == null || $item->status == '0')
                                                    <label class="badge badge-info" data-toggle="tooltip" title="Regional / SM - Waiting PR Submission">Waiting PR Submission</label>
                                                @endif
                                                @if($item->status==1)
                                                    <label class="badge badge-warning" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance In Review</label>
                                                @endif
                                                @if($item->status==2)
                                                    <label class="badge badge-success" data-toggle="tooltip" title="Finance - Profit >= 30%, Waiting to Transfer Budget">Finance - Approved</label>
                                                @endif
                                                @if($item->status==3)
                                                    <label class="badge badge-danger" data-toggle="tooltip" title="PMG - Revise Request, Profit < 30%">PMG Review</label>
                                                @endif
                                                @if($item->status==4)
                                                    <label class="badge badge-warning" data-toggle="tooltip" title="PMG - Waiting PMG Review under 30%">PMG Review </label>
                                                @endif
                                                @if($item->status==5)
                                                    <label class="badge badge-info" data-toggle="tooltip">Budget Transferred To Project Admin/Finance</label>
                                                @endif
                                                @if($item->status==6)
                                                    <label class="badge badge-info" data-toggle="tooltip">Pending Assignment To Field Team</label>
                                                @endif
                                                @if($item->status ==7)
                                                    <label class="badge badge-info">Ongoing Execution</label>
                                                @endif
                                                @if($item->status ==8)
                                                    <label class="badge badge-info" data-toggle="tooltip">Field Team Submitted</label>
                                                @endif
                                                @if($item->status ==9)
                                                    <span class="badge badge-info" title="Waiting BAST Regional">BAST - Regional</span>
                                                @endif
                                                @if($item->status ==10)
                                                    <span class="badge badge-info" title="Waiting Approval BAST Regional">BAST - E2E</span>
                                                @endif
                                                @if($item->status ==11)
                                                    <span class="badge badge-warning" title="Revisi BAST">Revisi</span>
                                                @endif
                                                @if($item->status ==12)
                                                    <span class="badge badge-info" title="Finance Upload Acceptance and Invoice">Finance to Invoice</span>
                                                @endif
                                                @if($item->status ==13)
                                                    <span class="badge badge-success badge-active"><i class="fa fa-check-circle"></i> Invoiced</span>
                                                @endif
                                            </td>
                                            <td><a href="{{route('po-tracking-nonms.huawei.detail',$item->id)}}">{{$item->po_no}}</a></td>
                                            <td>{{$item->sub_region}}</td>
                                            <td class="text-right">{{format_idr($item->po_amount)}}</td>
                                            <td class="text-right">{{format_idr($item->pr_amount)}}</td>
                                            <td class="text-center">{{format_idr($item->margin)}}</td>
                                            <td>
                                                @if($item->status==5 and $item->coordinator_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-coordinator" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> coordinator</a>
                                                @else
                                                    {{isset($item->coordinator->name) ? $item->coordinator->nik .' / '. $item->coordinator->name : '-'}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==6 and $item->field_team_id =='' and $is_regional)
                                                    <a href="javascript:void(0)" data-target="#modal-select-field_team" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" class="badge badge-info badge-active"><i class="fa fa-plus"></i> field team</a>
                                                @else
                                                    {{isset($item->field_team->name) ? $item->field_team->nik .' / '. $item->field_team->name : '-'}}
                                                @endif
                                            </td>
                                            <td>{{$item->scoope_of_work}}</td>
                                            <td>{{$item->contract_no}}</td>
                                            <td>{{$item->contract_date?$item->contract_date : '-'}}</td>
                                            <td>
                                                @if($item->status==7 and $is_regional)
                                                    <a href="{{route('po-tracking-nonms.huawei.regional-bast',$item->id)}}" class="badge badge-info badge-active">Create BAST</a>
                                                @endif
                                                {{$item->bast_number}}
                                            </td>
                                            <td>{{$item->bast_date?date('d-M-Y',strtotime($item->bast_date)) : '-'}}</td>
                                            <td>{{$item->gr_number}}</td>
                                            <td>{{$item->gr_date?date('d-M-Y',strtotime($item->gr_date)) : '-'}}</td>
                                            <td>{{$item->works}}</td>
                                            <td>{{isset($item->client_project->name) ? $item->client_project->name : '-'}}</td>
                                            <td class="text-center">{{$item->vat}}</td>
                                            <td class="text-center">{{$item->wht}}</td>
                                            <td>
                                                @if($item->extra_budget)
                                                    {{format_idr($item->extra_budget)}}
                                                @endif
                                                @if($item->extra_budget_file)
                                                    <a href="{{asset($item->extra_budget_file)}}" target="_blank"><i class="fa fa-image"></i></a>
                                                @endif
                                                @if($item->status_extra_budget==1 and $is_finance)
                                                    <a href="javascript:void(0)" class="badge badge-info badge-active" wire:click="$emit('set_id',{{$item->id}})" data-target="#modal_process_extra_budget" data-toggle="modal"><i class="fa fa-check-circle"></i> Acknowledge Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget=="" and $is_e2e)
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-extra-budget" wire:click="$emit('set_id',{{$item->id}})" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Extra Budget</a>
                                                @endif
                                                @if($item->status_extra_budget==2)
                                                    <a href="javascript:void(0)" class="text-success" title="Acknowledge"><i class="fa fa-check-circle"></i></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->status==10 and $is_e2e)
                                                    <a href="{{route('po-tracking-nonms.huawei.e2e-bast',$item->id)}}" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Review BAST</a>
                                                @endif
                                                @if($item->status==12 and $is_finance)
                                                    <a href="javascript:void(0)" wire:click="$emit('set_id',{{$item->id}})" data-toggle="modal" data-target="#modal-finance-acceptance-invoice" class="badge badge-info badge-active"><i class="fa fa-arrow-right"></i> Acceptance & Invoice</a>
                                                @endif
                                            </td>
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
    </div>
    @livewire('po-tracking-nonms.bast')
</div>
@push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}" />
@endpush
<div class="modal fade" id="modal_process_extra_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-proses-extra-budget')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-extra-budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.e2e-extra-budget')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-finance-acceptance-invoice" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.finance-acceptance')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-select-coordinator" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.select-coordinator')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-select-field_team" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.select-fieldteam')
        </div>
    </div>
</div>
<div class="modal fade" id="modal-huawei-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @livewire('po-tracking-nonms.huawei.wo-upload')
        </div>
    </div>
</div>