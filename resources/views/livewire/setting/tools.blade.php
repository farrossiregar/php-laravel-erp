<div class="body">
    <div class="row pt-0">
        <!-- <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped m-b-0 c_list">
                    <thead style="white-space: nowrap;">
                        @foreach($tools as $tool)
                            <tr><th>{{$tool->name}}</th></tr>
                        @endforeach
                    </thead>
                </table>
            </div>
        </div> -->
        <div class="col-md-4">
            <h6>Toolbox Item</h6>
            <div class="table-responsive">
                <table class="table table-striped m-b-0 c_list">
                    <thead style="white-space: nowrap;">
                        @foreach($toolbox as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                            </tr>
                        @endforeach
                    </thead>
                </table>
                <div x-data="{ insert:false }">
                    <div class="form-group" x-show="insert" @click.away="insert = false">
                        <input type="text" placeholder="Name Toolbox..." class="form-control" wire:keydown.enter="save_toolbox" x-on:keydown.enter="insert = false" x- wire:model="name_toolbox" />
                    </div>
                    <a href="javascript:;" @click="insert = true"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        @livewire('setting.tools-laptop')
    </div>
</div>
