@extends('main')
@section('container')

    <div class="container-fluid">
        <div class="row">
            {{-- PT Cobacoba Tbk --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fs-6 card-title d-flex align-items-center gap-2 mb-4">PT. Cobacoba Tbk<span><iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Traffic Overview"></iconify-icon></span></h5>
                        <div>
                            <p class="fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio doloribus similique aut blanditiis. Inventore tenetur eligendi cupiditate, vel et sit quidem a quia natus maxime dignissimos sed corporis soluta molestiae.</p>
                            <div>
                                <img src="../assets/images/company-image.jpg" alt="foto perusahaan" width="500" height="250">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Master Data --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center gap-2 mb-5 pb-3">Master Data<span><iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Locations"></iconify-icon></span></h5>
                        <div class="row">
                            <div class="col-4">
                            <iconify-icon icon="solar:laptop-minimalistic-line-duotone" class="fs-7 d-flex text-primary"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Admin</span>
                            <h4 class="mb-0 mt-1">{{ $totalAdmin }}</h4>
                            </div>
                            <div class="col-4">
                            <iconify-icon icon="solar:smartphone-line-duotone" class="fs-7 d-flex text-secondary"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Karyawan</span>
                            <h4 class="mb-0 mt-1">{{ $totalKaryawan }}</h4>
                            </div>
                            <div class="col-4">
                            <iconify-icon icon="solar:tablet-line-duotone" class="fs-7 d-flex text-success"></iconify-icon>
                            <span class="fs-11 mt-2 d-block text-nowrap">Bagian</span>
                            <h4 class="mb-0 mt-1">{{ $totalBagian }}</h4>
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

@endsection