<table>
    <thead>
        <tr>
            <th>Submitted Date</th>
            <th>Name</th>
            <th>Mobile No.</th>
            <th>Email</th>
            <th>Message</th>
           
            
        </tr>
    </thead>
    <tbody>
        @foreach ($enquiries as $enquiry)
            <tr>
                <td>{{ date('d/m/y', strtotime($enquiry->created_at)) }}</td>
                <td>{{ $enquiry->name }}</td>
               
               
           
                <td>
                    @if ($enquiry->phone)
                        {{ $enquiry->phone }}
                    @else
                        Not Provided
                    @endif
                </td>
                <td>
                    @if ($enquiry->email)
                        {{ $enquiry->email }}
                    @else
                        Not Provided
                    @endif
                </td>
                <td>
                    @if ($enquiry->message)
                        {{ $enquiry->message }}
                    @else
                        Not Provided
                    @endif
                </td>
               
               

            </tr>
        @endforeach

    </tbody>
</table>
