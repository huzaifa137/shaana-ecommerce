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
                <h1 class="text-center">Welcome Back</h1>
                <p class="text-center">Please login to your account</p>
                <form action="#" class="p-4 rounded shadow bg-white">
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="password" id="passwordInput" class="form-control"
                            placeholder="Enter password">
                        <i class="fa-solid fa-eye position-absolute" id="togglePassword"
                            style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label" for="Account-1">Don't have an account?,<a
                                href="{{ url('user-register') }}">SignUp</a></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>


@include('layouts.footer')
