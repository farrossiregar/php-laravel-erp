@section('title', __('PO Tracking Acceptance Docs Detail'))
@section('parentPageTitle', 'Home Detail')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>Acceptance Docs</h5></b> 
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-potrackingesar-upload" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Import PO Tracking ESAR')}}</a> -->
                    <br>
                </div>
                <table class="table table-striped m-b-0 c_list">
                    <div class="col-md-2">
                        <select class="form-control" name="status" wire:model="status">
                            <option value=""> --- Status --- </option>
                            <option value="1">Completed</option>
                            <option value="">Waiting Approval</option>
                        </select>
                    </div>

                </table>
            </div>
            <div class="body pt-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped m-b-0 c_list">
                                <tr>
                                    <th>No</th>                               
                                    <th>No PO</th>                                      
                                    <th>Acceptance Docs Date Upload</th>                                  
                                    <th>Acceptance Docs User Upload</th>                                  
                                    <th colspan=2 class="text-center">Acceptance Docs</th>          
                                </tr>

                                @foreach($data as $key => $item)
                                <tr>
                                    <th></th>                               
                                    <th>{{ $item->po_no }}</th>                               
                                    <th>{{ $item->acceptance_date }}</th>                               
                                    <th></th>     
                                    <th></th>     
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>


<!--    MODAL ESAR      -->
<div class="modal fade" id="modal-potrackingesar-upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <livewire:po-tracking.importesar />
        </div>
    </div>
</div>


<!--    END MODAL ESAR      -->

@push('after-scripts')
<script>
    Livewire.on('modalesarupload',(data)=>{
        console.log(data);
        $("#modal-potrackingesar-upload").modal('show');
    });
</script>
@endpush







