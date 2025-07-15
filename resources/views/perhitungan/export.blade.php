<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin-bottom: 5px; }
        .header p { margin-top: 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .badge-success { background-color: #28a745; color: white; padding: 3px 6px; border-radius: 3px; }
        .badge-danger { background-color: #dc3545; color: white; padding: 3px 6px; border-radius: 3px; }
        .page-break { page-break-after: always; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Jumlah yang lulus: {{ $jumlah_lulus }} dari {{ count($calculations) }}</p>
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>

    <h2>Hasil Perhitungan VIKOR</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Ranking</th>
                <th>Alternatif</th>
                <th>Nilai S</th>
                <th>Nilai R</th>
                <th>Nilai Q</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 0; @endphp
            @foreach($calculations as $calc)
                @php
                    $counter++;
                    $lulus = $counter <= $jumlah_lulus;
                @endphp
                <tr class="{{ $lulus ? 'lulus' : 'tidak-lulus' }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $calc->ranking }}</td>
                    <td>{{ $calc->alternatif->nama_alternatif }}</td>
                    <td>{{ number_format($calc->nilai_s, 4) }}</td>
                    <td>{{ number_format($calc->nilai_r, 4) }}</td>
                    <td>{{ number_format($calc->nilai_q, 4) }}</td>
                    <td>
                        @if($lulus)
                            <span class="badge-success">Memenuhi Kriteria</span>
                        @else
                            <span class="badge-danger">Tidak Memenuhi Kriteria</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total peserta: {{ count($calculations) }} | Jumlah lulus: {{ min($jumlah_lulus, count($calculations)) }}</p>
    </div>
</body>
</html>
