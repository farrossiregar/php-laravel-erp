@section('title', __('Duty Roster - Preview'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="row">
                <!-- <div class="col-md-2">
                    <input type="date" class="form-control" wire:model="date" />
                </div> -->

                <div class="col-md-1">                
                    <select class="form-control" wire:model="year">
                        <option value=""> --- Year --- </option>
                        @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
                        <option>{{$item->year}}</option>
                        @endforeach 
                    </select>
                </div>
                <!-- <div class="col-md-2" wire:ignore>
                    <select class="form-control" style="width:100%;" wire:model="month">
                        <option value=""> --- Month --- </option>
                        @foreach(\App\Models\EmployeeNoc::select('month')->groupBy('month')->orderBy('month','ASC')->get() as $item)
                        <option value="{{$item->month}}">{{date('F', mktime(0, 0, 0, $item->month, 10))}}</option>
                        @endforeach
                    </select>
                </div> -->
                
                
                <div class="col-md-12">
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 c_list">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>project</th>
                                    <th>tower_index</th>
                                    <th>site_id</th>
                                    <th>site_name</th>
                                    <th>ne_system</th>
                                    <th>site_address </th>
                                    <th>cluster</th>
                                    <th>sub_cluster</th>
                                    <th>region</th>
                                    <th>sub_region</th>
                                    <th>idpel_pln</th>

                                    <th>lat</th>
                                    <th>long </th>
                                    <th>category_site</th>
                                    <th>depedency</th>
                                    <th>pm_category</th>
                                    <th>macro_ibc_mcp_repeater</th>
                                    <th>site_type</th>
                                    <th>permanent_genset </th>
                                    <th>tower_owner</th>
                                    <th>id_toco</th>
                                    <th>sm</th>
                                    <th>sm_no1</th>
                                    <th>sm_no2</th>
                                    <th>coordinator</th>
                                    <th>coordinator_no1</th>
                                    <th>coordinator_no2</th>
                                    <th>te</th>
                                    <th>te_no1</th>
                                    <th>te_no2</th>
                                    <th>cme</th>
                                    <th>cme_no1</th>

                                    <th>cme_no2</th>
                                    <th>collo_type</th>
                                    <th>rectifikasi1 </th>
                                    <th>rectifikasi1_no1 </th>
                                    <th>rectifikasi1_no2 </th>
                                    <th>rectifikasi2 </th>
                                    <th>rectifikasi2_no1 </th>
                                    <th>rectifikasi2_no2 </th>
                                    <th>rainy_session1</th>
                                    <th>rainy_session1_no1</th>

                                    <th>rainy_session1_no2</th>
                                    <th>rainy_session2</th>
                                    <th>rainy_session2_no1</th>
                                    <th>rainy_session2_no2</th>
                                    <th>digger</th>
                                    <th>digger_no1</th>
                                    <th>digger_no2</th>
                                    <th>waspan</th>
                                    <th>waspan_no1</th>
                                    <th>waspan_no2</th>

                                    <th>vehicle</th>
                                    <th>splicer</th>
                                    <th>othr </th>
                                    <th>opm</th>
                                    <th>fo_cable_single72</th>
                                    <th>fo_cable_single36</th>
                                    <th>cable_fig8</th>
                                    <th>cable_72ribbon</th>
                                    <th>closure</th>
                                    <th>hdpe </th>

                                    <th>protection_sleeve</th>
                                    <th>bamboo</th>
                                    <th>po_in_out</th>
                                    <th>entity</th>
                                    <th>project_code </th>
                                    <th>remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No</td>
                                    <td>project</td>
                                    <td>tower_index</td>
                                    <td>site_id</td>
                                    <td>site_name</td>
                                    <td>ne_system</td>
                                    <td>site_address </td>
                                    <td>cluster</td>
                                    <td>sub_cluster</td>
                                    <td>region</td>
                                    <td>sub_region</td>
                                    <td>idpel_pln</td>

                                    <td>lat</td>
                                    <td>long </td>
                                    <td>category_site</td>
                                    <td>depedency</td>
                                    <td>pm_category</td>
                                    <td>macro_ibc_mcp_repeater</td>
                                    <td>site_type</td>
                                    <td>permanent_genset </td>
                                    <td>tower_owner</td>
                                    <td>id_toco</td>
                                    <td>sm</td>
                                    <td>sm_no1</td>
                                    <td>sm_no2</td>
                                    <td>coordinator</td>
                                    <td>coordinator_no1</td>
                                    <td>coordinator_no2</td>
                                    <td>te</td>
                                    <td>te_no1</td>
                                    <td>te_no2</td>
                                    <td>cme</td>
                                    <td>cme_no1</td>

                                    <td>cme_no2</td>
                                    <td>collo_type</td>
                                    <td>rectifikasi1 </td>
                                    <td>rectifikasi1_no1 </td>
                                    <td>rectifikasi1_no2 </td>
                                    <td>rectifikasi2 </td>
                                    <td>rectifikasi2_no1 </td>
                                    <td>rectifikasi2_no2 </td>
                                    <td>rainy_session1</td>
                                    <td>rainy_session1_no1</td>

                                    <td>rainy_session1_no2</td>
                                    <td>rainy_session2</td>
                                    <td>rainy_session2_no1</td>
                                    <td>rainy_session2_no2</td>
                                    <td>digger</td>
                                    <td>digger_no1</td>
                                    <td>digger_no2</td>
                                    <td>waspan</td>
                                    <td>waspan_no1</td>
                                    <td>waspan_no2</td>

                                    <td>vehicle</td>
                                    <td>splicer</td>
                                    <td>otdr </td>
                                    <td>opm</td>
                                    <td>fo_cable_single72</td>
                                    <td>fo_cable_single36</td>
                                    <td>cable_fig8</td>
                                    <td>cable_72ribbon</td>
                                    <td>closure</td>
                                    <td>hdpe </td>

                                    <td>protection_sleeve</td>
                                    <td>bamboo</td>
                                    <td>po_in_out</td>
                                    <td>entity</td>
                                    <td>project_code </td>
                                    <td>remarks</td>
                                </tr>
                            </tbody>
                        </table>
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