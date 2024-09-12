
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page || Payroll App</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/seodashlogo.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <h4 class="text-center mb-4">Employee Payroll App</h4>

                            {{-- Form --}}
                            <div class="mb-3">
                                <label for="username" class="form-label">Username :</label>
                                <input type="username" class="form-control" id="username">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password :</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            
                            <button id="login" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign In</button>
                            {{-- Tutup Form --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Jquey cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Sweet Alert 2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Moment.min.js cdn-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>


    <script>
    // SweetAlert
    function notifAlert(title, text, icon) {
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
        })
    }

    // Login
    function login() {
        $('#login').click(function() {
            let username = $('#username').val()
            let password = $('#password').val()

            $.ajax({
                type: 'post',
                url: '/login',
                data: {
                    username: username,
                    password: password,
                },
                success: function(response) {
                    if (response.status == 'berhasil') {
                        window.location.href ='/dashboard';
                    } else {
                        notifAlert('Gagal', 'Username atau password salah!', 'error')
                        
                        $('#username').val('')
                        $('#password').val('')
                    }
                }
                
            })
        })
    }
    login()
    
    
    </script>
</body>

</html>