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
                <input type="text" class="form-control" wire:model="keyword" placeholder="Search Name,NIK..." />
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
        <br>
        <div class="row">
            <div class="col-md-1">
                <label><h5>Keyword : </h5></label>
            </div>

            <?php
                $strDate = date('Y-m-d');
                $dateArray = explode("-", $strDate);
                $date = new DateTime();
                $date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
                $week = floor((date_format($date, 'j') - 1) / 7) + 1;
            ?>

            @if($this->filterweek)
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Week : {{$this->filterweek}} </h6></span>
            </div>
            @else
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Week : {{$week}} </h6></span>
            </div>
            @endif

            @if($this->filtermonth)
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Month : {{$this->filtermonth}} </h6></span>
            </div>
            @else
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Month : {{ date_format(date_create(date('Y-m-d')), 'M') }} </h6></span>
            </div>
            @endif

            @if($this->filteryear)
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Year : {{$this->filteryear}} </h6></span>
            </div>
            @else
            <div class="col-md-1">
                <span class="badge badge-primary"><h6> Year : {{date('Y')}} </h6></span>
            </div>
            @endif

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
                        <th>Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <?php
                            if($this->filtermonth && $this->filteryear){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('type', '1')->where('nik', $item->nik)->where('month', $this->filtermonth)->where('year', $this->filteryear);
                            }elseif($this->filtermonth == '' && $this->filteryear){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('type', '1')->where('nik', $item->nik)->where('month', date('m'))->where('year', $this->filteryear);
                            }elseif($this->filtermonth && $this->filteryear == ''){
                                $datatoolsnoc = \App\Models\ToolsNoc::where('type', '1')->where('nik', $item->nik)->where('month', $this->filtermonth)->where('year', date('Y'));
                            }else{
                                $datatoolsnoc = \App\Models\ToolsNoc::where('type', '1')->where('nik', $item->nik)->where('month', date('m'))->where('year', date('Y'));
                            }

                            // $strDate = date('Y-m-d');
                            // $dateArray = explode("-", $strDate);
                            // $date = new DateTime();
                            // $date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
                            // $week = floor((date_format($date, 'j') - 1) / 7) + 1;
                            
                            if($this->filtermonth){
                                if($this->filterweek){
                                    $datatoolsnoc = $datatoolsnoc->where('week', $this->filterweek)->first();
                                }else{
                                      
                                    $datatoolsnoc = $datatoolsnoc->where('week', $week)->first();
                                }
                            }else{
                                $datatoolsnoc = $datatoolsnoc->where('week', $week)->first();
                            }
                            
                            // echo $datatoolsnoc;
                        ?>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$item->nik}}</td>
                        <td><a href="javascript:;" wire:click="$emit('modaladdtoolsnoc',['{{ $item->id }}', '1'])" >{{ strtoupper($item->name) }}</a></td>
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
                        
                        <td>
                            @if(@$datatoolsnoc->status == '1')
                            <span class="badge badge-success" title="Approved"><i class="fa fa-check"></i> Approved </span>
                            @elseif(@$datatoolsnoc->status == '0')
                            <span class="badge badge-danger" title="{{@$datatoolsnoc->note}}"><i class="fa fa-close"></i> Decline </span>
                            @else
                            <span class="badge badge-warning" title="Waiting Approval Admin NOC"><i class="fa fa-history"></i> Waiting Approval </span>
                            @endif
                        </td>

                        <td>
                            @if(@$datatoolsnoc->id)
                                @if(check_access('database-noc.approval'))
                                    @if(@$datatoolsnoc->status == '')
                                    <a href="javascript:;" wire:click="$emit('modalapprove','{{ $datatoolsnoc->id }}')"><span class="badge badge-success" title="Approve"><i class="fa fa-check"></i> Approve </span></a>
                                    <a href="javascript:;" wire:click="$emit('modaldecline','{{ $datatoolsnoc->id }}')"><span class="badge badge-danger" title="Decline"><i class="fa fa-close"></i> Decline </span></a>
                                    @endif
                                @endif
                            @endif

                            @if(@$datatoolsnoc->id)
                                @if(check_access('database-noc.import-revise'))
                                    <a href="#" wire:click="deletedata({{ @$datatoolsnoc->id }})" ><span class="badge badge-danger" title="Delete"><i class="fa fa-trash"></i></span></a>
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