<div class="row">
    <div class="col-md-12 mb-2">
        <div class="row">
            <div class="col-md-1">
                <select class="form-control" wire:model="is_resign">
                    <option value=""> --- Status -- </option>
                    <option value="0">Aktif</option>
                    <option value="1">Resign</option>
                </select>
            </div>
            <div class="col-md-3">                
                <input type="text" class="form-control" wire:model="keyword" placeholder="Name,NIK,ID KTP, Telepon..." />
            </div>
            <div class="col-md-1">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
            </div>
        </div>    
    </div>
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th> 
                        <th>Name</th> 
                        <th>Position</th> 
                        <th>Region</th> 
                        <th>Cluster</th> 
                        <th>Project</th> 
                        <th>Phone</th> 
                        <th>Phone1</th> 
                        <th>Phone2</th> 
                        <th>Emergency Contact Name</th> 
                        <th>Emergency Number</th> 
                        <th>Contract Start</th> 
                        <th>Contract End</th> 
                        <th>Resignation Date</th> 
                        <th>Resignation Reason</th> 
                        <th>Account Name</th> 
                        <th>Bank Name</th> 
                        <th>Account Number</th> 
                        <th>No KTP</th> 
                        <th>Address KTP</th> 
                        <th>Domisili</th> 
                        <th>Post Code</th> 
                        <th>Birth Place</th> 
                        <th>Date of Birth</th> 
                        <th>Gender</th> 
                        <th>Marital Status</th> 
                        <th>Tax Status</th> 
                        <th>Mothers Name</th> 
                        <th>Email</th> 
                        <th>Religion</th> 
                        <th>BPJS JHT</th> 
                        <th>BPJS Pensiun</th> 
                        <th>BPJS Kesehatan</th> 
                        <th>NPWP</th> 
                        <th>Level of Education</th> 
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->name}}</td>
                        <td></td>
                        <td>{{isset($item->region->region) ? $item->region->region : '-'}}</td>
                        <td>{{isset($item->cluster->name) ? $item->cluster->name : '-'}}</td>
                        <td></td>
                        <td>{{$item->telepon}}</td>
                        <td>{{$item->telepon2}}</td>
                        <td>{{$item->telepon3}}</td>
                        <td>{{$item->emergency_contact}}</td>
                        <td>{{$item->emergency_number}}</td>
                        <td>{{$item->contract_start ? date('d/m/Y',strtotime($item->contract_start)) : '-'}}</td>
                        <td>{{$item->contract_end ? date('d/m/Y',strtotime($item->contract_end)) : '-'}}</td>
                        <td>{{$item->resign_date ? date('d/m/Y',strtotime($item->resign_date)) : '-'}}</td>
                        <td>{{$item->resignation_reason}}</td>
                        <td>{{$item->account_name}}</td>
                        <td>{{$item->bank_name}}</td>
                        <td>{{$item->account_number}}</td>
                        <td>{{$item->ktp}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->domisili}}</td>
                        <td>{{$item->postcode}}</td>
                        <td>{{$item->place_of_birth}}</td>
                        <td>{{$item->date_of_birth}}</td>
                        <td>{{$item->gender}}</td>
                        <td>{{marital_status($item->marital_status)}}</td>
                        <td>{{$item->tax_status}}</td>
                        <td>{{$item->mothers_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->religion}}</td>
                        <td>{{$item->bpjs_jht}}</td>
                        <td>{{$item->bpjs_pensiun}}</td>
                        <td>{{$item->bpjs_number}}</td>
                        <td>{{$item->npwp_number}}</td>
                        <td>{{$item->education_level}}</td>
                        <td>
                            @if($item->is_resign==0)
                                <span class="badge badge-success"><i class="fa fa-check"></i> Aktif</span>
                            @else
                                <span class="badge badge-danger"><i class="fa fa-times"></i> Resign</span>
                            @endif
                        </td>
                        <td>
                            @if($item->is_approve_admin_noc===0)
                                @if(check_access('database-noc.approval'))
                                    <div x-data="{open:false}" class="text-center" @click.away="open = false">
                                        <template x-if="open==false">
                                            <a href="javascript:void(0)" x-on:click="open = ! open" class="badge badge-warning" title="Waiting Approval Admin NOC"><i class="fa fa-history"></i> Admin NOC</a>
                                        </template>
                                        <div x-show="open" class="mt-2">
                                            <a href="javascript:void(0)" class="badge badge-success" wire:click="approve({{$item->id}})"><i class="fa fa-check"></i> Approve</a>
                                            <a href="javascript:void(0)" class="badge badge-danger" wire:click="reject({{$item->id}})"><i class="fa fa-times"></i> Reject</a>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge badge-warning" title="Waiting Approval Admin NOC"><i class="fa fa-history"></i> Admin NOC</span>
                                @endif
                            @else
                                @if($item->is_resign==0)
                                    <a href="javascript:void(0)" onclick="confirm_resign({{$item->id}})" class="badge badge-danger"><i class="fa fa-edit"></i> Update Resign</a>
                                @else
                                    <a href="javascript:void(0)" onclick="confirm_aktif({{$item->id}})" class="badge badge-success"><i class="fa fa-edit"></i> Update Aktif</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{$data->links()}}
    </div>
    @push('after-scripts')
        <script>
            function confirm_resign(id){
                if(confirm("Update resign employee ?")){
                    @this.updateResign(id);
                }
            }
            function confirm_aktif(id){
                if(confirm("Update aktif employee ?")){
                    @this.updateAktif(id);
                }
            }
        </script>
    @endpush
</div>