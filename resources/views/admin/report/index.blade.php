<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Laporan Transaksi</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Event</th>
                <th>Nama Sponsor</th>
                <th>Dana Sponsorship</th>
                <th>Tanggal Pembayaran</th>
                <th>Tanggal Penarikan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->event->name ?? 'N/A' }}</td>
                    <td>{{ $transaction->sponsor->name ?? 'N/A' }}</td>
                    <td>{{ number_format($transaction->level->fund ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $transaction->payment_date ?? 'N/A' }}</td>
                    <td>{{ $transaction->withdraw_date ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
