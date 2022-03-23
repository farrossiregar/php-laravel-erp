<div>
    <div class="card">
        <div class="body">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#web-based">Web Based </a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#mobile-apps">Mobile Apps</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active pt-2" id="web-based">
                    <h6>PMT Module Development Process</h6>
                    <div class="table-responsive pt-1">
                        <table class="table table-striped m-b-0 c_list table-nowrap-th table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>                                    
                                    <th>Department</th>                                    
                                    <th>Sub Department</th>                                    
                                    <th>Project Owner</th>                                    
                                    <th>Business Owner</th>                                    
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($web_based as $item)
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane pt-2" id="mobile-apps">
                    <h6>Mobile Apps Design</h6>
                    <div class="table-responsive pt-1">
                        <table class="table table-striped m-b-0 c_list table-nowrap-th table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>                                    
                                    <th>Items</th>                                    
                                    <th>Frequency</th>                                    
                                    <th>Remark</th>                                    
                                    <th>Status</th>                                    
                                    <th>Web Report</th>                                    
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
