@extends('main')
@section('container')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Kelola Bagian</h5>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime.</p>
                        <div class="mb-3">
                            <div class="mb-3">
                                <button id="addBagian" class="btn btn-primary">Tambah</button>
                            </div>
                            <table id="tableBagian" class="table table-striped table-hover nowrap align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-light">
                                        <th data-ordering="false">No</th>
                                        <th data-ordering="false">Bagian</th>
                                        <th data-ordering="false">Gaji Pokok</th>
                                        <th data-ordering="false">Transport</th>
                                        <th data-ordering="false">Total Gaji</th>
                                        <th data-ordering="false">Action</th>
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
        $('#tableBagian').DataTable({
            bDestroy: true,
            searching: true,
            serverSide: true,
            ajax: {
                type: 'get',
                url: '/showTableBagian',
                dataSrc: function(json) {
                    for (let i = 0, len = json.data.length; i < len; i++) {
                        json.data[i].no = i + 1;
                    }
                    return json.data;
                }
            },
            columns: [
                { data: 'no', width:'6%' },
                { data: 'bagian' },
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
                {
                    width: '16%',
                    render: function (data, type, row) {
                        return `
                                <button class='btn btn-warning editBagian' id="editt" data-id="${row.id}" data-bagian="${row.bagian}" data-gapok="${row.gaji_pokok}" data-transport="${row.transport}" data-total="${row.total}">Edit</button>
                                <button class='btn btn-danger deleteBagian' data-id='${row.id}'>Delete</button>
                            `
                    }
                }
            ]
        })
    }
    showTable()


    // Fungsi inputan angka ribuan pada form
    function formatNumber(value) {
        // Hapus semua karakter non-numeric
        value = value.replace(/\D/g, '');
        // Format angka dengan titik sebagai pemisah ribuan
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }


    // Ubah format inputan angka ribuan ketika value sudah ada
    function formatInputsOnLoad() {
        $('#gaji_pokok, #transport').each(function() {
            $(this).val(formatNumber($(this).val()));
        });
    }


    // Add Bagian
    function addBagian() {
        $('#addBagian').off('click').on('click', function() {
            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bagian</h5>
                </div>
                <div class="modal-body">
                    <form id="formAddBagian">
                        <div class="mb-3">
                            <label class="col-form-label">Bagian :</label>
                            <input type="text" class="form-control" id="bagian" name="bagian">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Gaji Pokok :</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Transport :</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="transport" name="transport">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submit">Tambah</button>
                </div>
            `);
            
            $('#modal').modal('show');

            // Event listener untuk format inputan
            $('#gaji_pokok, #transport').on('input', function() {
                $(this).val(formatNumber($(this).val()));
            });

            // Fungsi hapus titik
            function removeDots(value) {
                return value.replace(/\./g, '');
            }

            // Submit Add
            function submitAdd() {
                $('#submit').off('click').on('click', function() {
                    let gajiPokok = removeDots($('#gaji_pokok').val());
                    let transport = removeDots($('#transport').val());

                    $.ajax({
                        type: 'post',
                        url: '/addBagian',
                        data: {
                            bagian: $('#bagian').val(),
                            gaji_pokok: gajiPokok,
                            transport: transport
                        },
                        success: function() {
                            notifAlert('Berhasil', 'Data berhasil ditambah!', 'success')
                            $('#tableBagian').DataTable().ajax.reload();

                            $('#modal').modal('hide')
                            $('#bagian').val('')
                            $('#gaji_pokok').val('')
                            $('#transport').val('')
                        },
                        error: function() {
                            notifAlert('Gagal', 'Data gagal ditambah!', 'error')
                            $('#tableBagian').DataTable().ajax.reload();
                            $('#modal').modal('hide')
                        }
                    })
                })
            }
            submitAdd()
        })
    }
    addBagian()


    // Edit Bagian
    function editBagian() {
        $(document).off('click').on('click', '.editBagian', function() {
            let id = $(this).data('id')
            let bagian = $(this).data('bagian')
            let gaji_pokok = $(this).data('gapok')
            let transport = $(this).data('transport')
            let total_gaji = $(this).data('total')

            $('#containerModal').empty().append(`
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bagian</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="col-form-label">Bagian :</label>
                            <input type="text" class="form-control" id="bagian" name="bagian" value="${bagian}">
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Gaji Pokok :</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok" value="${gaji_pokok}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Transport :</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" class="form-control" id="transport" name="transport" value="${transport}">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="submit">Edit</button>
                </div>
            `);
            
            formatInputsOnLoad();
            $('#modal').modal('show');

            // Event listener untuk format inputan
            $('#gaji_pokok, #transport').on('input', function() {
                $(this).val(formatNumber($(this).val()));
            });

            // Fungsi hapus titik
            function removeDots(value) {
                return value.replace(/\./g, '');
            }

            function submitEdit() {
                $('#submit').off('click').on('click', function() {
                    let gaji_pokok = removeDots($('#gaji_pokok').val());
                    let transport = removeDots($('#transport').val());

                    $.ajax({
                        type: 'put',
                        url: '/editBagian',
                        data: {
                            id: id,
                            bagian: $('#bagian').val(),
                            gaji_pokok: gaji_pokok,
                            transport: transport,
                        },
    
                        success: function() {
                            notifAlert('Berhasil', 'Data berhasil diedit!', 'success')
                            $('#tableBagian').DataTable().ajax.reload();

                            $('#modal').modal('hide')
                            $('#bagian').val('')
                            $('#gaji_pokok').val('')
                            $('#transport').val('')
                        },
                        error: function() {
                            notifAlert('Gagal', 'Data gagal diedit!', 'error')
                            $('#tableBagian').DataTable().ajax.reload();
                            $('#modal').modal('hide')
                        }
                    })
                })
            }
            submitEdit()
        }) 
    }
    editBagian()


    // Delete Bagian
    function deleteBagian() {
        $(document).on('click', '.deleteBagian', function() {
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
                        url: '/deleteBagian/' + id,
                        success: function () {
                            notifAlert('Berhasil', 'Data berhasil dihapus', 'success')
                            $('#tableBagian').DataTable().ajax.reload();
                        },
                        error: function () {
                            notifAlert('Gagal', 'Data gagal dihapus', 'error')
                        }
                    });
                }
            });
        })
    }
    deleteBagian()
</script>

@endsection
@endsection

@endsection