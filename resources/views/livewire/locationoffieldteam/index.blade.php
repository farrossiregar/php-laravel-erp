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
                            @foreach($region as $region)
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
                                <th>NIK</th>   
                                <th>Employee</th>   
                                <th>Region</th>   
                                <th>Telepon</th>   
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Last Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num=$data->firstItem())
                            @foreach($data as $k => $item)
                                <tr>
                                    <td>{{$num}}</td>
                                    <td>{{$item->nik}}</td>
                                    <td><a href="javascript:void(0)" onclick="openMarker({{$k}})" class="text-danger" style="font-size:18px;"><i class="fa fa-map-marker"></i></a> {{isset($item->_employee->name) ? $item->_employee->name : ''}}</td>
                                    <td>
                                        @if(isset($item->_employee->region->region))
                                            <a href="javascript:void(0)" wire:click="$set('region_id', {{$item->_employee->region_id}})">{{isset($item->_employee->region->region) ? $item->_employee->region->region : ''}}</a>
                                        @endif
                                    </td>
                                    <td>{{isset($item->_employee->telepon) ? $item->_employee->telepon : ''}}</td>
                                    <td>{{$item->lat}}</td>
                                    <td>{{$item->long}}</td>
                                    <td>{{$item->updated_at}}</td>
                                </tr>
                                @php($num++)
                            @endforeach
                            @if($data->count() ==0)
                            <tr>
                                <td colspan="9" class="text-center"><i>empty</i></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div><br >
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtT77hTHKmcPY9RtqKLL1fH_tE9Wae6Hg&callback=initMap&libraries=&v=weekly" async></script>
<script>
    let map;
    let markers = [];
    var markerCluster;
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -0.789275, lng: 113.921326 },
            zoom: 5,
        });

        @foreach($raw_data as $key => $em)
            @if(empty($em->lat) and empty($em->long)) @continue @endif
                
            var content  = '<div class="p-2">';
                content += '<p>NIK : {{$em->nik}}<br />';
                content += 'Name : {{$em->name}}<br />';
                content += '</p></div>';

            addMarker({lat:{{$em->lat}}, lng:{{$em->long}}},content,{{$key}})
        @endforeach
        markerCluster = new markerClusterer.MarkerClusterer({ markers, map });
    }

    // Adds a marker to the map and push to the array.
    function addMarker(location,str,key) {
        const infowindow = new google.maps.InfoWindow({
            content: str,
        });
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });

        // marker.addListener("click", () => {
        //     infowindow.open({
        //         anchor: marker,
        //         map,
        //         shouldFocus: true,
        //     });
        // });

        google.maps.event.addListener(marker, 'click', (function (marker, key) {
            return function () {
                map.setZoom(11);
                map.setCenter(marker.getPosition());
                    infowindow.open({
                        anchor: marker,
                        map,
                        shouldFocus: true,
                    });
            }
            })(marker, key));

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

    function openMarker(key){
        console.log("Open marker : "+key);
        google.maps.event.trigger(markers[key], 'click');
    }

    Livewire.on('reinit-map',(data)=>{
        var result = data    
        clearMarkers();
        markers = [];
        
        for (var key in result) {
            var content  = '<div class="p-2">';
                content += '<p>NIK : '+result[key]['nik']+'<br />';
                content += 'Name : '+result[key]['name']+'<br />';
                content += '</p></div>';
            addMarker( { lat: parseFloat(result[key]['lat']), lng: parseFloat(result[key]['long']) } ,content,result[key]['id']);
        }

        markerCluster.clearMarkers();
        markerCluster = new markerClusterer.MarkerClusterer({ markers, map }); 
    });
</script>
@endpush
