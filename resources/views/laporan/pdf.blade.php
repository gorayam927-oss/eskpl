<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan E-SKPL</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #111;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
        }

        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e5e7eb;
        }

        th, td {
            border: 1px solid #777;
            padding: 6px;
            vertical-align: top;
        }
    </style>
</head>
<body>

<h2>Laporan Akademik E-SKPL</h2>
<p>Sistem Kontrak Perkuliahan Online</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Kontrak</th>
            <th>Dosen</th>
            <th>Mata Kuliah</th>
            <th>Prodi</th>
            <th>Semester</th>
            <th>Status</th>
            <th>Verifikasi</th>
            <th>Tracking</th>
        </tr>
    </thead>

    <tbody>
        @forelse($kontrak as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->judul_kontrak }}</td>
                <td>{{ $item->dosen->nama_lengkap ?? $item->dosen->user->name ?? '-' }}</td>
                <td>{{ $item->mataKuliah->nama_mk ?? '-' }}</td>
                <td>{{ $item->mataKuliah->prodi->nama_prodi ?? '-' }}</td>
                <td>{{ $item->mataKuliah->semester ?? '-' }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->verifikasi->where('status', 'disetujui')->count() }}</td>
                <td>{{ $item->trackingCapaian->count() }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="9" style="text-align:center;">Tidak ada data</td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>