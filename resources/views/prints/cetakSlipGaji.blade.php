<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Slip Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Slip Gaji Karyawan</h1>

        <!-- Informasi Karyawan -->
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>NIK</th>
                    <td>{{ $karyawan->nik }}</td>
                    <th>Nama</th>
                    <td>{{ $karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Bagian</th>
                    <td>{{ $karyawan->bagian }}</td>
                    <th>Jenis Kelamin</th>
                    <td>{{ $karyawan->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Bulan</th>
                    <td>{{ $bulan }}</td>
                    <th>Tahun</th>
                    <td>{{ $tahun }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Tabel Gaji dan Potongan -->
        <h3 class="mt-4">Rincian Gaji dan Potongan</h3>
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>Rp {{ number_format($karyawan->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Transport</td>
                    <td>Rp {{ number_format($karyawan->transport, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Alpha ({{ $kehadiran->alpha ?? 0 }} hari)</td>
                    <td>Rp {{ number_format($kehadiran->alpha * 50000, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Sakit ({{ $kehadiran->sakit ?? 0 }} hari)</td>
                    <td>Rp {{ number_format($kehadiran->sakit * 25000, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td><strong>Total Potongan</strong></td>
                    <td><strong>Rp {{ number_format($potongan, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td><strong>Total Gaji Bersih</strong></td>
                    <td><strong>Rp {{ number_format($total_gaji, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Tambahan keterangan -->
        <p class="mt-4">Slip gaji ini dicetak secara otomatis oleh sistem, segala kesalahan atau kekurangan dapat dibicarakan langsung dengan HRD.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>window.print()</script>
</body>
</html>
