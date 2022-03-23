<html>
    <body>
        <h4>Stolen Asset : {{$data->tower->name}}</h4>
        <table>
            <tbody>
                <tr>
                    <th>Site </th>
                    <td> : {{isset($data->site->site_id) ? $data->site->site_id .'/'. $data->site->name : '' }}</td>
                </tr>
                <tr>
                    <th>Region </th>
                    <td> : {{isset($data->region->region) ? $data->region->region : '' }}</td>
                </tr>
                <tr>
                    <th>Cluster </th>
                    <td> : {{isset($data->cluster->name) ? $data->cluster->name : '' }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>