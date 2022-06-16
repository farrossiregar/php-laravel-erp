
@section('title', $data->po_number)
@section('parentPageTitle', 'PO Tracking Non MS')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">   
                <form wire:submit.prevent="submit">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>BAST Number</label>
                            <input type="text" class="form-control" wire:model="bast_number" />
                            @error('bast_number')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>BAST Date</label>
                            <input type="date" class="form-control" wire:model="bast_date" />
                            @error('bast_date')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>Works</label>
                            <input type="text" class="form-control" wire:model="works" />
                            @error('works')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label>Project</label>
                            <select class="form-control" wire:model="project">
                                <option value=""> -- select -- </option>
                                @foreach(\App\Models\ClientProject::where('is_project',1)->get() as $item)
                                    <option>{{$item->name}}</option>
                                @endforeach   
                            </select>
                            <!-- <input type="text" class="form-control" wire:model="project" /> -->
                            @error('project')
                                <ul class="parsley-errors-list filled" id="parsley-id-29"><li class="parsley-required">{{ $message }}</li></ul>
                            @enderror
                        </div>
                        <!-- <div class="form-group col-md-2">
                            <label>Amount : </label> {{format_idr($data->payment_amount)}}
                        </div> -->
                    </div>
                    <div class="table-responsive mt-4">
                        <ul class="nav nav-tabs">
                            @if(isset($data->wos_group))
                                @foreach($data->wos_group as $k => $item)
                                    @if($active_tab=="") @php($active_tab=$item->id) @endif
                                    <li class="nav-item"><a class="nav-link {{$active_tab==$item->id ? 'active show' : ''}}" wire:click="$set('active_tab',{{$item->id}})" data-toggle="tab" href="#tab_{{$item->id}}">{{ $item->wo->no_tt }}</a></li>
                                @endforeach
                            @endif
                            <li> 
                                <span wire:loading>
                                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                                    <span class="sr-only">{{ __('Loading...') }}</span>
                                </span>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @if(isset($data->wos_group))
                                @foreach($data->wos_group as $k => $item)
                                    <div class="tab-pane {{ $active_tab ==$item->id ? 'show active' : ''}}" id="tab_{{$item->id}}">
                                        @if(isset($item->wo->bast_file))
                                            <div class="row">
                                                @foreach($item->wo->bast_file as $img)
                                                    <div class="col-md-2" x-data="{open:false}">
                                                        <div class="p-3 text-center" @click.away="open = false">
                                                            <a href="javascript:void(0);" wire:click="delete_image({{$img->id}})" class="badge badge-danger badge-active" style="position: absolute;top: 2px;right: 30px;"><i class="fa fa-trash"></i></a>
                                                            <img src="{{asset($img->image)}}" style="width:80%" />
                                                            <div x-show="open"> 
                                                                <input type="number" class="form-control mt-1" style="width: 70px;" wire:keydown.enter="save_bast" x-on:keydown.enter="open = false" style="padding:0 10px" wire:model="ordering" />
                                                                <textarea class="form-control" wire:keydown.enter="save_bast" x-on:keydown.enter="open = false" wire:model="description"></textarea>
                                                            </div>
                                                            <div x-show="open==false"> 
                                                                Ordering : {{$img->ordering}}<br />
                                                                {{$img->description}}
                                                                <a href="javascript:void(0)" @click="open = true" wire:click="set_id({{$img->id}})"><i class="fa fa-edit"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <hr />
                    <a href="javascript:void(0)" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</a>
                    <a href="{{route('po-tracking-nonms.po-generate-bast',['data'=>$data->id])}}" target="_blank" class="btn btn-warning ml-3"><i class="fa fa-download"></i> Preview BAST</a>
                    <a href="javascript:void(0)" class="btn btn-info ml-2" wire:click="save"><i class="fa fa-save"></i> Save as Draft</a>
                    <button stype="submit" class="btn btn-success ml-2"><i class="fa fa-check-circle"></i> Submit BAST</button>
                </form>
            </div>
        </div>
    </div>
</div>