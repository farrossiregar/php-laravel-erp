<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>
    @if(check_access('business-opportunities.add'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-businessopportunities-input" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input New Opportunity')}}</a>
    </div>
    @endif
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th> 
                        <th>Project Name</th> 
                        <th>Quotation Number</th> 
                        <th>PO Number</th> 
                        <th>Region</th> 
                        <th>Quantity</th> 
                        <th>Price Unit</th> 
                        <th>Estimated Revenue</th> 
                        <th>Duration</th> 
                        <th>Brief Description of Project</th> 
                        <!-- <th>Date</th>  -->
                        <th>Status</th> 
                        <th>Customer Type</th> 
                        <th>Created By</th> 
                        <th>Date Created</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->project_name }}</td>
                        <td>{{ $item->quotation_number }}</td>
                        <td>{{ $item->po_number }}</td>
                        <td>{{ $item->region }}</td>
                        <td>{{ $item->qty }} {{ $item->unit }}</td>
                        <td>Rp,{{ format_idr($item->price_or_unit) }}</td>
                        <td>Rp,{{ format_idr($item->estimate_revenue) }}</td>
                        <td><label class="badge badge-info" data-toggle="tooltip" title="{{ date_format(date_create($item->startdate), 'd M Y') }} - {{ date_format(date_create($item->enddate), 'd M Y') }}">{{ $item->duration }}</label></td>
                        <td>{{ $item->brief_description }}</td>
                        <td>
                            @if($item->status == '1')
                                <label class="badge badge-success" data-toggle="tooltip" title="Successful">Successful</label>
                            @endif
                            @if($item->status == '0')
                                <label class="badge badge-danger" data-toggle="tooltip" title="Failed">Unsuccessful</label>
                            @endif
                            @if($item->status == '' || $item->status == 'null')
                                <label class="badge badge-warning" data-toggle="tooltip" title="On going">Opportunity</label>
                            @endif
                        </td> 
                        <td>{{ $item->customer_type }}</td>
                        <td>{{ $item->sales_name }}</td>
                        <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>
                        <td>
                            
                            @if(check_access('business-opportunities.add'))
                                @if($item->status == '' && $item->quotation_number != '' && $item->po_number != '')
                                    <a href="javascript:;" wire:click="$emit('modalwonbo','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Won</a>
                                    <a href="javascript:;" wire:click="$emit('modalfailedbo','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Failed</a>
                                @endif

                            @endif

                            @if(check_access('business-opportunities.add'))
                                @if($item->status == '' || $item->status == null)
                                    <a href="#" wire:click="$emit('modaleditbo','{{ $item->id }}')" title="Edit" class="badge badge-info badge-active"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                @endif

                                @if($item->status == '0')
                                    <a href="#" wire:click="$emit('modaleditbo','{{ $item->id }}')" title="Revisi" class="badge badge-info badge-active"><i class="fa fa-edit"></i> {{__('Revisi')}}</a>
                                @endif
                            @endif
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>