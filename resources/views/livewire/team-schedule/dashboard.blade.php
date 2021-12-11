<div>
  
    <div class="row">
        <div class="col-md-1">                
            <select class="form-control" wire:model="filteryear">
                <option value=""> --- Year --- </option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="filtermonth">
                <option value=""> --- Month --- </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="filterweek">
                <option value=""> --- Week --- </option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{$i}}">Week {{ $i }}</option>
                @endfor
            </select>
        </div>
        <!-- <div class="col-md-2" wire:ignore>
            <select class="form-control" style="width:100%;" wire:model="month">
                <option value=""> --- Project --- </option>
                @for($i = 1; $i <= 12; $i++)
                    <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                @endfor
            </select>
        </div> -->
        <div class="col-md-7">
            <label wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </label>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">
            <div class="table-responsive">
                <table class="table table-striped  table-bordered  m-b-0 c_list">
                    <thead>
                        <tr>
                            <th class="text-center align-middle" width="25%">Staff</th> 
                            <?php
                                if($this->filterweek == ''){
                                    $startdate = 1;
                                }
                                
                                if($this->filterweek == '1'){
                                    $startdate = 1;
                                }

                                if($this->filterweek == '2'){
                                    $startdate = 8;
                                }

                                if($this->filterweek == '3'){
                                    $startdate = 15;
                                }

                                if($this->filterweek == '4'){
                                    $startdate = 22;
                                }

                                if($this->filterweek == '5'){
                                    $startdate = 29;
                                }

                                if($this->filteryear == ''){
                                    $year = date('Y');
                                }else{
                                    $year = $this->filteryear;
                                }

                                if($this->filtermonth == ''){
                                    $month = date('m');
                                }else{
                                    $month = $this->filtermonth;
                                }

                                // for($i = $startdate; $i <= 7; $i++){
                                for($j = $startdate; $j <= 7; $j++){
                                    if(strlen($startdate) < 2){
                                        $startdate = '0'.$startdate;
                                    }else{
                                        $startdate = $startdate;
                                    }
                            ?>
                            <th class="text-center align-middle">{{date('F', mktime(0, 0, 0, $this->filtermonth, 10))}} <?php echo '0'.$j; ?></th>
         
                            <?php
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $i => $item)
                        <?php
                            
                            $colors = array('#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d');
                               
                        ?>
                        <tr>
                            <td class="text-center align-middle">
                                <b>{{$item->name}}</b>
                                <br>
                                {{$item->position}}
                            </td>
                            <?php
                                if($this->filterweek == '1'){
                                    $startdate = 1;
                                }

                                if($this->filterweek == '2'){
                                    $startdate = 8;
                                }

                                if($this->filterweek == '3'){
                                    $startdate = 15;
                                }

                                if($this->filterweek == '4'){
                                    $startdate = 22;
                                }

                                if($this->filterweek == '5'){
                                    $startdate = 29;
                                }

                                if($this->filteryear == ''){
                                    $year = date('Y');
                                }else{
                                    $year = $this->filteryear;
                                }

                                if($this->filtermonth == ''){
                                    $month = date('m');
                                }else{
                                    $month = $this->filtermonth;
                                }

                                
                                for($j = $startdate; $j <= 7; $j++){
                                    if(strlen($startdate) < 2){
                                        $datelist = '0'.$j;
                                    }else{
                                        $datelist = $j;
                                    }
                                $schedule = \App\Models\TeamScheduleNoc::where('name', $item->name)
                                                                        // ->whereMonth('start_schedule', '=', '12')
                                                                        ->whereDate('start_schedule', '=', $year.'-'.$month.'-'.$datelist)
                                                                        ->first();
                                // echo $schedule->name;
                                // echo date('Y').'-'.$month.'-0'.$j;
                            ?>
                            @if($schedule)
                            <td class="text-center align-middle" style="background-color: <?php echo $colors[$i]; ?>;">
                                <b>{{ date_format(date_create($schedule->start_schedule), 'H:i') }} - {{ date_format(date_create($schedule->end_schedule), 'H:i') }}</b> 
                            </td>
                            @else
                            <td >
                               
                            </td>
                            @endif
                            <?php
                                
                                }
                            ?>
                            
                        </tr>
                 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        
    </div>
</div>
