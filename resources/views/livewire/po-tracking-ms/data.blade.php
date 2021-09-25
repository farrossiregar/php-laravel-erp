<div>
    <div class="header row">
        <div class="col-md-2">
            <input type="text" class="form-control" wire:model="keyword" placeholder="Searching" />
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control date_uploaded" placeholder="Uploaded Date" />
        </div>
        <div class="col-md-2">
            <select class="form-control" wire:model="status">
                <option value=""> --- Status --- </option>
                <option value="0">Regional</option>
                <option value="1">E2E Review</option>
                <option value="2">E2E Upload</option>
                <option value="3">Finance</option>
                <option value="4">Done</option>
            </select>
        </div>
        
        <div class="col-md-1">
            <a href="#" data-toggle="modal" data-target="#modal-potrackingms-uploadmspo" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import MS PO')}}</a>
        </div>

       

        <div class="col-md-3">
            <span wire:loading>
                <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                <span class="sr-only">{{ __('Loading...') }}</span>
            </span>
        </div>
    </div>
    <div class="body pt-0">
        <div class="table-responsive">
            <table class="table table-hover m-b-0 c_list table-nowrap-th">
                <thead>
                    <tr style="background: #eee;">
                        <th>No</th>                               
                        <th>Date Uploaded</th>  
                        
                        <th class="text-center">Status</th>
                        <th>PDS</th>
                        <th>Approval Docs</th>
                        <th>Approved Verification Docs</th>
                        <th>Acceptance Docs</th>
                        <th>Invoice</th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date('d-M-Y',strtotime($item->created_at)) }}</td>
                        <!-- <td>
                            {{ $item->po_reimbursement_id }}
                            <div class="btn-group" role="group">
                                <a class="{{$item->status >=1 ? 'text-success' : 'text-warning' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-{{$item->status==4?'download':'upload'}}"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if($item->status==0) {{-- Upload Approved BAST --}}
                                    @if(check_access('po-tracking.upload-bast'))
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload"><i class="fa fa-upload"></i> Upload BAST</a>
                                    @endif
                                @endif
                                @if($item->status==1) {{-- E2E Review Approve / Reject --}}
                                    @if(check_access('po-tracking.approved-bast'))
                                        <a href="javascript:;" class="dropdown-item text-success" wire:click="$emit('modal-approvebast','{{$item->id}}')" data-toggle="modal" data-target="#modal-potrackingapprovebast-upload" title="Upload"><i class="fa fa-check-circle"></i> {{__('Proccess')}}</a>
                                    @endif
                                @endif
                                @if($item->status==2)  {{-- Esar Upload --}}
                                    @if(check_access('po-tracking.edit-esar'))
                                        <a href="{{route('po-tracking.generate-esar',$item->id)}}" target="_blank" class="dropdown-item"><i class="fa fa-download"></i> Generate ESAR</a>
                                        <a href="javascript:void(0);" class="dropdown-item text-success" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Upload Approved ESAR')}}</a>
                                    @endif
                                @endif
                                @if($item->status==3) {{-- Finance Acceptance --}}
                                    @if(check_access('po-tracking.edit-accdoc'))
                                        <a href="javascript:void(0)" class="dropdown-item text-success" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Upload Acceptance & Invoice Docs')}}</a>
                                    @endif
                                @endif
                                @if(isset($item->bast->bast_filename))
                                    <a href="{{asset("storage/po_tracking/Bast/{$item->bast->bast_filename}")}}" class="dropdown-item" data-toggle="tooltip" title="Download BAST"><i class="fa fa-download"></i> {{__('BAST')}}</a>
                                @endif
                                
                                @if(isset($item->esar->approved_esar_filename))
                                    <a href="javascript:void(0);" class="dropdown-item" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" ata-toggle="tooltip" title="Download Approved ESAR"><i class="fa fa-download"></i> {{__('Approved ESAR')}}</a>
                                    {{-- <a href="{{asset('storage/po_tracking/ApprovedEsar/'.$item->esar->approved_esar_filename)}}" class="dropdown-item" data-toggle="tooltip" title="Download Approved ESAR"><i class="fa fa-download"></i> {{__('Approved ESAR')}}</a> --}}
                                @endif
                                @if(isset($item->acceptance->accdoc_filename))
                                    <a href="{{asset('storage/po_tracking/AcceptanceDocs/'.$item->acceptance->accdoc_filename)}}" class="dropdown-item" data-toggle="tooltip" title="Download Acceptance Docs & Invoice"><i class="fa fa-download"></i> {{__('Acceptance Docs & Invoice')}}</a>
                                @endif
                                </div>
                            </div>
                        </td> -->
                        
                        <td class="text-center">
                            @if($item->status==0)
                                <label class="badge badge-info" data-toggle="tooltip" title="Regional - Upload approved BAST {{$item->is_revisi==1?' - Revisi : '.$item->note : ''}}">Regional {{$item->is_revisi==1?' - R ' : ''}}</label>
                            @endif
                            @if($item->status==1)
                                <label class="badge badge-warning" data-toggle="tooltip" title="E2E - Review">E2E Review </label>
                            @endif
                            @if($item->status==2)
                                <label class="badge badge-primary" data-toggle="tooltip" title="E2E - Generate ESAR, Upload ESAR and Verification Docs">E2E Upload</label>
                            @endif
                            @if($item->status==3)
                                <label class="badge badge-danger" data-toggle="tooltip" title="Finance - Upload Acceptance Docs and Invoice">Finance </label>
                            @endif
                            @if($item->status==4)
                                <label class="badge badge-success" data-toggle="tooltip" title="Done">Done </label>
                            @endif
                        </td>
                        
                        <td>
                            @if($item->pds)
                                <a href=""><i class="fa fa-download"></i> Download PDS</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PDS')}}</a>
                            @endif
                        </td>
                        <td>
                            @if($item->approval_docs)
                                <a href=""><i class="fa fa-download"></i> Download Approval Docs</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modaluploadapprovaldocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approval Docs')}}</a>
                            @endif
                        </td>
                        <td>
                            @if($item->approved_verification)
                                <a href=""><i class="fa fa-download"></i> Download Approved Verification Docs</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modaluploadappverdocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approved Verification Docs')}}</a>
                            @endif
                        </td>
                        <td>
                            @if($item->acceptance_docs)
                                <a href=""><i class="fa fa-download"></i> Download Acceptance Docs</a>
                            @else
                                <a href="javascript:;"  wire:click="$emit('modaluploadaccdocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Acceptance Docs')}}</a>
                            @endif
                        </td>
                        <td></td>
                        <td>

                            <div class="col-md-2">
                                <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingms-uploadpds" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PDS')}}</a> -->
                                <a href="javascript:;" title="Upload" class="btn btn-primary"><i class="fa fa-eye"></i> {{__('Preview')}}</a>
                            </div>

                            <!-- <div class="col-md-2">
                                
                                <a href="javascript:;"  wire:click="$emit('modaluploadpds','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PDS')}}</a>
                            </div> -->
                            
                            <!-- <div class="col-md-2">
                                <a href="javascript:;"  wire:click="$emit('modaluploadapprovaldocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approval Docs')}}</a>
                            </div> -->

                            <!-- <div class="col-md-2">
                                <a href="javascript:;"  wire:click="$emit('modaluploadappverdocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Approved Verification Docs')}}</a>
                            </div> -->

                            <!-- <div class="col-md-2">
                                <a href="javascript:;"  wire:click="$emit('modaluploadaccdocs','{{ $item->id }}')" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import Acceptance Docs')}}</a>
                            </div> -->

                            @if($item->status == '' || $item->status == null)
                                <a href="javascript:;" wire:click="$emit('modalapprovemspo','{{ $item->id }}')" class="btn btn-success"><i class="fa fa-check"></i> Approve</a>
                                <a href="javascript:;" wire:click="$emit('modaldeclinemspo','{{ $item->id }}')" class="btn btn-danger"><i class="fa fa-close"></i> Decline</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
    </div>
    <!--    MODAL REIMBURSEMENT      -->
    <div class="modal fade" id="modal-potracking-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:p-o-tracking.insert />
            </div>
        </div>
    </div>
    <!--    MODAL REIMBURSEMENT      -->
    <!--    MODAL BAST      -->
    <div class="modal fade" id="modal-potrackingbast-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:po-tracking.importbast />
            </div>
        </div>
    </div>
    <!--    END MODAL BAST      -->
    <!--    MODAL ESAR      -->
    <div class="modal fade" id="modal-potrackingesar-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:po-tracking.importesar />
            </div>
        </div>
    </div>
    <!--    END MODAL ESAR      -->
    <!--    MODAL APPROVE BAST      -->
    <div class="modal fade" id="modal-potrackingapprovebast-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:po-tracking.approvebast />
            </div>
        </div>
    </div>
    <!--    END MODAL APPROVE BAST      -->
    <!--    MODAL ACCEPTANCE DOCS      -->
    <div class="modal fade" id="modal-potrackingacceptance-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <livewire:po-tracking.importacceptancedocs />
            </div>
        </div>
    </div>
    <!--    END MODAL ACCEPTANCE DOCS      -->
    @push('after-scripts')
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendor/daterange/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterange/daterangepicker.css') }}" />
    <script>
        $('.date_uploaded').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            autoUpdateInput: false,
        }, function(start, end, label) {
            @this.set("date_start", start.format('YYYY-MM-DD'));
            @this.set("date_end", end.format('YYYY-MM-DD'));
            $('.date_uploaded').val(start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
        });
    </script>
    @endpush
</div>