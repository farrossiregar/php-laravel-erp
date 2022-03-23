<html>
    <body>
        <h4>Incident Report</h4>
        @if($data->status==1)
            <table>
                <tbody>
                    <tr>
                        <th>Nama Pelapor / Requester	 </th>
                        <td> : {{$data->employee->name}}</td>
                    </tr>
                    <tr>
                        <th>NIK	 </th>
                        <td> : {{$data->employee->nik}}</td>
                    </tr>
                    <tr>
                        <th>Email	 </th>
                        <td> : {{$data->employee->name}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Kejadian	 </th>
                        <td> : {{$data->tanggal_kejadian}}</td>
                    </tr>
                    <tr>
                        <th>Department	 </th>
                        <td> : {{isset($data->employee->department->name) ? $data->employee->department->name : ''}}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td> : {{$data->lokasi}}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td> : {{$data->category}}</td>
                    </tr>
                    <tr>
                        <th>Uraian Masalah</th>
                        <td> : {{$data->description}}</td>
                    </tr>
                </tbody>
            </table>
        @elseif($data->status==2)
            Your incident report is Accept <b>{{isset($data->pic->name) ? $data->pic->name : ''}}</b>, Incident Number  : <strong>{{$data->incident_number}}</strong>
        @elseif($data->status==3)
            <p>Your incident report <strong>{{$data->incident_number}}</strong> is solved </p>
            <table>
                <tbody>
                    <tr>
                        <th>Kategori</th>
                        <td> : {{$data->category}}</td>
                    </tr>
                    <tr>
                        <th>Uraian Masalah</th>
                        <td> : {{$data->description}}</td>
                    </tr>
                    <tr>
                        <th>Impact</th>
                        <td> : {{$data->impact}}</td>
                    </tr>
                    <tr>
                        <th>Root Cause</th>
                        <td> : {{$data->root_cause}}</td>
                    </tr>
                    <tr>
                        <th>Action Plan</th>
                        <td> : {{$data->action_plan}}</td>
                    </tr>
                    <tr>
                        <th>Recom dmendation</th>
                        <td> : {{$data->recommendation}}</td>
                    </tr>
                </tbody>
            </table>
        @elseif($data->status==3)
            <p>Your incident report <strong>{{$data->incident_number}}</strong> is unsolved</p>
            <table>
                <tbody>
                    <tr>
                        <th>Kategori</th>
                        <td> : {{$data->category}}</td>
                    </tr>
                    <tr>
                        <th>Uraian Masalah</th>
                        <td> : {{$data->description}}</td>
                    </tr>
                    <tr>
                        <th>Impact</th>
                        <td> : {{$data->impact}}</td>
                    </tr>
                    <tr>
                        <th>Root Cause</th>
                        <td> : {{$data->root_cause}}</td>
                    </tr>
                    <tr>
                        <th>Action Plan</th>
                        <td> : {{$data->action_plan}}</td>
                    </tr>
                    <tr>
                        <th>Recom dmendation</th>
                        <td> : {{$data->recommendation}}</td>
                    </tr>
                </tbody>
            </table>
        @endif
    </body>
</html>