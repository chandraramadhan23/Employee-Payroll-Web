<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Gaji</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body style="font-family: Arial, Helvetica, sans-serif">

    <div class="container">
        <h3 class="text-start mt-4 mb-2">Laporan Data Gaji</h3>
        <div class="mb-4">
            <p>Laporan data gaji karyawan bulan <strong>{{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}</strong> tahun <strong>{{ $tahun }}</strong></p>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Bagian</th>
                    <th>Gaji Pokok</th>
                    <th>Transport</th>
                    <th>Total Potongan</th>
                    <th>Total Gaji</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->no }}</td>
                    <td>{{ $row->nik }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->bagian }}</td>
                    <td>{{ $row->gaji_pokok }}</td>
                    <td>{{ $row->transport }}</td>
                    <td>{{ $row->total_potongan }}</td>
                    <td>{{ $row->total_gaji }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>




    <script>
        window.print()
    </script>
</body>
</html>
