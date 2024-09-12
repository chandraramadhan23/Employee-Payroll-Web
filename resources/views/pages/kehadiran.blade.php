@extends('main')
@section('container')

    <div class="container-fluid">
        {{-- Form --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Kehadiran Karyawan</h5>
                        <p>Input kehadiran karyawan berdasarkan bulan dan tahun</p>

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

                            <button type="button" class="btn btn-warning" id="filter">Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        <div class="row">
            <div class="col-lg-12">
                <div id="cardAlertInfo" class="alert alert-info" role="alert">
                    Potongan Sakit : <strong>Rp. 25.000</strong>, dan Potongan Alpha : <strong>Rp. 50.000</strong>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        <div class="row">
            <div class="col-lg-12">
                <div id="cardAlert" class="alert alert-primary" role="alert" style="display: none">
                    Data kehadiran karyawan bulan <strong id="textBulanAlert"></strong> tahun <strong id="textTahunAlert"></strong>
                </div>
            </div>
        </div>

        {{-- DataTable --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" id="submit">Submit</button>
                        <table id="tableDataKehadiran" class="table table-striped table-hover nowrap align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">NIK</th>
                                    <th data-ordering="false">Nama</th>
                                    <th data-ordering="false">Jenis Kelamin</th>
                                    <th data-ordering="false">Bagian</th>
                                    <th data-ordering="false">Sakit</th>
                                    <th data-ordering="false">Alpha</th>
                                </tr>
                            </thead>
                        </table>
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
    
    // Inisialisasi DataTable
    var table = $('#tableDataKehadiran').DataTable({
        bDestroy: true,
        searching: false,
        serverSide: true,
        deferLoading: 0,
        ajax: {
            type: 'get',
            url: '/showTableKehadiran',
            data: function(d) {
                d.bulan = $('#bulan').val();
                d.tahun = $('#tahun').val();
            },
            dataSrc: function(json) {
                for (let i = 0, len = json.data.length; i < len; i++) {
                    json.data[i].no = i + 1;
                }
                return json.data;
            },
        },
        columns: [
            { data: 'no', width:'6%', orderable:false },
            { data: 'nik' },
            { data : 'nama'},
            { data : 'jenis_kelamin'},
            { data : 'bagian'},
            {
                data: 'sakit',
                render: function(data, type, row) {
                    return `<input type="number" class="form-control" name="sakit" value="${data || 0}" min="0" onblur="setDefaultValue(this)" />`;
                }
            },
            {
                data: 'alpha',
                render: function(data, type, row) {
                    return `<input type="number" class="form-control" name="alpha" value="${data || 0}" min="0" onblur="setDefaultValue(this)" />`;
                }
            }
        ]
    });


    // Filter
    function filter() {
        $('#filter').click(function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();

            // Validasi inputan
            if (bulan === null || tahun === null) {
                notifAlert('Gagal Ditampilkan', 'Silakan isi semua inputan filter', 'error');
                $('#bulan').val(null);
                $('#tahun').val(null);

                $('#cardAlert').hide(); // Sembunyikan alert jika inputan tidak lengkap
                $('#submit').hide(); // Sembunyikan tombol submit jika inputan tidak lengkap
            } else {
                // Tampilkan alert dengan bulan dan tahun yang dipilih
                $('#textBulanAlert').text($('#bulan option:selected').text());
                $('#textTahunAlert').text(tahun);
                $('#cardAlert').show();
                $('#submit').show();

                table.ajax.reload();
            }
        });
    }
    filter()



    // Default Input Value
    function setDefaultValue(element) {
        if ($(element).val() === '' || $(element).val() < 0 ) {
            $(element).val(0); // Set value menjadi 0 jika kosong atau kurang dari 0
        }
    }


    // Submit
    $('#submit').hide();
    function submit() {
        $('#submit').click(function() {
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var dataKehadiran = [];

            // Loop melalui setiap baris di DataTable dan ambil nilai sakit dan alpha
            $('#tableDataKehadiran tbody tr').each(function() {
                var row = $(this);
                var karyawanId = row.find('td').eq(0).text(); // Ambil id karyawan dari kolom pertama
                var sakit = row.find('input[name="sakit"]').val() || 0; // Jika null, anggap 0
                var alpha = row.find('input[name="alpha"]').val() || 0; // Jika null, anggap 0


                dataKehadiran.push({
                    karyawan_id: karyawanId,
                    bulan: bulan,
                    tahun: tahun,
                    sakit: sakit,
                    alpha: alpha
                });
            });

            $.ajax({
                url: '/addDataKehadiran',
                type: 'post',
                data: {
                    dataKehadiran: dataKehadiran,
                    _token: '{{ csrf_token() }}' // Tambahkan token CSRF
                },
                success: function(response) {
                    notifAlert('Success', 'Data kehadiran berhasil disimpan!', 'success');
                },
                error: function(xhr, status, error) {
                    notifAlert('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
                }
            });
        })
    }
    submit()

</script>
@endsection

@endsection