@section('title', __('Vendor Management - Input'))
@section('parentPageTitle', 'Home')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="tab-content">      
                <div class="header row">
                    <div class="col-md-8">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-eye"></i> Evaluation Score</h5>
                    </div>
                    <div class="col-md-4">
                        <form wire:submit.prevent="save">
                            @csrf
                            
                            <button type="submit" class="btn btn-info close-modal"><i class="fa fa-download"></i> Download Scoring</button>
                            
                        </form>
                    </div>
                    
                </div>

                <hr>
                <div class="body pt-0">
                    <div class="form-group">
                        <form wire:submit.prevent="save">
                            
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="col-md-4 form-group">
                                        <input type="number" min='0' max="100" class="form-control" wire:model="team_availability_capability" readonly/>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 form-group">
                                    <hr />
                                    
                                    <button type="submit" class="btn btn-info close-modal"><i class="fa fa-edit"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>