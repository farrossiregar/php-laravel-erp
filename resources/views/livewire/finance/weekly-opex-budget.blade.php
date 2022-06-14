<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-database"></i> Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <table class="table">
                <thead style="background:#eee;">
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Project</th>
                        <th>Region</th>
                        <th>Sub Region</th>
                        <th>Week</th>
                        <th class="text-right">Budget</th>
                        <!-- <th class="text-right">Actualized</th>
                        <th class="text-right">Remaining Budget</th> -->
                    </tr>
                </thead>
                <?php 
                
                ?>
                <tbody>
                    @foreach($data as $k =>  $item)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>{{isset($item->project) ? \App\Models\ClientProject::where('id',$item->project)->first()->name : '-'}}</td>
                            <td>{{isset($item->region) ? \App\Models\Region::where('id',$item->region)->first()->region : '-'}}</td>
                            <td>{{isset($item->sub_region->name) ? $item->sub_region->name : '-'}}</td>
                            
                            <td>{{$item->week}}</td>
                            <td class="text-right">@livewire('finance.weekly-opex-editable',['data'=>$item,'field'=>'amount'],key($item->id))</td>
                            <!-- <td class="text-right">{{format_idr($item->used)}}</td>
                            <td class="text-right">{{format_idr($item->remain)}}</td> -->
                        </tr>
                    @endforeach
                    @if($insert)
                        <tr>
                            <td></td>
                            <td>
                                <select class="form-control" wire:model="project_id">
                                    <option value=""> -- Select Project -- </option>
                                    @foreach(\App\Models\ClientProject::orderBy('name','ASC')->where('is_project',1)->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="region">
                                    <option value=""> -- Select Region -- </option>
                                    @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $item)
                                        <option value="{{$item->id}}">{{$item->region}}</option>
                                    @endforeach
                                </select>
                                @error('project_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="subregion">
                                    <option value=""> -- Select Subregion -- </option>
                                    @if($region)
                                        @foreach(\App\Models\SubRegion::where('region_id',$region)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('project_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="week">
                                    <option value=""> -- Select Week -- </option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                </select>
                                @error('week')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" class="form-control text-right" wire:model="budget" placeholder="Budget" />
                                @error('budget')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>                            
                        </tr>
                        <tr>
                            <td colspan="5">
                                <button wire:loading.remove wire:target="save" type="submit" class="badge badge-info badge-active"><i class="fa fa-save"></i> Save</button>
                                <a href="javascript:void(0)" wire:loading.remove wire:target="save" wire:click="$set('insert',false)" class="badge badge-danger badge-active"><i class="fa fa-close"></i> Cancel</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            @if($insert==false)
                <a href="javascript:void(0)" wire:click="$set('insert',true)" class="badge badge-info badge-active"><i class="fa fa-plus"></i> Budget</a>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <span wire:loading>
            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
            <span class="sr-only">{{ __('Loading...') }}</span>
        </span>
    </div>
</form>