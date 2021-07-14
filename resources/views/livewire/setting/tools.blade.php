<div class="body">
    <div class="row pt-0">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-striped m-b-0 c_list">
                    <thead style="white-space: nowrap;">
                        <tr>
                            <th>Tools Check</th>
                            @foreach($tools as $tool)
                                <th>{{$tool}}</th>
                            @endforeach
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
