@include('layouts.header')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Account Registration</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active text-white">Create Account</li>
    </ol>
</div>

<div class="container-fluid  mt-5">
    <div class="container ">
        <div class="row g-4 mb-5">

            <div class="col-lg-8 col-xl-8">
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3" for="firstName">First Name</label>
                                    <input type="text" class="form-control" id="firstName">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3" for="lastName">Last Name</label>
                                    <input type="text" class="form-control" id="lastName">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="email">Email Address</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="companyName">Company Name</label>
                            <input type="text" class="form-control" id="companyName">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="address">Address</label>
                            <input type="text" class="form-control" placeholder="House Number Street Name"
                                id="address">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="city">Town/City</label>
                            <input type="text" class="form-control" id="city">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="country">Country</label>
                            <input type="text" class="form-control" id="country">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="postcode">Postcode/Zip</label>
                            <input type="text" class="form-control" id="postcode">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3" for="mobile">Mobile</label>
                            <input type="tel" class="form-control" id="mobile">
                        </div>

                        <div class="form-check my-3">
                            <input class="form-check-input" type="checkbox" id="Address-1" name="Address"
                                value="Address">
                            <label class="form-check-label" for="Address-1">Set as default shipping address ?</label>
                        </div>

                        <div class="my-3">
                            <button type="submit" id="submitBtn" class="btn btn-primary text-white">
                                <i class="fas fa-user-plus"></i> Create Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products Section -->
            <div class="col-lg-4 col-xl-4">
                <div class="row g-4 fruite">
                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="assets/img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="position-relative">
                            <img src="assets/img/best-product-7.jpg" class="img-fluid w-100 rounded" alt="">
                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                <h3 class="text-white fw-bold">Fresh <br> Fruits <br> Banner</h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).ready(function() {
        $('button[type="submit"]').on('click', function(e) {
            e.preventDefault();

            const submitBtn = $('#submitBtn');
            submitBtn.prop('disabled', true);
            submitBtn.html('Creating user account... <i class="fas fa-spinner fa-spin"></i>');

            let isValid = true;
            let missingFields = [];

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
                }
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

            if (!isValid) {
                submitBtn.prop('disabled', false);
                submitBtn.html('Create Account');

                let listItems = missingFields.map(name => `<li>${name}</li>`).join('');
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Fields',
                    html: `
                        <p style="text-align: left;">Please fill in the following required fields:</p>
                        <ol style="text-align: left; padding-left: 20px;">${listItems}</ol>
                    `,
                });
                return;
            }

            let form_data = new FormData();
            requiredFields.forEach(field => {
                form_data.append(field.id, $('#' + field.id).val().trim());
            });

            let isDefaultAddress = $('#Address-1').is(':checked') ? 1 : 0;
            form_data.append('isDefaultAddress', isDefaultAddress);

            $.ajax({
                type: "POST",
                url: "/store-user-information",
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
                        title: 'Success!',
                        text: 'User Account created successfully!',
                    }).then(() => {
                        location
                            .reload(); 
                    });
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Create Account');
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Create Account');

                    let errorMessage = 'An error occurred. Please try again.';

                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: errorMessage,
                    });

                    console.error(xhr);
                }
            });
            ``
        });
    });
</script>




@include('layouts.footer')
