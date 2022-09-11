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
                        <!-- <th>Year</th> -->
                        <th>Department</th>
                        <th>Sub Department</th>
                        <th class="text-right">Year</th>
                        <th class="text-right">Monthly Budget</th>
                        <th class="text-right">Actualized</th>
                        <th class="text-right">Remaining Budget</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k =>  $item)
                        <tr>
                            <td>{{$k+1}}</td>
                            <!-- <td>{{$item->year}}</td> -->
                            <td>{{isset($item->department->name) ? $item->department->name : '-'}}</td>
                            <td>{{isset($item->sub_department->name) ? $item->sub_department->name : '-'}}</td>
                            <td class="text-right">{{isset($item->year) ? $item->year : '-'}}</td>
                            <td class="text-right">@livewire('finance.petty-cash-editable',['data'=>$item,'field'=>'amount'],key($item->id))</td>
                            <!-- <td class="text-right">{{format_idr($item->amount)}}</td> -->
                          
                            <td class="text-right">{{format_idr($item->used)}}</td>
                            <td class="text-right">{{format_idr($item->remain)}}</td>
                        </tr>
                    @endforeach
                    @if($insert)
                        <tr>
                            <td></td>
                            <td>
                                <select class="form-control" wire:model="department_id">
                                    <option value=""> -- Select Department -- </option>
                                    @foreach(\App\Models\Department::orderBy('name','ASC')->where('is_project',0)->get() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <select class="form-control" wire:model="sub_department_id">
                                    <option value=""> -- Select Sub Department -- </option>
                                    @if($department_id)
                                        @foreach(\App\Models\DepartmentSub::orderBy('name','ASC')->where('department_id',$department_id)->get() as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('department_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>

                            <td>
                                <select class="form-control" wire:model="year">
                                    <option value=""> -- Year -- </option>
                                    
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    
                                </select>
                            </td>

                            <td>
                                <input type="number" class="form-control text-right" wire:model="budget" placeholder="Budget" />
                                @error('budget')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
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