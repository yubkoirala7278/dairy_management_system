<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @font-face {
            font-family: 'Noto Sans Devanagari';
            font-style: normal;
            font-weight: 400;
            src: url('{{ storage_path('fonts/NotoSansDevanagari.ttf') }}') format("truetype");
        }

        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body style="font-family: 'NotoSansDevanagari', sans-serif;">
    <h2>Farmers Report: </h2>
    <table>
        <thead>
            <tr>
                <th>Member No.</th>
                <th>Owner</th>
                <th>Location</th>
                {{-- <th>Gender</th> --}}
                <th>Phone</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($farmerInformation as $farmer)
                <tr>
                    <td>{{ $farmer->farmer_number }}</td>
                    <td>{{ $farmer->owner_name }}</td>
                    <td>{{ $farmer->location }}</td>
                    {{-- <td>{{ $farmer->gender }}</td> --}}
                    <td>{{ $farmer->phone_number }}</td>
                    <td>{{ $farmer->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
