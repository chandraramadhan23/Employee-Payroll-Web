@extends('main')
@section('container')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Slip Gaji Karyawan</h5>
                        <p>Cetak slip gaji karyawan berdasarkan nama karyawan, bulan, dan tahun</p>
                        
                        <div id="formInput" class="mb-3">
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="col-form-label">Bulan :</label>
                                    <select class="form-control" id="bulan">
                                        <option value="" disabled selected>--Pilih Bulan--</option>
                                        <option value='1'>Januari</option>
                                        <option value='2'>Februari</option>
                                        <option value='3'>Maret</option>
                                        <option value='4'>April</option>
                                        <option value='5'>Mei</option>
                                        <option value='6'>Juni</option>
                                        <option value='7'>Juli</option>
                                        <option value='8'>Agustus</option>
                                        <option value='9'>September</option>
                                        <option value='10'>Oktober</option>
                                        <option value='11'>November</option>
                                        <option value='12'>Desember</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label">Tahun :</label>
                                    <select class="form-control" id="tahun">
                                        <option value="" disabled selected>--Pilih Tahun--</option>
                                        <option value='2020'>2020</option>
                                        <option value='2021'>2021</option>
                                        <option value='2022'>2022</option>
                                        <option value='2023'>2023</option>
                                        <option value='2024'>2024</option>
                                        <option value='2025'>2025</option>
                                        <option value='2026'>2026</option>
                                        <option value='2027'>2027</option>
                                        <option value='2028'>2028</option>
                                        <option value='2029'>2029</option>
                                        <option value='2030'>2030</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-lg-4">
                                    <label class="col-form-label">Bagian :</label>
                                    <select class="form-control" id="bagian">
                                        <option value="" disabled selected>--Pilih Bagian--</option>
                                        @foreach ($karyawans as $karyawan)
                                            <option value="{{ $karyawan->bagian }}">{{ $karyawan->bagian }}</option>
                                        @endforeach
                                    </select>                                    
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label">Nama :</label>
                                    <select class="form-control" id="nama">
                                        <option value="" disabled selected>--Pilih Nama--</option>
                                        // tampilkan nama karyawan berdasarkan bagian
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-info" id="cetak">Cetak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="row">
            <div class="py-6 px-6 text-center">
                <br><br><br><br><br><br><br>
                <p class="mb-0 fs-3">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>Distributed by <a href="https://themewagon.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">ThemeWagon</a></p>
            </div>
        </div>
    </div>

@section('table')
<script>
    // SweetAlert
    function notifAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
        })
    }

    // Fungsi show karyawan by bagian
    function showKaryawanByBagian() {
        $(document).ready(function() {
            // Ketika bagian diubah
            $('#bagian').on('change', function() {
                let bagian = $(this).val(); // Ambil value bagian yang dipilih

                // Panggil fungsi untuk memuat karyawan berdasarkan bagian
                loadKaryawanByBagian(bagian);
            });

            // Fungsi untuk memuat karyawan berdasarkan bagian
            function loadKaryawanByBagian(bagian) {
                $.ajax({
                    type: 'get',
                    url: 'showOptionBagian',
                    data: { bagian: bagian },
                    success: function(response) {
                        // Kosongkan elemen select nama karyawan
                        $('#nama').empty();
                        $('#nama').append(`<option value="" disabled selected>--Pilih Nama--</option>`);
                        
                        // Tambahkan setiap karyawan ke dalam select nama
                        $.each(response, function(index, item) {
                            $('#nama').append(`
                                <option value="${item.nama}">${item.nama}</option>
                            `);
                        });
                    }
                });
            }
        });
    }

    showKaryawanByBagian();


    // Fungsti Cetak
    function cetakSlipGaji() {
        $('#cetak').click(function() {
           // Ambil value dari setiap input
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();
            let bagian = $('#bagian').val();
            let nama = $('#nama').val();

            // Validasi input, jika ada yang kosong tampilkan alert error
            if (!bulan || !tahun || !bagian || !nama) {
                notifAlert('Error', 'Semua field harus diisi!', 'error');
                return; // Hentikan proses jika ada yang kosong
            }

            // Jika semua input terisi, buka halaman cetak di tab baru
            window.open(`/cetakSlipGaji?bulan=${bulan}&tahun=${tahun}&bagian=${bagian}&nama=${nama}`, '_blank');
        })
    }
    
    cetakSlipGaji()
</script>
@endsection
@endsection