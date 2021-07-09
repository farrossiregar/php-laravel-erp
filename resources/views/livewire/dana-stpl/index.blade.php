@section('title', __('Penggunaan Dana STPL'))
@section('parentPageTitle', 'Home')



<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
           
            <div class="tab-content">
                                
                <div class="header row">
                    <div class="col-md-2">
                        <input type="date" class="form-control" wire:model="date" />
                    </div>
                    
                    <div class="col-md-2">
                        <a href="#" data-toggle="modal" data-target="#modal-datastpl-inputdana" title="Upload" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('Input Dana STPL')}}</a>
                    </div>
                </div>

                <div class="body pt-0">

                    
                    <div class="table-responsive">
                        <table class="table table-striped m-b-0 c_list">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>PO No</th>    
                                    <th>Bulan</th>   
                                    <th>Company</th>   
                                    <th>Status</th>   
                                    <th>Note</th>   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>PO No</td>    
                                    <td>Bulan</td>    
                                    <td>Company</td>    
                                    <td><label class="badge badge-info" data-toggle="tooltip" title="Regional - Waiting to Submit">Waiting to Submit</label></td>   
                                    <td></td>
                                    <td>
                                        <div id="" title="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Upload IR</div>
                                        <div id="" title="submit" class="btn btn-danger"><i class="fa fa-edit"></i> Revisi</div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modal-datastpl-inputdana" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <livewire:dana-stpl.inputdana />
        </div>
    </div>
</div>

<script>
    Livewire.on('modalinputpono',(data)=>{
        $("modal-datastpl-inputdana").modal('show');
    });

</script>











