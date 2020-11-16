@section('title', 'Setting')
@section('parentPageTitle', 'Dashboard')

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <ul class="nav nav-tabs">                                
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings">General</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billings">Billings</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preferences">Preferences</a></li>
                </ul>
            </div>
            <div class="tab-content">

                <div class="tab-pane active" id="Settings">
                    <div class="body">
                        <h6>Logo</h6>
                        <form wire:submit.pevent="save">
                            <div class="media photo">
                                <div class="media-left m-r-15">
                                    @if($logoUrl)
                                    <img src="{{$logoUrl}}" class="user-photo media-object" style="height:50px;" alt="User">
                                    @endif
                                </div>
                                <div class="media-body">
                                    @error('logo')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    <p>Upload your logo.
                                        <br> <em>Image should be at least 140px x 140px</em></p>
                                    <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Select File</button>
                                    <input type="file" wire:model="logo" id="filePhoto" class="sr-only">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                    <div class="body">
                        <h6>Basic Information</h6>
                        <form  wire:submit.prevent="updateBasic">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">                                                
                                        <input type="text" class="form-control" placeholder="Company" wire:model="company">
                                    </div>
                                    <div class="form-group">                                                
                                        <input type="text" class="form-control" placeholder="Phone" wire:model="phone">
                                    </div>
                                    <div class="form-group">                                                
                                        <input type="text" class="form-control" placeholder="Email" wire:model="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="http://" wire:model="website">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">    
                                        <textarea class="form-control" wire:model="address" style="height:180px;" placeholder="Address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>

                <div class="tab-pane" id="billings">
                    
                    <div class="body">
                        <h6>Payment Method</h6>
                        <div class="payment-info">
                            <h3 class="payment-name"><i class="fa fa-paypal"></i> PayPal ****2222</h3>
                            <span>Next billing charged $29</span>
                            <br>
                            <em class="text-muted">Autopay on May 12, 2018</em>
                            <a href="javascript:void(0);" class="edit-payment-info">Edit Payment Info</a>
                        </div>
                        <p class="margin-top-30"><a href="javascript:void(0);"><i class="fa fa-plus-circle"></i> Add Payment Info</a></p>
                    </div>

            
                </div>

                <div class="tab-pane" id="preferences">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12">
                            <div class="body">
                                <h6>Your Login Sessions</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="body">
                                <h6>Connected Social Media</h6>
                                <ul class="list-unstyled list-connected-app">
                                    <li>
                                        <div class="connected-app">
                                            <i class="fa fa-facebook app-icon"></i>
                                            <div class="connection-info">
                                                <h3 class="app-title">FaceBook</h3>
                                                <span class="actions"><a href="javascript:void(0);">View Permissions</a> <a href="javascript:void(0);" class="text-danger">Revoke Access</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="connected-app">
                                            <i class="fa fa-twitter app-icon"></i>
                                            <div class="connection-info">
                                                <h3 class="app-title">Twitter</h3>
                                                <span class="actions"><a href="javascript:void(0);">View Permissions</a> <a href="javascript:void(0);" class="text-danger">Revoke Access</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="connected-app">
                                            <i class="fa fa-instagram app-icon"></i>
                                            <div class="connection-info">
                                                <h3 class="app-title">Instagram</h3>
                                                <span class="actions"><a href="javascript:void(0);">View Permissions</a> <a href="javascript:void(0);" class="text-danger">Revoke Access</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="connected-app">
                                            <i class="fa fa-linkedin app-icon"></i>
                                            <div class="connection-info">
                                                <h3 class="app-title">Linkedin</h3>
                                                <span class="actions"><a href="javascript:void(0);">View Permissions</a> <a href="javascript:void(0);" class="text-danger">Revoke Access</a></span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="connected-app">
                                            <i class="fa fa-vimeo app-icon"></i>
                                            <div class="connection-info">
                                                <h3 class="app-title">Vimeo</h3>
                                                <span class="actions"><a href="javascript:void(0);">View Permissions</a> <a href="javascript:void(0);" class="text-danger">Revoke Access</a></span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@section('page-script')

    $(function() {
        // photo upload
        $('#btn-upload-photo').on('click', function() {
            $(this).siblings('#filePhoto').trigger('click');
        });

        // plans
        $('.btn-choose-plan').on('click', function() {
            $('.plan').removeClass('selected-plan');
            $('.plan-title span').find('i').remove();

            $(this).parent().addClass('selected-plan');
            $(this).parent().find('.plan-title').append('<span><i class="fa fa-check-circle"></i></span>');
        });
    });

@stop
