@section('title', __('Location of Field Team'))
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="body">
                <div id="map" style="height: 500px;" wire:ignore></div>
                <div class="row mt-3">
                    <div class="col-md-2">
                        <select class="form-control" wire:model="region_id" wire:ignore>
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
                <div class="table-responsive">
                    <table class="table m-b-0 c_list">
                        <thead>
                            <tr style="background:#eee;">
                                <th style="width:50">No</th>                                    
                                <th>Employee</th>   
                                <th>Region</th>   
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
                                    <td>
                                        @if(isset($item->_employee->region->region))
                                            <a href="javascript:void(0)" wire:click="$set('region_id', {{$item->_employee->region_id}})">{{isset($item->_employee->region->region) ? $item->_employee->region->region : ''}}</a>
                                        @endif
                                    </td>
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
    let markers = [];

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -0.789275, lng: 113.921326 },
            zoom: 5,
        });

        @foreach($data as $em)
            @if(empty($em->lat) and empty($em->long)) @continue @endif
            
            var str = "<div id=\"content\"><h6>{{$em->name}}</h6></div>";

            addMarker({lat:{{$em->lat}}, lng:{{$em->long}}},str)
        @endforeach
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location,str) {
        const infowindow = new google.maps.InfoWindow({
            content: str,
        });
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });
        marker.addListener("click", () => {
            infowindow.open({
            anchor: marker,
            map,
            shouldFocus: false,
            });
        });
        markers.push(marker);
    }

    function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function clearMarkers() {
        setMapOnAll(null);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    Livewire.on('reinit-map',(data)=>{
        var result = data.data    
        clearMarkers();
        markers = [];
        
        for (var key in result) {
            var str = "<div id=\"content\"><h6>"+result[key]['name']+"</h6></div>";

            addMarker( { lat: parseFloat(result[key]['lat']), lng: parseFloat(result[key]['long']) } ,str);

            console.log(result[key]['lat']);    
            console.log(result[key]['long']);    
        }
    });
</script>
@endpush
