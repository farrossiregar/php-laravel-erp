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
                                    <button type="button" class="btn btn-default-dark" id="btn-upload-photo">Upload Logo</button>
                                    <input type="file" wire:model="logo" id="filePhoto" class="sr-only">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>

                    <div class="body">
                        <h6>Basic Information</h6>
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
                                    <div>
                                        <label class="fancy-radio">
                                            <input name="gender2" value="male" type="radio" checked>
                                            <span><i></i>Male</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input name="gender2" value="female" type="radio">
                                            <span><i></i>Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Birthdate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="http://">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">                                                
                                    <input type="text" class="form-control" placeholder="Address Line 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address Line 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="State/Province">
                                </div>
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="">-- Select Country --</option>
                                      
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                        <button type="button" class="btn btn-default">Cancel</button>
                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <h6>Account Data</h6>
                                <div class="form-group">                                                
                                    <input type="text" class="form-control" value="alizeethomas" disabled placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" wire:model="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" wire:model="telepon" placeholder="Phone Number">
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <h6>Change Password</h6>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Current Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm New Password">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                        <button class="btn btn-default">Cancel</button>
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
