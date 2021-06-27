@section('title', __('Location of Field Team'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div class=" row">
                    <div class="col-md-2">
                        <select class="form-control" wire:model="region_Id">
                            <option value=""> --- Region --- </option>
                            @foreach(\App\Models\Region::orderBy('region','ASC')->get() as $region)
                                <option value="{{$region->id}}">{{$region->region}}</option>   
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control" wire:model="keyword" placeholder="Searching..." />
                    </div>
                    <div class="col-md-6">
                        <span wire:loading>
                            <i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i>
                            <span class="sr-only">{{ __('Loading...') }}</span>
                        </span>
                    </div>
                </div>
                <div id="map" style="height: 500px;"></div>
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <thead>
                            <tr style="background:#eee;">
                                <th style="width:50">No</th>                                    
                                <th>Employee</th>   
                                <th>Telepon</th>   
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$k+1}}</td>
                                    <td><a href="javascript:void(0)" class="text-danger" style="font-size:18px;"><i class="fa fa-map-marker"></i></a> {{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                                    <td>{{isset($item->_employee->telepon) ? $item->_employee->telepon : ''}}</td>
                                    <td>{{$item->lat}}</td>
                                    <td>{{$item->long}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                            @endforeach
                            @if($data->count() ==0)
                            <tr>
                                <td colspan="9" class="text-center"><i>empty</i></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0yhWQE7Vt4an2T4MvpAYPpCD8Ul9NyxA&callback=initMap&libraries=&v=weekly" async></script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -0.789275, lng: 113.921326 },
            zoom: 5,
        });

        @foreach($data as $em)
        @if(empty($em->lat) and empty($em->long)) @continue @endif
            const marker{{$em->id}} =  new google.maps.Marker({
                position: {lat:{{$em->lat}},lng:{{$em->long}}},
                map,
                title: "{{isset($item->_employee->name) ? $item->_employee->name : ''}}",
            });

            const infowindow{{$em->id}} = new google.maps.InfoWindow({
                        content: "<p>{{$em->_employee->name}}</p>",
                    });
            marker{{$em->id}}.addListener("click", () => {
                infowindow{{$em->id}}.open({
                anchor: marker{{$em->id}},
                map,
                shouldFocus: false,
                });
            });
        @endforeach
    }
</script>
@endpush
