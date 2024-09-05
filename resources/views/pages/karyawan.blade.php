@extends('main')
@section('container')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Kelola Karyawan</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime.</p>
                        <div class="mb-3">
                            <div class="mb-3">
                                <button id="addKaryawan" class="btn btn-primary" style="display: ;">Tambah</button>
                                <button id="editSelected" class="btn btn-success" style="display: none;">Ubah</button>
                                <button id="deleteSelected" class="btn btn-danger" style="display: none;">Hapus</button>
                            </div>
                            <table id="tableKaryawan" class="table table-striped table-hover nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-light">
                                        <th data-ordering="false"><input type="checkbox" id="selectAll"></th>
                                        <th data-ordering="false">No</th>
                                        <th data-ordering="false">NIK</th>
                                        <th data-ordering="false">Nama</th>
                                        <th data-ordering="false">Jenis Kelamin</th>
                                        <th data-ordering="false">Bagian</th>
                                        <th data-ordering="false">Tanggal Masuk</th>
                                    </tr>
                                </thead>
                            </table>
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
@section('modal')
@include('modals.modal')
<script>
    // SweetAlert
    function notifAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
        })
    }


    // Show Datatable
    function showTable() {
        $('#tableKaryawan').DataTable({
            bDestroy: true,
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableKaryawan',
                dataSrc: function (json) {
                    for (let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                },
            },
            columns: [
                { data: null, width: '5%', render: function (data, type, row) { return '<input type="checkbox" class="selectRow" value="' + row.id + '">'; }, orderable: false },
                { data: 'no'},
                { data: 'nik' },
                { data: 'nama'},
                { data: 'jenis_kelamin' },
                { data: 'bagian'},
                { data: 'tanggal_masuk', render: function (data, type, row) {
                    // Format the date using Moment.js
                    return moment(data).format('DD-MMM-YYYY');
                }}
            ],
        })
    }
    showTable()


    // Toggle Buttons
    function toggleButtons() {
        let selectedCount = $('.selectRow:checked').length;
        $('#editSelected').toggle(selectedCount > 0).prop('disabled', selectedCount > 1);
        $('#deleteSelected').toggle(selectedCount > 0);
        $('#addKaryawan').prop('disabled', selectedCount > 0);
    }


    // Handle row click to toggle checkbox
    function handleRowClick() {
        $('#tableKaryawan tbody').on('click', 'tr', function (event) {
            if (event.target.type !== 'checkbox') {
                let checkbox = $(this).find('.selectRow');
                checkbox.prop('checked', !checkbox.prop('checked'));
                toggleButtons();
            }
        });
    }
    handleRowClick()


    // Prevent checkbox click from toggling twice
    function preventCheckboxClick() {
        $('#tableKaryawan tbody').on('click', '.selectRow', function (event) {
            event.stopPropagation();
            toggleButtons();
        });
    }
    preventCheckboxClick()


    // Handle Select All checkbox
    function selectAllClick() {
        $('#selectAll').on('click', function () {
            $('.selectRow').prop('checked', this.checked);
            toggleButtons();
        });
    }
    selectAllClick()


    // Add Karyawan
    function addKaryawan() {
        $('#addKaryawan').off('click').on('click', function() {
            $('#containerModal').empty().append(`
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Karyawan</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="col-form-label">NIK :</label>
                                <input type="text" class="form-control" id="nik">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Nama :</label>
                                <input type="text" class="form-control" id="nama">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Jenis Kelamin :</label>
                                <select class="form-control" id="jenisKelamin">
                                    <option value='Laki-laki'>Laki-laki</option>
                                    <option value='Perempuan'>Perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Bagian :</label>
                                <select class="form-control" id="bagian">
                                    @foreach($bagians as $bagian)
                                        <option value='{{ $bagian->bagian }}'>{{ $bagian->bagian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date">Tanggal Masuk :</label>
                                <input type="date" class="form-control" id="tanggalMasuk">                          
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="submit">Tambah</button>
                    </div>
                `)
            $('#modal').modal('show')

            // Add Submit
            function addSubmit() {
                $('#submit').off('click').on('click', function() {
                    const nik = $('#nik').val()
                    const nama = $('#nama').val()
                    const jenisKelamin = $('#jenisKelamin').val()
                    const bagian = $('#bagian').val()
                    const tanggalMasuk = $('#tanggalMasuk').val()

                    $.ajax({
                        type: 'post',
                        url: '/addKaryawan',
                        data: {
                            nik: nik,
                            nama: nama,
                            jenisKelamin : jenisKelamin,
                            bagian: bagian,
                            tanggalMasuk: tanggalMasuk,
                        },
                        success: function() {
                            notifAlert('Berhasil', 'Data berhasil ditambah!', 'success')
                            setTimeout(() => {
                                showTable()
                            }, 1000);

                            $('#modal').modal('hide')
                            $('#nik').val('')
                            $('#nama').val('')
                            $('#jenisKelamin').val('')
                            $('#bagian').val('')
                            $('#tanggalMasuk').val('')
                        },
                        error: function() {
                            notifAlert('Gagal', 'Data gagal ditambah!', 'error')
                            showTable()
                            $('#modal').modal('hide')
                        }
                    })
                })
            }
            addSubmit()
        })
    }
    addKaryawan()


    // Edit Karyawan
    function editKaryawan() {
        $('#editSelected').off('click').on('click', function() {
            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Edit Karyawan</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">NIK :</label>
                            <input type="text" class="form-control" id="nik">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Nama :</label>
                            <input type="text" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Jenis Kelamin :</label>
                            <select class="form-control" id="jenisKelamin">
                                <option value='Laki-laki'>Laki-laki</option>
                                <option value='Perempuan'>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Bagian :</label>
                            <select class="form-control" id="bagian">
                                @foreach($bagians as $bagian)
                                    <option value='{{ $bagian->bagian }}'>{{ $bagian->bagian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date">Tanggal Masuk :</label>
                            <input type="date" class="form-control" id="tanggalMasuk">                          
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="submit">Ubah</button>
                </div>
            `)

            $('#modal').modal('show');

            let selectedItems = $('.selectRow:checked').map(function () {
                return $(this).val();
            }).get();

            if (selectedItems.length === 1) {
                let selectedId = selectedItems[0];
                // Fetch data for the selected karyawan and fill the form
                $.ajax({
                    url: '/getEditKaryawan/' + selectedId,
                    type: 'get',
                    success: function (data) {
                        $('#nik').val(data.nik);
                        $('#nama').val(data.nama);
                        $('#jenisKelamin').val(data.jenis_kelamin);
                        $('#bagian').val(data.bagian);
                        $('#tanggalMasuk').val(data.tanggal_masuk);
                    },
                    error: function () {
                        notifAlert('Gagal', 'Gagal menampilkan form edit Karyawan', 'error');
                    }
                });
            }

            // Submit Edit
            function submitEdit() {
                $('#submit').off('click').on('click', function() {
                    let selectedId = $('.selectRow:checked').val();
                    let nik = $('#nik').val();
                    let nama = $('#nama').val();
                    let jenisKelamin = $('#jenisKelamin').val();
                    let bagian = $('#bagian').val();
                    let tanggalMasuk = $('#tanggalMasuk').val();

                    $.ajax({
                        url: '/putEditKaryawan/' + selectedId,
                        type: 'put',
                        data: {
                            id: selectedId,
                            nik: nik,
                            nama: nama,
                            jenisKelamin: jenisKelamin,
                            bagian: bagian,
                            tanggalMasuk: tanggalMasuk,
                        },
                        success: function() {
                            notifAlert('Berhasil', 'Data berhasil di edit!', 'success');
                            $('#modal').modal('hide')
                            
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        },
                        error: function() {
                            notifAlert('Gagal', 'Data gagal di edit!', 'error')
                        }
                    })
                })
            }
            submitEdit()
        })
    }
    editKaryawan()


    // Delete Karyawan
    function deleteKaryawan() {
        $('#deleteSelected').off('click').on('click', function() {
            let selectedItems = [];
            let selectedNames = [];

            $('.selectRow:checked').each(function () {
                let row = $(this).closest('tr');
                selectedItems.push($(this).val());
                selectedNames.push(row.find('td:eq(3)').text());
            });

            if (selectedItems.length > 0) {
                let names = selectedNames.join(', ');

                Swal.fire({
                    title: "Anda yakin?",
                    text: names,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/deleteKaryawan',
                            type: 'delete',
                            data: {
                                ids: selectedItems,
                            },
                            success: function () {
                                notifAlert('Berhasil', 'Data berhasil dihapus', 'success')

                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            },
                            error: function () {
                                notifAlert('Gagal', 'Data gagal dihapus', 'error')
                            }
                        });
                    }
                });
            }
        })
    }
    deleteKaryawan()
</script>
@endsection
@endsection

@endsection