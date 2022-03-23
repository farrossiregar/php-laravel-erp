@section('title', __('Drug Test'))
@section('title', __('Training Material'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <ul class="nav nav-tabs-new2">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#dashboard">{{ __('Dashboard') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#data">{{ __('Data') }}</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active show" id="dashboard">
                    @livewire('drugtest.dashboard')
                </div>
                <div class="tab-pane" id="data">
                    @livewire('drugtest.data')
                </div> 
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal_edit_uploaded" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="update_edit_uploaded">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Update Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:loading.remove class="btn btn-success"><i class="fa fa-save"></i> Update</button>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modal_add_drug_test" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent="store_employee">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-plus"></i> Drug Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tahun</label>
                            <span>{{date('Y')}}</span>
                        </div>
                        <div class="form-group">
                            <label class="mr-2">
                                <input type="radio" value="1" wire:model="batch" /> Batch 1
                            </label>
                            <label>
                                <input type="radio" value="2" wire:model="batch" /> Batch 2
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Remark</label>
                            <textarea class="form-control mt-2" wire:model="remark" placeholder="Remark"></textarea>
                        </div>
                        <div class="form-group" wire:ignore>
                            <label>Employee</label>
                            <select class="form-control insert_employee_id" wire:model="employee_id">
                                <option value=""> --- Select --- </option>
                                @foreach(\App\Models\Employee::where('is_use_android',1)->get() as $item)
                                <option value="{{$item->id}}">{{$item->nik}} / {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('employee_id')
                            <span class="text-danger mb-2">{{ $message }}</span>
                        @enderror
                        <div class="form-group mt-2">
                            <label>File</label>
                            <input type="file" class="form-control" wire:model="file" />
                            @error('file')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div wire:loading.remove>
                            <button type="button" class="btn btn-success" wire:click="positif"><i class="fa fa-minus"></i> Negatif</button>
                            <button type="button" class="btn btn-danger" wire:click="negatif"><i class="fa fa-plus"></i> Positif</button>
                        </div>
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>