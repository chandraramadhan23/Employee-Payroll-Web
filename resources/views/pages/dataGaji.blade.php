@extends('main')
@section('container')

    <div class="container-fluid">
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
                                    <input type="text" class="form-control" id="bulan" name="bulan" placeholder="--Pilih Bulan--">
                                </div>
                                <div class="col-lg-4">
                                    <label class="col-form-label">Tahun :</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun" placeholder="--Pilih Tahun--">
                                </div>
                            </div>

                            <button type="button" class="btn btn-warning" id="filter">Filter</button>
                            <button type="button" class="btn btn-info" id="cetak">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-primary" role="alert">
                    Data kehadiran karyawan bulan <strong>02</strong> tahun <strong>2024</strong>
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

@endsection