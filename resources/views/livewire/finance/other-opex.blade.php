@section('title', __('Other Opex'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_other_opex_budget" class="btn btn-success"><i class="fa fa-database"></i> Budget</a>
                    <!-- <a href="javascript:;" data-toggle="modal" data-target="#modal_weekly_opex_type" class="btn btn-info"><i class="fa fa-database"></i> Type</a> -->
                </div>
                <div class="col-md-8">
                    <span wire:loading>
                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                        <span class="sr-only">{{ __('Loading...') }}</span>
                    </span>
                </div>
            </div>
            <div class="body pt-0">
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <thead style="background:#eee;">
                            <tr>
                                <th>No</th>
                                <th>Status</th>
                                <th>Project Code</th>          
                                <th>Project Name</th>          
                                <th>Period</th>          
                                <th>Description</th>          
                                <th>PR No</th>          
                                <th>PO No</th>          
                                <th>Budget Opex</th> 
                                <th>Advance Date</th>         
                                <th>Advance Nominal</th>
                                <th>Difference</th>          
                                <th>Settlement Nominal</th>
                                <th>Submitted Date</th>          
                                <th>Cash Transaction No</th>
                                <th>Attachment Document For Advance</th>     
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_other_opex_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.other-opex-budget />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_weekly_opex_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-type />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_process" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-process />
        </div>
    </div>
</div>

<div class="modal fade" id="modal_weekly_opex_settle" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-settle />
        </div>
    </div>
</div>
<div class="modal fade" id="modal_weekly_opex_settle_detail" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-settle-detail />
        </div>
    </div>
</div>