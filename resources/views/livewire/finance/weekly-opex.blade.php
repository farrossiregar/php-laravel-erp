@section('title', __('Weekly Opex'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-2">
                    <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                </div>
                <div class="col-md-2">
                    <a href="javascript:;" data-toggle="modal" data-target="#modal_weekly_opex_budget" class="btn btn-success"><i class="fa fa-database"></i> Budget</a>
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
                                <th>Project Code</th>          
                                <th>Project Name</th>          
                                <th>Region</th>          
                                <th>Sub Region</th>          
                                <th>Month (Bulanan)</th>          
                                <th>Period (Perminggu)</th>          
                                <th>Description</th>          
                                <th>Budget Opex</th>          
                                <th>Previous Balance</th>          
                                <th>Total Transfer</th>          
                                <th>Transfer Date</th>          
                                <th>Cash Transaction No</th>          
                                <th>Settlement Date</th>          
                                <th>Description</th>          
                                <th>Settlement Nominal</th>          
                                <th>Total Settlement</th>
                                <th>Admin to Team</th> 
                                <th>Difference (Admin - Team)</th> 
                                <th>Difference (HQ - Admin)</th>        
                                <th>Account No Recorded</th>
                                <th>Account Name Recorded</th>
                                <th>Nominal Recorded</th>
                                <th>Attachment Document For Settlement</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                </tr>
                            @endforeach
                            @if($data->count()==0)
                                <tr>
                                    <td colspan="18" class="text-center"><i>empty</i></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <br />
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_weekly_opex_budget" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:finance.weekly-opex-budget />
        </div>
    </div>
</div>