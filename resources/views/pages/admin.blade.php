@extends('main')
@section('container')

    <div class="container-fluid">
        <div class="row">
            {{-- Left Content --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Kelola Admin</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime.</p>
                        <div class="mb-3">
                            <table id="tableAdmin" class="table table-striped table-hover nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-light">
                                        <th data-ordering="false">Nama</th>
                                        <th data-ordering="false">Username</th>
                                        <th data-ordering="false"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Content --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5>Form Tambah Admin</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime.</p>
                        <div id="formAddAdmin">
                            <div class="mb-3">
                                <label class="col-form-label">Nama :</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label">Username :</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="mb-4">
                                <label class="col-form-label">Password :</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn btn-outline-primary w-100" id="submit">Tambah</button>
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

    
    // Show Datatable
    function showTable() {
        $('#tableAdmin').DataTable({
            bDestroy: true,
            searching: true,
            serverSide: true,
            ordering: false,
            ajax: {
                type: 'get',
                url: '/showTableAdmin',
            },
            columns: [
                {data: 'nama'},
                {data: 'username'},
                {render: function(data, type, row) {
                    return `
                        <button class='btn btn-transparent deleteAdmin p-2' data-id='${row.id}' style="background-color: transparent; border: none;">
                            <iconify-icon icon="mdi:delete" class="fs-8 text-danger"></iconify-icon>
                        </button>

                    `
                }, width: '13%'},
            ]
        })
    }
    showTable()


    // Add Admin
    function addAdmin() {
        $('#submit').off('click').on('click', function() {
            let nama = $('#nama').val()
            let username = $('#username').val()
            let password = $('#password').val()

            $.ajax({
                type: 'post',
                url: '/addAdmin',
                data: {
                    nama: nama,
                    username: username,
                    password: password,
                },
                success: function() {
                    notifAlert('Berhasil', 'Data berhasil ditambah!', 'success')
                    $('#tableAdmin').DataTable().ajax.reload();       

                    $('#nama').val('')
                    $('#username').val('')
                    $('#password').val('')
                },
                error: function() {
                    notifAlert('Gagal', 'Data gagal ditambah!', 'error')
                    $('#tableAdmin').DataTable().ajax.reload();
                }
            })
        })
    }
    addAdmin()


    // Delete Admin
    function deleteAdmin() {
        $(document).on('click', '.deleteAdmin', function() {
            let id = $(this).data('id')

            Swal.fire({
                title: "Anda yakin?",
                text: "Anda akan menghapus data ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'delete',
                        url: '/deleteAdmin/' + id,
                        success: function () {
                            notifAlert('Berhasil', 'Data berhasil dihapus', 'success')
                            $('#tableAdmin').DataTable().ajax.reload();
                        },
                        error: function () {
                            notifAlert('Gagal', 'Data gagal dihapus', 'error')
                        }
                    });
                }
            })
        })
    }
    deleteAdmin()
</script>
@endsection


@endsection