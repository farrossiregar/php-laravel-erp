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
            <div class="col-md-2">
        
        <a href="javascript:;" wire:click="$emit('modaladdtoolsnoc')" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>
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
                        <th>Tools</th> 
                        <th>Software</th> 
                        
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
                        <td>{{$item->name}}</td>
                        <td>{{$item->name}}</td>
                        
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