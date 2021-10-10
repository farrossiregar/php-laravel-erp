<div class="row">
    <div class="col-md-2">
        <input type="date" class="form-control" wire:model="date" />
    </div>

<!--     
    <div class="col-md-1">                
        <select class="form-control" wire:model="year">
            <option value=""> --- Year --- </option>
            @foreach(\App\Models\EmployeeNoc::select('year')->groupBy('year')->get() as $item) 
            <option>{{$item->year}}</option>
            @endforeach 
        </select>
    </div> -->


    @if(check_access('business-opportunities.add'))
    <div class="col-md-2">
        <a href="#" data-toggle="modal" data-target="#modal-vendormanagement-input" title="Add" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input New Supplier Registration')}}</a>
    </div>
    @endif
    
    
    
    
    <div class="col-md-12">
        <br><br>
        <div class="table-responsive">
            <table class="table table-striped m-b-0 c_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier Name</th> 
                        <th>Supplier PIC</th> 
                        <th>Supplier Category</th> 
                        <th>Legal</th> 
                        <th>Org Chart</th> 
                        <th>Tools & Resource</th> 
                        <th>Certification of Resources</th> 
                        <th>Scoring</th> 
                        <th>Supplier Registered Date</th> 
                        <th>Status</th> 
                        <th>Date Created</th> 
                        <th>Action</th> 
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>