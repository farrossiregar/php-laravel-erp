@section('title', __('Duty Roster - Preview'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <br>
                </div>
                <div class="col-md-12">
                    <div class="header row">
                        <!-- <div class="col-md-2">
                            <input type="date" class="form-control" wire:model="date" />
                        </div> -->

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="site_id" placeholder="Site ID" />
                        </div>
                        
                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="idpel_pln" placeholder="IDPEL PLN" />
                        </div>

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="tower_owner" placeholder="Tower Owner" />
                        </div>

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="sm" placeholder="Service Manager" />
                        </div>

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="te" placeholder="TE" />
                        </div>

                        <div class="col-md-1">
                            <input type="text" class="form-control" wire:model="cme" placeholder="CME" />
                        </div>

                        <!-- <div class="col-md-1">                
                            <select class="form-control" wire:model="year">
                                <option value=""> --- Year --- </option>
                                @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
                                <option>{{$item->year}}</option>
                                @endforeach 
                            </select>
                        </div> -->
        
                        <div class="col-md-2">
                            <a wire:click="save({{ $selected_id }})" href="" title="Add" class="btn btn-primary"><i class="fa fa-download"></i> {{__('Export Duty roster')}}</a>
                        </div>
                        <!-- <div class="col-md-2" wire:ignore>
                            <select class="form-control" style="width:100%;" wire:model="month">
                                <option value=""> --- Month --- </option>
                                @foreach(\App\Models\EmployeeNoc::select('month')->groupBy('month')->orderBy('month','ASC')->get() as $item)
                                <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                                @endforeach
                            </select>
                        </div> -->
                    </div>
                </div>
                
                
                <div class="col-md-12">
                    <div class="body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Remarks</th>
                                        <th>Project</th>
                                        <th>Tower Index</th>
                                        <th>Site ID</th>
                                        <th>Site Name</th>
                                        <th>NE System</th>
                                        <th>Site Address </th>
                                        <th>Cluster</th>
                                        <th>Sub Cluster</th>
                                        <th>Region</th>
                                        <th>Sub Region</th>
                                        <th>Idpel PLN</th>

                                        <th>Lat</th>
                                        <th>Long </th>
                                        <th>Category Site</th>
                                        <th>Depedency</th>
                                        <th>PM Category</th>
                                        <th>Macro/Ibc/Mcp/Repeater</th>
                                        <th>Site Type</th>
                                        <th>Permanent Genset </th>
                                        <th>Tower Owner</th>
                                        <th>Id TOCO</th>
                                        <th>Service Manager</th>
                                        <th>No HP Service Manager #1</th>
                                        <th>No HP Service Manager #2</th>
                                        <th>Coordinator</th>
                                        <th>No HP Coordinator #1</th>
                                        <th>No HP Coordinator #2</th>
                                        <th>TE</th>
                                        <th>No HP TE #1</th>
                                        <th>No HP TE #2</th>
                                        <th>CME</th>
                                        <th>No HP CME #1</th>

                                        <th>No HP CME #1</th>
                                        <th>Collo Type</th>
                                        <th>Rectifikasi 1 </th>
                                        <th>No HP Rectifikasi 1 #1</th>
                                        <th>No HP Rectifikasi 1 #2</th>
                                        <th>Rectifikasi 2</th>
                                        <th>No HP Rectifikasi 2 #1</th>
                                        <th>No HP Rectifikasi 2 #2</th>
                                        <th>Rainy Session 1</th>
                                        <th>No HP Rainy Session 1 #1</th>

                                        <th>No HP Rainy Session 1 #2</th>
                                        <th>Rainy Session 2</th>
                                        <th>No HP Rainy Session 2 #1</th>
                                        <th>No HP Rainy Session 2 #2</th>
                                        <th>Digger</th>
                                        <th>No HP Digger #1</th>
                                        <th>No HP Digger #2</th>
                                        <th>Waspanp</th>
                                        <th>No HP Waspang #1</th>
                                        <th>No HP Waspang #2</th>

                                        <th>Vehicle (Car/Motorcycle)</th>
                                        <th>Splicer</th>
                                        <th>OTDR </th>
                                        <th>OPM</th>
                                        <th>FO Cable Single 72</th>
                                        <th>FO Cable Single 36</th>
                                        <th>Cable Fig-8</th>
                                        <th>Cable 72 Ribbon</th>
                                        <th>Closure (PCS)</th>
                                        <th>HDPE 16 (m)</th>

                                        <th>Protection Sleeve (PCS)</th>
                                        <th>Bamboo</th>
                                        <th>PO (In PO/Out PO)</th>
                                        <th>Entity</th>
                                        <th>Project Code </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if(check_access('duty-roster.audit'))
                                            <input type="checkbox"  wire:click="checkdata({{ $item->id }})" wire:model="data_id.{{ $item->id }}" />
                                            @else
                                                @if($item->remarks == '1')
                                                    <a href="javascript:;" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                                @else
                                                    <a href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $item->project }}</td>
                                        <td>{{ $item->tower_index }}</td>
                                        <td>{{ $item->site_id }}</td>
                                        <td>{{ $item->site_name }}</td>
                                        <td>{{ $item->ne_system }}</td>
                                        <td>{{ $item->site_address  }}</td>
                                        <td>{{ $item->cluster }}</td>
                                        <td>{{ $item->sub_cluster }}</td>
                                        <td>{{ $item->region }}</td>
                                        <td>{{ $item->sub_region }}</td>
                                        <td>{{ $item->idpel_pln }}</td>

                                        <td>{{ $item->lat }}</td>
                                        <td>{{ $item->long  }}</td>
                                        <td>{{ $item->category_site }}</td>
                                        <td>{{ $item->depedency }}</td>
                                        <td>{{ $item->pm_category }}</td>
                                        <td>{{ $item->macro_ibc_mcp_repeater }}</td>
                                        <td>{{ $item->site_type }}</td>
                                        <td>{{ $item->permanent_genset  }}</td>
                                        <td>{{ $item->tower_owner }}</td>
                                        <td>{{ $item->id_toco }}</td>
                                        <td>{{ $item->sm }}</td>
                                        <td>{{ $item->sm_no1 }}</td>
                                        <td>{{ $item->sm_no2 }}</td>
                                        <td>{{ $item->coordinator }}</td>
                                        <td>{{ $item->coordinator_no1 }}</td>
                                        <td>{{ $item->coordinator_no2 }}</td>
                                        <td>{{ $item->te }}</td>
                                        <td>{{ $item->te_no1 }}</td>
                                        <td>{{ $item->te_no2 }}</td>
                                        <td>{{ $item->cme }}</td>
                                        <td>{{ $item->cme_no1 }}</td>

                                        <td>{{ $item->cme_no2 }}</td>
                                        <td>{{ $item->collo_type }}</td>
                                        <td>{{ $item->rectifikasi1  }}</td>
                                        <td>{{ $item->rectifikasi1_no1  }}</td>
                                        <td>{{ $item->rectifikasi1_no2  }}</td>
                                        <td>{{ $item->rectifikasi2  }}</td>
                                        <td>{{ $item->rectifikasi2_no1  }}</td>
                                        <td>{{ $item->rectifikasi2_no2  }}</td>
                                        <td>{{ $item->rainy_session1 }}</td>
                                        <td>{{ $item->rainy_session1_no1 }}</td>

                                        <td>{{ $item->rainy_session1_no2 }}</td>
                                        <td>{{ $item->rainy_session2 }}</td>
                                        <td>{{ $item->rainy_session2_no1 }}</td>
                                        <td>{{ $item->rainy_session2_no2 }}</td>
                                        <td>{{ $item->digger }}</td>
                                        <td>{{ $item->digger_no1 }}</td>
                                        <td>{{ $item->digger_no2 }}</td>
                                        <td>{{ $item->waspan }}</td>
                                        <td>{{ $item->waspan_no1 }}</td>
                                        <td>{{ $item->waspan_no2 }}</td>

                                        <td>{{ $item->vehicle }}</td>
                                        <td>{{ $item->splicer }}</td>
                                        <td>{{ $item->otdr  }}</td>
                                        <td>{{ $item->opm }}</td>
                                        <td>{{ $item->fo_cable_single72 }}</td>
                                        <td>{{ $item->fo_cable_single36 }}</td>
                                        <td>{{ $item->cable_fig8 }}</td>
                                        <td>{{ $item->cable_72ribbon }}</td>
                                        <td>{{ $item->closure }}</td>
                                        <td>{{ $item->hdpe  }}</td>

                                        <td>{{ $item->protection_sleeve }}</td>
                                        <td>{{ $item->bamboo }}</td>
                                        <td>{{ $item->po_in_out }}</td>
                                        <td>{{ $item->entity }}</td>
                                        <td>{{ $item->project_code  }}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{route('duty-roster.index')}}"><i class="fa fa-arrow-left"></i> {{ __('Back') }}</a>
                            </div>
                        </div>
                        <br>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-dutyroster-importdutyroster" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:duty-roster.importdutyroster />
        </div>
    </div>
</div>



@section('page-script')


    Livewire.on('modalimportnoc',(data)=>{
        $("#modal-dutyroster-importdutyroster").modal('show');
    });


@endsection