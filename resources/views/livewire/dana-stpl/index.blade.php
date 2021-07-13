@section('title', __('Penggunaan Dana STPL - Index'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model="date" />
                    </div>
                    {{-- @if(check_access('input-dana-stpl')) --}}
                    <div class="col-md-2">
                        <a href="#" data-toggle="modal" data-target="#modal-datastpl-inputdana" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Dana STPL')}}</a>
                    </div>
                    {{-- @endif --}}
                    <div class="col-md-2">
                        <a href="#" data-toggle="modal" data-target="#modal-datastpl-downloadreport" title="Download" class="btn btn-primary"><i class="fa fa-download"></i> {{__('Download Report')}}</a>
                    </div>
                </div>

                <div class="body pt-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 c_list">
                            <thead>
                                <tr>
                                    <th>No</th> 
                                    <th>Date</th>   
                                    <th>Company</th>   
                                    <th>Project Name</th>   
                                    <th>Project Code</th>   
                                    <th>Region</th>   
                                    <th>Project Manager</th>   
                                    <th>Amount</th>   
                                    <th>Status</th>   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ date_format(date_create($item->created_at), 'd M Y') }}</td>    
                                    <td></td>  
                                    <td>{{ $item->project_name }}</td>   
                                    <td>
                                        @if($item->project_id == '1')
                                            CMI
                                        @endif

                                        @if($item->project_id == '2')
                                            H3I
                                        @endif

                                        @if($item->project_id == '3')
                                            ISAT
                                        @endif

                                        @if($item->project_id == '4')
                                            STP
                                        @endif

                                        @if($item->project_id == '5')
                                            XL
                                        @endif
                                    </td>   
                                    <td>{{ $item->region_code }}</td>   
                                    <td>{{ $item->name }}</td>   
                                    <td>Rp {{ format_idr($item->danastpl) }}</td>
                                    <td>
                                        @if($item->status == '0')
                                            <label class="badge badge-danger" data-toggle="tooltip" title="{{ $item->note }}">Revise</label>
                                        @elseif($item->status == null)
                                            <label class="badge badge-warning" data-toggle="tooltip" title="Waiting for SM Approval">Waiting for SM Approval</label>
                                        @else

                                        @endif

                                        @if($item->status == '1')
                                            <label class="badge badge-warning" data-toggle="tooltip" title="Waiting for Manager Security Approval">Waiting for Manager Security Approval</label>
                                        @endif

                                        @if($item->status == '2')
                                            <label class="badge badge-warning" data-toggle="tooltip" title="Waiting for PSM Approval">Waiting for PSM Approval</label>
                                        @endif

                                        @if($item->status == '3')
                                            <label class="badge badge-success" data-toggle="tooltip" title="Pengajuan Dana STPL Approved">Approved</label>
                                        @endif
                                    </td>   
                                    <td>
                                        
                                        @if(check_access('dana-stpl.upload-ir') && $item->status == '3')
                                            <div wire:click="$emit('modaluploadir','{{ $item->id }}')"  id="" title="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Upload IR</div>
                                        @endif


                                        @if(check_access('dana-stpl.revisi') && $item->status == '0')
                                            <div wire:click="$emit('modalrevisidana','{{ $item->id }}')"  title="Revisi" class="btn btn-danger"><i class="fa fa-edit"></i> Revisi</div>
                                        @endif

                                        
                                        @if(check_access('dana-stpl.approve-sm'))
                                            
                                            @if($item->status == null && $item->status != '0')
                                                <div id="" title="submit" class="btn btn-success"><i class="fa fa-check"></i> Approve</div>
                                                <div id="" title="submit" class="btn btn-danger"><i class="fa fa-close"></i> Decline</div>
                                            @endif

                                            @if($item->status == '1')
                                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                                            @endif
                                        @endif


                                        @if(check_access('dana-stpl.approve-ms'))
                                        
                                            @if($item->status == '1')
                                                <div wire:click="$emit('modalapprovedana','{{ $item->id }}')" id="" title="Approve" class="btn btn-success"><i class="fa fa-check"></i> Approve</div>
                                                <div wire:click="$emit('modaldeclinedana','{{ $item->id }}')" id="" title="Decline" class="btn btn-danger"><i class="fa fa-close"></i> Decline</div>
                                            @endif

                                            @if($item->status == '2')
                                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
                                            @endif
                                        @endif

                                        @if(check_access('dana-stpl.approve-psm'))
                                            @if($item->status == '2')
                                                <div wire:click="$emit('modalapprovedana','{{ $item->id }}')" id="" title="submit" class="btn btn-success"><i class="fa fa-check"></i> Approve</div>
                                                <div wire:click="$emit('modaldeclinedana','{{ $item->id }}')" id="" title="submit" class="btn btn-danger"><i class="fa fa-close"></i> Decline</div>
                                            @endif

                                            
                                            @if($item->status == '3')
                                                <label class="badge badge-success" data-toggle="tooltip" title="Approved">Approved</label>
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
        </div>
    </div>
</div>

<div class="modal fade" id="modal-datastpl-inputdana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.inputdana />
        </div>
    </div>
</div>


<div class="modal fade" id="modal-datastpl-revisidana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.revisidana />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-datastpl-uploadir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <livewire:dana-stpl.uploadir />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-datastpl-downloadreport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.downloadreport />
        </div>
    </div>
</div>



<div class="modal fade" id="modal-datastpl-approved" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.approvedana />
        </div>
    </div>
</div>

<div class="modal fade" id="modal-datastpl-decline" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.declinedana />
        </div>
    </div>
</div>


