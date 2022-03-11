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
        <div class="col-md-6">
            @if(check_access('po-tracking.import'))
                <a href="#" data-toggle="modal" data-target="#modal-potracking-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking')}}</a> 
            @endif
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
                        <th>PO Number</th>
                        <th>PO Date</th>
                        <th class="text-center">Status</th>
                        <th>Period</th>
                        <th>Region<s/th>
                        <th>Branch</th>
                        <th>BOQ</th>
                        <th>No BAST</th>
                        <th>No GR</th>
                        <th>GR Date</th>
                        <th>No Invoice</th>
                        <th>Invoice Date</th>
                        <th>Actual Amount (Based on Bon)</th>
                        <th>Amount To be Claimed (Acceptable EID)</th>
                        <th>Date of Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @php($is_upload_bast = check_access('po-tracking.upload-bast'))
                    @php($is_approved_bast = check_access('po-tracking.approved-bast'))
                    @php($is_edit_esar = check_access('po-tracking.edit-esar'))
                    @php($is_edit_accdoc = check_access('po-tracking.edit-accdoc'))
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ date('d-M-Y',strtotime($item->created_at)) }}
                            <div class="btn-group" role="group">
                                <a class="{{$item->status >=1 ? 'text-success' : 'text-warning' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-{{$item->status==4?'download':'upload'}}"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if($item->status==0) {{-- Upload Approved BAST --}}
                                    @if($is_upload_bast)
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload"><i class="fa fa-upload"></i> Upload BAST</a>
                                    @endif
                                @endif
                                @if($item->status==1) {{-- E2E Review Approve / Reject --}}
                                    @if($is_approved_bast)
                                        <a href="javascript:;" class="dropdown-item text-success" wire:click="$emit('modal-approvebast','{{$item->id}}')" data-toggle="modal" data-target="#modal-potrackingapprovebast-upload" title="Upload"><i class="fa fa-check-circle"></i> {{__('Proccess')}}</a>
                                    @endif
                                @endif
                                @if($item->status==2)  {{-- Esar Upload --}}
                                    @if($is_edit_esar)
                                        <a href="{{route('po-tracking.generate-esar',$item->id)}}" target="_blank" class="dropdown-item"><i class="fa fa-download"></i> Generate ESAR</a>
                                        <a href="javascript:void(0);" class="dropdown-item text-success" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Supporting Docs')}}</a>
                                    @endif
                                @endif
                                @if($item->status==3) {{-- Finance Acceptance --}}
                                    @if($is_edit_accdoc)
                                        <a href="javascript:void(0)" class="dropdown-item text-success" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Upload Acceptance & Invoice Docs')}}</a>
                                    @endif
                                @endif
                                @if(isset($item->bast->bast_filename))
                                    <a href="{{asset("storage/po_tracking/Bast/{$item->bast->bast_filename}")}}" class="dropdown-item" data-toggle="tooltip" title="Download BAST"><i class="fa fa-download"></i> {{__('BAST')}}</a>
                                @endif
                                @if(isset($item->esar->approved_esar_filename))
                                    <a href="javascript:void(0);" class="dropdown-item" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" ata-toggle="tooltip" title="Download Approved ESAR"><i class="fa fa-download"></i> {{__('Supporting Docs')}}</a>
                                @endif
                                @if(isset($item->acceptance->accdoc_filename))
                                    <a href="{{asset('storage/po_tracking/AcceptanceDocs/'.$item->acceptance->accdoc_filename)}}" class="dropdown-item" target="_blank"  data-toggle="tooltip" title="Download Acceptance Docs & Invoice"><i class="fa fa-download"></i> {{__('Acceptance Docs')}}</a>
                                @endif
                                @if(isset($item->invoice_file))
                                    <a href="{{asset('storage/po_tracking/AcceptanceDocs/'.$item->invoice_file)}}" target="_blank" class="dropdown-item"><i class="fa fa-download"></i> {{__('Invoice Docs')}}</a>
                                @endif
                                </div>
                            </div>
                        </td>
                        <td>{{$item->po_no}}</td>
                        <td>{{$item->po_date}}</td>
                        <td class="text-center">
                            @if($item->status==0)
                                <label class="badge badge-info" data-toggle="tooltip" title="Regional - Upload approved BAST {{$item->is_revisi==1?' - Revisi : '.$item->note : ''}}">Regional / SM {{$item->is_revisi==1?' - R ' : ''}}</label>
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
                                <label class="badge badge-success" data-toggle="tooltip" title="Completed">Completed </label>
                            @endif
                        </td>
                        <td>{{date('Y M',strtotime($item->period))}}</td>
                        <td>{{$item->region}}</td>
                        <td>{{$item->branch}}</td>
                        <td>{{$item->boq}}</td>
                        <td>
                            @if(isset($item->bast->bast_filename))
                                <a href="{{asset("storage/po_tracking/Bast/{$item->bast->bast_filename}")}}" target="_blank">{{$item->bast_number}}</a>
                            @else
                                {{$item->bast_number}}
                            @endif
                        </td>
                        <td>{{$item->gr_no}}</td>
                        <td>{{$item->gr_date}}</td>
                        <td>{{$item->invoice_no}}</td>
                        <td>{{$item->invoice_date}}</td>
                        <td class="text-right">{{format_idr($item->actual_amount)}}</td>
                        <td class="text-right">{{format_idr($item->amunt_to_be_claim)}}</td>
                        <td>{{$item->date_of_payment}}</td>
<!--                         
                        <td>{{$item->fuel_refuel}}</td>
                        <td>{{$item->bbm_type}}</td>
                        <td class="text-right">{{format_idr($item->article_code)}}</td>
                        <td class="text-right">{{format_idr($item->price_liter)}}</td>
                        <td class="text-right">{{format_idr($item->total_price)}}</td>
                        <td class="text-right">{{format_idr($item->acceptable_amount)}}</td>
                        <td>{{$item->eid_check}}</td> -->
                        <!-- <td>
                            {{ $item->po_reimbursement_id }}
                            <div class="btn-group" role="group">
                                <a class="{{$item->status >=1 ? 'text-success' : 'text-warning' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-{{$item->status==4?'download':'upload'}}"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if($item->status==0) {{-- Upload Approved BAST --}}
                                    @if($is_upload_bast)
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="$emit('modal-bast',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingbast-upload"><i class="fa fa-upload"></i> Upload BAST</a>
                                    @endif
                                @endif
                                @if($item->status==1) {{-- E2E Review Approve / Reject --}}
                                    @if($is_approved_bast)
                                        <a href="javascript:;" class="dropdown-item text-success" wire:click="$emit('modal-approvebast','{{$item->id}}')" data-toggle="modal" data-target="#modal-potrackingapprovebast-upload" title="Upload"><i class="fa fa-check-circle"></i> {{__('Proccess')}}</a>
                                    @endif
                                @endif
                                @if($item->status==2)  {{-- Esar Upload --}}
                                    @if($is_edit_esar)
                                        <a href="{{route('po-tracking.generate-esar',$item->id)}}" target="_blank" class="dropdown-item"><i class="fa fa-download"></i> Generate ESAR</a>
                                        <a href="javascript:void(0);" class="dropdown-item text-success" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Supporting Docs')}}</a>
                                    @endif
                                @endif
                                @if($item->status==3) {{-- Finance Acceptance --}}
                                    @if($is_edit_accdoc)
                                        <a href="javascript:void(0)" class="dropdown-item text-success" wire:click="$emit('modal-acceptancedocs',{{$item->id}})" data-toggle="modal" data-target="#modal-potrackingacceptance-upload" title="Upload"><i class="fa fa-upload"></i> {{__('Upload Acceptance & Invoice Docs')}}</a>
                                    @endif
                                @endif
                                @if(isset($item->bast->bast_filename))
                                    <a href="{{asset("storage/po_tracking/Bast/{$item->bast->bast_filename}")}}" class="dropdown-item" data-toggle="tooltip" title="Download BAST"><i class="fa fa-download"></i> {{__('BAST')}}</a>
                                @endif
                                
                                @if(isset($item->esar->approved_esar_filename))
                                    <a href="javascript:void(0);" class="dropdown-item" wire:click="$emit('modalesarupload','{{$item->id}}')"  data-toggle="modal" data-target="#modal-potrackingesar-upload" ata-toggle="tooltip" title="Download Approved ESAR"><i class="fa fa-download"></i> {{__('Supporting Docs')}}</a>
                                @endif
                                @if(isset($item->acceptance->accdoc_filename))
                                    <a href="{{asset('storage/po_tracking/AcceptanceDocs/'.$item->acceptance->accdoc_filename)}}" class="dropdown-item" data-toggle="tooltip" title="Download Acceptance Docs & Invoice"><i class="fa fa-download"></i> {{__('Acceptance Docs & Invoice')}}</a>
                                @endif
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($item->status==0)
                                <label class="badge badge-info" data-toggle="tooltip" title="Regional - Upload approved BAST {{$item->is_revisi==1?' - Revisi : '.$item->note : ''}}">Regional / SM {{$item->is_revisi==1?' - R ' : ''}}</label>
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
                                <label class="badge badge-success" data-toggle="tooltip" title="Completed">Completed </label>
                            @endif
                        </td>
                        <td>{{ $item->change_history }}</td>
                        <td>{{ $item->rep_office }}</td>
                        <td>{{ $item->customer }}</td>
                        <td>{{ $item->project_name }}</td>
                        <td>{{ $item->project_code }}</td>
                        <td>{{ $item->site_id }}</td>
                        <td>{{ $item->sub_contract_no }}</td>
                        <td>{{ $item->pr_no }}</td>
                        <td>{{ $item->sales_contract_no }}</td>
                        <td>{{ $item->po_status }}</td>
                        <td>{{ $item->po_no }}</td>
                        <td>{{ $item->site_code }}</td>
                        <td>{{ $item->site_name }}</td>
                        <td>{{ $item->po_line_no }}</td>
                        <td>{{ $item->shipment_no }}</td>
                        <td>{{ $item->item_description }}</td>
                        <td>{{ $item->requested_qty }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->center_area }}</td>
                        <td>{{ $item->start_date }}</td>
                        <td>{{ $item->end_date }}</td>
                        <td>{{ $item->billed_qty }}</td>
                        <td>{{ $item->due_qty }}</td>
                        <td>{{ $item->qty_cancel }}</td>
                        <td>{{ $item->item_code }}</td>
                        <td>{{ $item->version_no }}</td>
                        <td>{{ $item->line_amount }}</td>
                        <td>{{ $item->bidding_area }}</td>
                        <td>{{ $item->tax_rate }}</td>
                        <td>{{ $item->currency }}</td>
                        <td>{{ $item->ship_to }}</td>
                        <td>{{ $item->engineering_code }}</td>
                        <td>{{ $item->engineering_name }}</td>
                        <td>{{ $item->payment_terms }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->payment_method }}</td>
                        <td>{{ $item->product_category }}</td>
                        <td>{{ $item->bill_to }}</td>
                        <td>{{ $item->subproject_code }}</td>
                        <td>{{ $item->expire_date }}</td>
                        <td>{{ $item->publish_date }}</td>
                        <td>{{ $item->acceptance_date }}</td>
                        <td>{{ $item->ff_buyer }}</td>
                        <td>{{ $item->note_to_receiver }}</td>
                        <td>{{ $item->fob_lookup_code }}</td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br />
        {{$data->links()}}
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