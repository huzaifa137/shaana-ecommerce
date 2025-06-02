@include('layouts.header')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Login</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Login</li>
    </ol>
</div>

<div class="container-fluid py-3 bg-light">
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-8">
                <h1 class="text-center">Reset Password</h1>
                <p class="text-center">Please enter your new password for your account</p>
                <form id="loginForm" class="p-4 rounded shadow bg-white">
                    @csrf

                    @if (Session::get('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if (Session::get('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif
                    
                    <input type="hidden" id="generated_id" value="{{ $generated_id }}">

                    <div class="mb-3">
                        <input type="text" id="password" name="password" class="form-control"
                            placeholder="Enter new password">
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="text" id="confirmPassword" name="confirmPassword" class="form-control"
                            placeholder="Confirm password">
                    </div>

                    <div class="d-grid">
                        <button type="submit" id="resetPasswordBtn" class="btn btn-primary text-white">
                            <i class="bi bi-check-circle"></i> Reset
                        </button>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="fw-bold text-success">
                            <a href="{{ url('user-login') }}" class="text-primary text-decoration-none">Return to Login
                                →</a>
                        </p>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>


<script type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
    $(document).ready(function() {
        $('#resetPasswordBtn').on('click', function(e) {
            e.preventDefault();

            const btn = $(this);
            btn.prop('disabled', true);
            btn.html('Resetting... <i class="fas fa-spinner fa-spin"></i>');

            const password = $('#password').val().trim();
            const confirmPassword = $('#confirmPassword').val().trim();
            const token = $('#generated_id').val().trim();

            let validationErrors = [];

            const passwordPattern = {
                length: /.{6,}/,
                uppercase: /[A-Z]/,
                lowercase: /[a-z]/,
                number: /[0-9]/,
                special: /[@$!%*?&#]/
            };

            if (!password) {
                validationErrors.push('Password is required.');
            } else {
                if (!passwordPattern.length.test(password)) validationErrors.push(
                    'Minimum 6 characters.');
                if (!passwordPattern.uppercase.test(password)) validationErrors.push(
                    'At least one uppercase letter.');
                if (!passwordPattern.lowercase.test(password)) validationErrors.push(
                    'At least one lowercase letter.');
                if (!passwordPattern.number.test(password)) validationErrors.push(
                    'At least one number.');
                if (!passwordPattern.special.test(password)) validationErrors.push(
                    'At least one special character.');
            }

            if (password !== confirmPassword) {
                validationErrors.push('Passwords do not match.');
            }

            if (validationErrors.length > 0) {
                btn.prop('disabled', false).html('<i class="bi bi-check-circle"></i> Reset');
                Swal.fire({
                    icon: 'warning',
                    title: 'Validation Error',
                    html: `<ul style="text-align: left;">${validationErrors.map(e => `<li>${e}</li>`).join('')}</ul>`
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('user-store-new-password') }}",
                data: {
                    _token: $('input[name="_token"]').val(),
                    password: password,
                    confirmPassword: confirmPassword,
                    generated_id: token
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Password updated successfully!'
                    }).then(() => {
                        window.location.href =
                            "{{ route('user.forgot.password') }}";
                    });
                },
                // error: function(xhr) {
                //     btn.prop('disabled', false).html(
                //         '<i class="bi bi-check-circle"></i> Reset');

                //     let errorMsg = 'An error occurred. Please try again.';

                //     if (xhr.status === 422 && xhr.responseJSON?.errors) {
                //         const errors = xhr.responseJSON.errors;
                //         errorMsg = Object.values(errors).flat().join('<br>');
                //     } else if (xhr.responseJSON?.message) {
                //         errorMsg = xhr.responseJSON.message;
                //     } else if (xhr.responseText) {
                //         errorMsg = xhr.responseText;
                //     }

                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Failed',
                //         html: errorMsg
                //     });
                // }

                error: function(data) {
                    $('body').html(data.responseText);
                }
            });
        });
    });
</script>

@include('layouts.footer')
