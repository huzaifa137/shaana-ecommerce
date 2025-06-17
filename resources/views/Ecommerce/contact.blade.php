@include('layouts.header')

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Contact</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Contact</li>
    </ol>
</div>
<!-- Single Page Header End -->


<!-- Contact Start -->
<div class="container-fluid contact py-5">

    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">

                        <h1 class="text-primary">Contact Us</h1>
                        <p class="mb-4">Have questions, feedback, or need support? We’re here to help! Please fill out
                            the form below and our team will get back to you as soon as possible.</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <iframe class="rounded w-100" style="height: 400px;"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7979.548968284603!2d32.642165!3d0.353184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb1fc56a973f%3A0x9ad368bc2b1d8c33!2sJunction%20Mall%2C%20Kireka!5e0!3m2!1sen!2sug!4v1718134759012!5m2!1sen!2sug"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-7">

                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validation Errors',
                                    html: `
                    <ul style="text-align: left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `
                                });
                            });
                        </script>
                    @endif

                    @if (session('success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: '{{ session('success') }}',
                                }).then(() => {
                                    document.querySelector('form').reset();
                                });
                            });
                        </script>
                    @endif

                    @if (session('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'error',
                                    text: '{{ session('error') }}',
                                }).then(() => {
                                    document.querySelector('form').reset();
                                });
                            });
                        </script>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" name="name"
                            placeholder="Your Name">
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4" name="phone"
                            placeholder="Your Phonenumber">
                        <input type="email" class="w-100 form-control border-0 py-3 mb-4" name="email"
                            placeholder="Enter Your Email">
                        <textarea class="w-100 form-control border-0 mb-4" rows="5" cols="10" name="message"
                            placeholder="Your Message"></textarea>
                        <button id="submitBtn"
                            class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">
                            <span id="btnText">Submit</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>

                    </form>

                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2">123 Street New York.USA</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2">info@example.com</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2">(+012) 3456 7890</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Array.from(form.elements).forEach(el => {
                if (el.classList) el.classList.remove('is-invalid');
            });

            let errors = [];

            if (!form.name.value.trim()) {
                errors.push('Name is required');
                form.name.classList.add('is-invalid');
            }
            if (!form.phone.value.trim()) {
                errors.push('Phone number is required');
                form.phone.classList.add('is-invalid');
            }
            if (!form.email.value.trim()) {
                errors.push('Email is required');
                form.email.classList.add('is-invalid');
            } else if (!validateEmail(form.email.value.trim())) {
                errors.push('Email format is invalid');
                form.email.classList.add('is-invalid');
            }
            if (!form.message.value.trim()) {
                errors.push('Message is required');
                form.message.classList.add('is-invalid');
            }

            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '<ul style="text-align:left;">' + errors.map(e => `<li>${e}</li>`)
                        .join('') + '</ul>',
                });
                return;
            }

            // Confirm before submit
            Swal.fire({
                title: 'Confirm Submission',
                text: 'Are you sure you want to submit your message?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    submitBtn.disabled = true;
                    btnText.innerHTML = `<i class="fas fa-spinner fa-spin"></i> Submitting...`;
                    form.submit();
                }
            });

        });

        // Helper email validation function
        function validateEmail(email) {
            // Basic regex for email validation
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email.toLowerCase());
        }
    });
</script>


<!-- Contact End -->

@include('layouts.footer')
