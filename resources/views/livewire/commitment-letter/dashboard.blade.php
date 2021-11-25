<div class="row">
    <div class="col-md-12">
        <div class="row">
            <!-- 
    
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Keyword" wire:model="keyword" />
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" wire:model="date" />
            </div> -->
            <!-- <div class="col-md-2">
                <select onclick="" class="form-control" required wire:model="employee_id">
                    <option value=""> --- Month --- </option>
                
                    <option value=""></option>
                
                </select>
            </div>

            <div class="col-md-2">
                <select onclick="" class="form-control" required wire:model="employee_id">
                    <option value=""> --- Year --- </option>
                    
                    <option value=""></option>
                    
                </select>
            </div>
            
            <div class="col-md-2">
                <a href="{{ route('accident-report.insert') }}" title="Add" class="btn btn-primary"><i class="fa fa-search"></i> {{__('Submit')}}</a>
            </div> -->

            @if(check_access('commitment-letter.admin') || check_access('commitment-letter.pic'))
            <div class="col-md-2">
                <!-- <select onclick="" class="form-control" required wire:model="company_name">
                    <option value=""> --- Company Name --- </option>
                    <option value="1">HUP</option>
                    <option value="2">PMT</option>
                    
                </select> -->

                <input list="project" class="form-control"  wire:model="project">
                <datalist id="project" >
                    @foreach($dataproject as $item)
                    <option value="{{ $item->name }}">
                    @endforeach
                </datalist>
            </div>
            @endif
            <div class="col-md-4">
            <h5>Summary {{ $this->project }}</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-striped m-b-0 c_list">
                        <thead>
                            <tr>
                                <th>No</th> 
                                <th>Region</th> 
                                <th>Done</th> 
                                <th>Not Done</th> 
                                <th>Grand Total</th> 
                                <th>Done (%)</th> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->region }}</td>
                                <td>
                                    <?php
                                        // $done = App\Models\CommitmentLetter::where('region', $item->region)->where('bcg', '!=', NULL)->where('cyber_security', '!=', NULL)->where('status', '1')->orderBy('id', 'desc')->get();
                                        $done = App\Models\CommitmentLetter::where('region', $item->region)->where('status', '1')->orderBy('id', 'desc')->get();
                                        
                                        echo count($done);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $notdone = count(App\Models\CommitmentLetter::where('region', $item->region)->where('status', '')->orderBy('id', 'desc')->get()) + count(App\Models\CommitmentLetter::where('region', $item->region)->where('status', '0')->orderBy('id', 'desc')->get()) + count(App\Models\CommitmentLetter::where('region', $item->region)->where('status', NULL)->orderBy('id', 'desc')->get());
                                        // $notdone = App\Models\CommitmentLetter::where('region', $item->region)->orderBy('id', 'desc')->get();
                                        // $notdone = App\Models\CommitmentLetter::where('region', $item->region)->where('bcg', Null)->orwhere('cyber_security', Null)->where('status', '1')->orderBy('id', 'desc')->groupBy('region')->get();
                                        // $notdone = App\Models\CommitmentLetter::where('region', 'West')->where(function ($query) {
                                        //                                                                                 $query->where('bcg', Null)
                                        //                                                                                     ->orwhere('cyber_security', Null);
                                        //                                                                             })->
                                        //                                                                             orwhere(function ($query) {
                                        //                                                                                 $query->where('bcg', Null)
                                        //                                                                                     ->where('cyber_security', Null);
                                        //                                                                             })->where('status', '1')->orderBy('id', 'desc')->groupBy('region')->get();
                                        // echo count($notdone) - count($done);
                                        echo $notdone;
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        $grand = App\Models\CommitmentLetter::where('region', $item->region)->get();
                                        echo count($grand);
                                    ?>
                                </td>
                                <td>
                                <?php
                                
                                    if(count($done) == 0){
                                        $total = 0;
                                    }else{
                                        $total = count($done) / count($grand) * 100;
                                    }
                                    
                                    echo $total.'%';
                                ?>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
    
    

    
    
</div>