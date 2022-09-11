<div>
    <div class="header row px-0">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Keyword" />
        </div>
        <div class="col-md-2">
            <input type="date" class="form-control" wire:model="date" />
        </div>
        <div class="col-md-8">
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body pt-0 px-0">    
        <div class="table-responsive" style="min-height:200px;">
            <table class="table table-striped m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>PO No</th>    
                        <th>Date PO Release (sc)</th>    
                        <th>Date PO Release (sys)</th>
                        <th>Contract Number</th>
                        <th>Contract Date</th>
                        <th>BAST Number</th>
                        <th>BAST Date</th>
                        <th>GR Number</th>
                        <th>GR Date</th>
                        <th>Works</th>
                        <th>Project</th>
                        <th class="text-right">Requested Budget</th>
                        <th>VAT (%)</th>
                        <th>Total Price</th>
                        <th>WHT (%)</th>
                        <th>Total Invoice</th>
                        <th class="text-right">Extra Budget</th>
                        <th><div style="width:50px;"></div></th>
                    </tr>
                </head>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

