<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan CSI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #b91c1c;
            margin: 0;
        }

        .csi-score {
            text-align: center;
            background: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #ddd;
        }

        .csi-score .score {
            font-size: 36px;
            font-weight: bold;
            color: #b91c1c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
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

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN CUSTOMER SATISFACTION INDEX</h1>
        <h2>Dimsum BOS</h2>
        <p>Periode: {{ \Carbon\Carbon::parse($tanggalMulai)->format('d F Y') }} -
            {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d F Y') }}</p>
    </div>
    <hr>

    @if ($laporanCsi['total_responden'] > 0)
        <div class="csi-score">
            <div class="score">{{ $laporanCsi['indeks_kepuasan'] }}%</div>
            <div>{{ $laporanCsi['kategori_csi'] }}</div>
            <p>Berdasarkan {{ $laporanCsi['total_responden'] }} responden</p>
        </div>

        <h3>Detail per Kategori</h3>
        <table>
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>MIS</th>
                    <th>MSS</th>
                    <th>WF</th>
                    <th>WS</th>
                    <th>Performance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanCsi['detail_kategori'] as $detail)
                    <tr>
                        <td>{{ $detail['nama_kategori'] }}</td>
                        <td>{{ $detail['mis'] }}</td>
                        <td>{{ $detail['mss'] }}</td>
                        <td>{{ $detail['wf'] }}</td>
                        <td>{{ $detail['ws'] }}</td>
                        <td>{{ number_format(($detail['mss'] / 5) * 100, 1) }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 50px;">
            <h3>Tidak Ada Data</h3>
            <p>Tidak ada umpan balik pada periode yang dipilih.</p>
        </div>
    @endif

    <div class="footer">
        <p>Generated on: {{ $generatedAt }}</p>
        <p>&copy; {{ date('Y') }} Dimsum BOS</p>
    </div>
</body>

</html>
