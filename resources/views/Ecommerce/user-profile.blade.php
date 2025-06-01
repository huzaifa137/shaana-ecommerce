@include('layouts.header')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">User Profile</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">User Information</li>
    </ol>
</div>

<div class="container-fluid  mt-5">
    <div class="container ">
        <div class="row g-4 mb-5">

            <form method="POST" action="#">
                @csrf
                <div class="col-lg-12 col-xl-12">
                    <div class="row g-4">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3" for="firstName">First Name</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name"
                                            value="{{ old('first_name', $customer->first_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3" for="lastName">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name"
                                            value="{{ old('last_name', $customer->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $customer->email) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="companyName">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="company_name"
                                    value="{{ old('company_name', $customer->company_name) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="House Number Street Name"
                                    value="{{ old('address', $customer->address) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="city">Town/City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city', $customer->city) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country"
                                    value="{{ old('country', $customer->country) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="postcode">Postcode/Zip</label>
                                <input type="text" class="form-control" id="postcode" name="postcode"
                                    value="{{ old('postcode', $customer->postcode) }}">
                            </div>

                            <div class="form-item">
                                <label class="form-label my-3" for="mobile">Mobile</label>
                                <input type="tel" class="form-control" id="mobile" name="mobile"
                                    value="{{ old('mobile', $customer->mobile) }}">
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <label class="form-label my-3" for="password">Password</label>
                                    <div class="mb-3 position-relative">
                                        <input type="password" id="passwordInput" name="password" class="form-control">
                                        <i class="fa-solid fa-eye position-absolute" id="togglePassword"
                                            style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6">
                                    <label class="form-label my-3" for="confirmpasswordInput">Confirm Password</label>
                                    <div class="mb-3 position-relative">
                                        <input type="password" id="confirmpasswordInput" name="password_confirmation"
                                            class="form-control">
                                        <i class="fa-solid fa-eye position-absolute" id="togglePasswordConfirm"
                                            style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" id="Address-1"
                                    name="default_shipping_address" value="1"
                                    {{ old('default_shipping_address', $customer->default_shipping_address) ? 'checked' : '' }}>
                                <label class="form-check-label" for="Address-1">Set as default shipping address
                                    ?</label>
                            </div>

                            <div class="my-3 d-flex gap-2">
                                <button type="submit" id="submitBtn" class="btn btn-primary text-white">
                                    <i class="fas fa-user-plus"></i> Update Account Information
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>


<script type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordInput = document.getElementById('passwordInput');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function() {
        const type = confirmpasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmpasswordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    $(document).ready(function() {
        $('button[type="submit"]').on('click', function(e) {
            e.preventDefault();

            const submitBtn = $('#submitBtn');
            submitBtn.prop('disabled', true);
            submitBtn.html('Updating profile... <i class="fas fa-spinner fa-spin"></i>');

            let isValid = true;
            let missingFields = [];

            // Password fields will be optional
            let requiredFields = [{
                    id: 'firstName',
                    name: 'First Name'
                },
                {
                    id: 'lastName',
                    name: 'Last Name'
                },
                {
                    id: 'email',
                    name: 'Email'
                },
                {
                    id: 'companyName',
                    name: 'Company Name'
                },
                {
                    id: 'address',
                    name: 'Address'
                },
                {
                    id: 'city',
                    name: 'Town/City'
                },
                {
                    id: 'country',
                    name: 'Country'
                },
                {
                    id: 'postcode',
                    name: 'Postcode/Zip'
                },
                {
                    id: 'mobile',
                    name: 'Mobile'
                },
            ];

            $('.form-control').removeClass('is-invalid');

            requiredFields.forEach(field => {
                let value = $('#' + field.id).val().trim();
                if (value === '') {
                    $('#' + field.id).addClass('is-invalid');
                    isValid = false;
                    missingFields.push(field.name);
                }
            });

            const email = $('#email').val().trim();
            let emailError = '';

            if (email) {
                if (!email.includes('@')) {
                    emailError = 'Email must include "@" symbol';
                } else if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                    emailError = 'Email must have a valid domain (e.g. example@domain.com)';
                }
            }

            if (emailError) {
                isValid = false;
                $('#email').addClass('is-invalid');
                missingFields.push(emailError);
            }

            const password = $('#passwordInput').val().trim();
            const confirmPassword = $('#confirmpasswordInput').val().trim();

            const passwordPattern = {
                length: /.{8,}/,
                lowercase: /[a-z]/,
                uppercase: /[A-Z]/,
                digit: /\d/,
                specialChar: /[\W_]/,
            };

            if (password || confirmPassword) {
                if (password !== confirmPassword) {
                    isValid = false;
                    $('#passwordInput, #confirmpasswordInput').addClass('is-invalid');
                    missingFields.push('Passwords do not match');
                } else {
                    let patternErrors = [];

                    if (!passwordPattern.length.test(password)) patternErrors.push(
                        '• Minimum 8 characters');
                    if (!passwordPattern.lowercase.test(password)) patternErrors.push(
                        '• At least one lowercase letter');
                    if (!passwordPattern.uppercase.test(password)) patternErrors.push(
                        '• At least one uppercase letter');
                    if (!passwordPattern.digit.test(password)) patternErrors.push(
                        '• At least one number');
                    if (!passwordPattern.specialChar.test(password)) patternErrors.push(
                        '• At least one special character');

                    if (patternErrors.length > 0) {
                        isValid = false;
                        $('#passwordInput').addClass('is-invalid');
                        missingFields.push('Password must include:<br>' + patternErrors.join('<br>'));
                    }
                }
            }

            if (!isValid) {
                submitBtn.prop('disabled', false);
                submitBtn.html('Update Account Information');

                let listItems = missingFields.map(name => `<li>${name}</li>`).join('');
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Fields',
                    html: `
                        <p style="text-align: left;">Please fix the following issues:</p>
                        <ol style="text-align: left; padding-left: 20px;">${listItems}</ol>
                    `,
                });
                return;
            }

            let form_data = new FormData();
            requiredFields.forEach(field => {
                form_data.append(field.id, $('#' + field.id).val().trim());
            });

            if (password) {
                form_data.append('password', password);
                form_data.append('password_confirmation', confirmPassword);
            }

            let isDefaultAddress = $('#Address-1').is(':checked') ? 1 : 0;
            form_data.append('default_shipping_address', isDefaultAddress);

            $.ajax({
                type: "POST",
                url: "/update-user-profile",
                data: form_data,
                processData: false,
                contentType: false,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: data.message || 'Profile updated successfully!',
                    }).then(() => {
                        location.reload();
                    });
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Update Account Information');
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Update Account Information');

                    let errorMessage = 'An error occurred. Please try again.';
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                    console.error(xhr);
                }
            });
        });
    });
</script>


@include('layouts.footer')
