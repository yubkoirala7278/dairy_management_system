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
    <h2>Milk Deposits Report: </h2>
    <table>
        <thead>
            <tr>
                <th>Member No.</th>
                <th>Owner</th>
                {{-- <th>Type</th> --}}
                <th>Qty (L)</th>
                <th>Fat (%)</th>
                <th>SNF (%)</th>
                <th>Price/L</th>
                <th>Total Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($milkDeposits as $deposit)
                <tr>
                    <td>{{ $deposit->user->farmer_number }}</td>
                    <td>{{ $deposit->user->owner_name }}</td>
                    {{-- <td>{{ $deposit->milk_type }}</td> --}}
                    <td>{{ $deposit->milk_quantity }}</td>
                    <td>{{ $deposit->milk_fat }}</td>
                    <td>{{ $deposit->milk_snf }}</td>
                    <td>{{ $deposit->milk_per_ltr_price_with_commission }}</td>
                    <td>{{ $deposit->milk_total_price }}</td>
                    <td>{{$deposit->milk_deposit_date}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
