@section('title', __('PO Tracking Non MS STP Detail'))
@section('parentPageTitle', 'Home Detail')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-md-12">
                    <b><h5>Auto Generated Esar</h5></b> 
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
                                    <th>Project Name</th>                               
                                    <th>Project Code</th>                               
                                    <th>Acceptance Date</th>                               
                                    <th>Subcontractor Name</th>                               
                                    <th>Subcontractor No</th>                               
                                    <th colspan=2 class="text-center">Esar</th>           
                                    <th class="text-center">Esar Status</th>           
                                </tr>
                                @foreach($data as $key => $item)
                                <?php
                                    $key = $key+1;
                                ?>
                                <tr>
                                    <th>No</th>                               
                                    <th>No PO</th>                               
                                    <th>Project Name</th>                               
                                    <th>Project Code</th>                               
                                    <th>Acceptance Date</th>                               
                                    <th>Subcontractor Name</th>                               
                                    <th>Subcontractor No</th>                               
                                    <th colspan=2 class="text-center">Esar</th>           
                                    <th class="text-center">Esar Status</th>           
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









