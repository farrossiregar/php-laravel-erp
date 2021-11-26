<div class="row">
    <div class="col-md-12 mb-2">
        <div class="row">
            <!-- <div class="col-md-1">
                <select class="form-control" wire:model="is_resign">
                    <option value=""> --- Status -- </option>
                    <option value="0">Aktif</option>
                    <option value="1">Resign</option>
                </select>
            </div> -->
            
            
            <div class="col-md-1">                
                <select class="form-control" wire:model="filteryear">
                    <option value=""> --- Year --- </option>
                    @foreach(\App\Models\ToolsNoc::groupBy('year')->get() as $item) 
                    <option value="{{$item->year}}">{{$item->year}}</option>
                    @endforeach 
                </select>
            </div>

            <div class="col-md-1">                
                <select class="form-control" wire:model="filtermonth">
                    <option value=""> --- Month --- </option>
                    @foreach(\App\Models\ToolsNoc::groupBy('month')->get() as $item) 
                    <option value="{{$item->month}}">{{ date_format(date_create($item->created_at), 'M') }}</option>
                    @endforeach 
                </select>
            </div>

            <div class="col-md-1">                
                <select class="form-control" wire:model="filterweek">
                    <option value=""> --- Week --- </option>
                    @if($this->filtermonth)
                    <?php
                    for($i = 1; $i <= 5; $i++){
                    ?>
                    <option value="{{$i}}">{{ $i }}</option>
                    <?php
                    }
                    ?>
                    @endif
                </select>
            </div>

            <div class="col-md-1">                
                <input list="tools" placeholder="Tools" class="form-control" wire:model="filtertools">
                <datalist id="tools">
                    @foreach(\App\Models\ToolsNoc::orderBy('id', 'desc')->groupBy('tools')->get() as $item)
                    <option value="{{ $item->tools }}">
                    @endforeach
                </datalist>
            </div>
            <div class="col-md-1">                
                <input list="software" placeholder="Software"  class="form-control" wire:model="filtersoftware">
                <datalist id="software">
                    @foreach(\App\Models\ToolsNoc::orderBy('id', 'desc')->groupBy('software')->get() as $item)
                    <option value="{{ $item->software }}">
                    @endforeach
                </datalist>
            </div>
            <div class="col-md-3">                
                <input type="text" class="form-control" wire:model="keyword" placeholder="Name,NIK,Tools,Software..." />
            </div>
            <!-- <div class="col-md-2">
                
                <a href="javascript:;" wire:click="$emit('modaladdtoolsnoc')" class="btn btn-info"><i class="fa fa-plus"></i> Add</a>
            </div> -->
            <!-- <div class="col-md-1">
                <span wire:loading>
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                    <span class="sr-only">{{ __('Loading...') }}</span>
                </span>
            </div> -->
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
                        
                        <!-- <th>Status</th> -->
                        <!-- <th></th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <?php
                            if($this->filtermonth && $this->filteryear){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('nik', $item->nik)->where('month', $this->filtermonth)->where('year', $this->filteryear);
                            }elseif($this->filtermonth == '' && $this->filteryear){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('nik', $item->nik)->where('month', date('m'))->where('year', $this->filteryear);
                            }elseif($this->filtermonth && $this->filteryear == ''){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('nik', $item->nik)->where('month', $this->filtermonth)->where('year', date('Y'));
                            }else{
                                $datatoolsnoc = \App\Models\ToolsNoc::where('nik', $item->nik)->where('month', date('m'))->where('year', date('Y'));
                            }

                            if($this->filtermonth){
                                if($this->filterweek){
                                    $datatoolsnoc = $datatoolsnoc->where('week', $this->filterweek)->first();
                                }else{
                                    $datatoolsnoc = $datatoolsnoc->where('week', '1')->first();
                                }
                            }else{
                                $datatoolsnoc = $datatoolsnoc->first();
                            }
                            
                            // echo $datatoolsnoc;
                        ?>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->nik}}</td>
                        <td><a href="javascript:;" wire:click="$emit('modaladdtoolsnoc','{{ $item->id }}')" >{{ strtoupper($item->name) }}</a></td>
                        <td>
                            <?php
                                echo @$datatoolsnoc->tools;
                            ?>
                        </td>
                        <td>
                            <?php
                                echo @$datatoolsnoc->software;
                            ?>
                        </td>
                        
                      
                        <!-- <td>
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
                        </td> -->
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