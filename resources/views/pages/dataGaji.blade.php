@extends('main')
@section('container')

    <div class="container-fluid">
        {{-- Form --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Data Gaji Karyawan</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime.</p>

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
                                    </select>
                                </div>
                            </div>

                            <button type="button" class="btn btn-warning" id="filter">Filter</button>
                            <button type="button" class="btn btn-info" id="cetak">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        <div class="row">
            <div class="col-lg-12">
                <div id="cardAlert" class="alert alert-primary" role="alert" style="display: none">
                    Data Gaji karyawan bulan <strong id="textBulanAlert"></strong> tahun <strong id="textTahunAlert"></strong>
                </div>
            </div>
        </div>

        {{-- DataTable --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tableDataGaji" class="table table-striped table-hover nowrap align-middle" style="width:100%">
                            <thead>
                                <tr class="table-light">
                                    <th data-ordering="false">No</th>
                                    <th data-ordering="false">NIK</th>
                                    <th data-ordering="false">Nama</th>
                                    <th data-ordering="false">Jenis Kelamin</th>
                                    <th data-ordering="false">Bagian</th>
                                    <th data-ordering="false">Gaji Pokok</th>
                                    <th data-ordering="false">Transport</th>
                                    <th data-ordering="false">Total Gaji</th>
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
    var table = $('#tableDataGaji').DataTable({
        bDestroy: true,
        searching: false,
        serverSide: true,
        deferLoading: 0, // Menunda pemuatan data
        ajax: {
            type: 'get',
            url: '/showTableDataGaji',
            data: function(d) {
                d.bulan = $('#bulan').val();
                d.tahun = $('#tahun').val();
            },
            dataSrc: function(json) {
                for (let i = 0, len = json.data.length; i < len; i++) {
                    json.data[i].no = i + 1;
                }
                return json.data;
            }
        },
        columns: [
            { data: 'no', width:'6%', orderable:false },
            { data: 'nik' },
            { data : 'nama'},
            { data : 'jenis_kelamin'},
            { data : 'bagian'},
            {
                data: 'gaji_pokok',
                render: data => (isNaN(numericValue = parseFloat(data)) ? '' : numericValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))
            },
            {
                data: 'transport',
                render: data => (isNaN(numericValue = parseFloat(data)) ? '' : numericValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))
            },
            {
                data: 'total_gaji',
                render: data => (isNaN(numericValue = parseFloat(data)) ? '' : numericValue.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))
            },                
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

                ('#cardAlert').hide(); // Sembunyikan alert jika inputan tidak lengkap
            } else {
                // Tampilkan alert dengan bulan dan tahun yang dipilih
                $('#textBulanAlert').text($('#bulan option:selected').text());
                $('#textTahunAlert').text(tahun);
                $('#cardAlert').show();

                table.ajax.reload();
            }
        });
    }
    filter()
</script>

@endsection

@endsection