<form wire:submit.prevent="save">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-database"></i> Budget</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true close-btn">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <form wire:submit.prevent="save">
                <table class="table">
                    <thead style="background:#eee;">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Year</th>
                            <th>Department</th>
                            <th class="text-right">Budget</th>
                            <th class="text-right">Used</th>
                            <th class="text-right">Remain</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $k =>  $item)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$item->year}}</td>
                                <td>{{isset($item->department->name) ? $item->department->name : '-'}}</td>
                                <td class="text-right">{{format_idr($item->amount)}}</td>
                                <td class="text-right">{{format_idr($item->used)}}</td>
                                <td class="text-right">{{format_idr($item->remain)}}</td>
                            </tr>
                        @endforeach
                        @if($insert)
                            <tr>
                                <td></td>
                                <td>
                                    <input type="number" class="form-control" wire:model="year" placeholder="Year" />
                                    @error('year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('validate_unique')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
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
            </form>
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