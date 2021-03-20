<html>
    <body>
        <h4>Trouble Ticket : {{$data->trouble_ticket_number}}</h4>
        <table>
            <tbody>
                <tr>
                    <th>Trouble Ticket Number </th>
                    <td> : {{$data->trouble_ticket_number}}</td>
                </tr>
                <tr>
                    <th>Subject </th>
                    <td> : {{$data->subject}}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td> : {{$data->description}}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>