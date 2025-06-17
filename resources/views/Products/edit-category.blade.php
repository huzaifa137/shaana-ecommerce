@extends('layouts2.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!---jvectormap css-->
    <link href="{{ URL::asset('assets2/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Data table css -->
    <link href="{{ URL::asset('assets2/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <!--Daterangepicker css-->
    <link href="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">Product Categories</h4>
        </div>
        <div class="page-rightheader ml-auto d-lg-flex d-none">
            <div class="ml-5 mb-0">
                <a href="{{ route('product.categories') }}" class="btn btn-md btn-primary">
                    <i class="fas fa-list me-2"></i> All Categories
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">

        <style>
            .ck-editor__editable_inline {
                min-height: 300px;
            }

            .image-box {
                cursor: pointer;
                border: 2px dashed #ccc;
                width: 300px;
                height: 200px;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
                transition: border-color 0.3s;
            }

            .image-box.dragover {
                border-color: #3a86ff;
                background-color: #f0f8ff;
            }

            .image-box img {
                max-width: 100%;
                max-height: 100%;
                display: none;
                object-fit: contain;
            }

            .image-box span {
                color: #888;
                user-select: none;
            }

            .image-box .remove-btn {
                position: absolute;
                top: 5px;
                right: 5px;
                background: red;
                color: white;
                border: none;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                cursor: pointer;
                display: none;
            }

            .image-box.has-image img {
                display: block;
                /* only show if .has-image class present */
            }

            .image-box.has-image .remove-btn {
                display: block;
            }

            /* Optional: validation styling */
            .image-box.image-invalid {
                border-color: red;
                background-color: #ffe6e6;
            }
        </style>

        <div class="col-xl-12 col-lg-6">
            <div class="row">
                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="mb-3">All Categories</p>
                            @foreach ($categories as $cat)
                                <div class="mb-3" style="width: 100%;">
                                    <a class="btn btn-white w-100 text-left" href="{{ route('edit.category', $cat->id) }}">
                                        <i class="fe fe-grid text"></i>
                                        <span style="font-weight: bold">{{ $cat->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="name11" value="{{ $category->name }}"
                                    placeholder="Enter category name">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-9">
                                    <label class="form-label">Parent</label>
                                    <select name="parent" class="form-control custom-select select2">
                                        <option value="">Select Parent Category</option>
                                        <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>None
                                        </option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control custom-select select2">
                                        <option value="10" {{ $category->status == 10 ? 'selected' : '' }}>Published
                                        </option>
                                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Pending
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea id="t_description" name="description">{{ $category->description }}</textarea>
                            </div>

                            <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

                            <div class="form-group mt-3">
                                <label class="form-label">Featured Image</label>

                                <div class="image-box image-box-icon_image {{ $category->featured_image ? 'has-image' : '' }}"
                                    tabindex="0" role="button" aria-label="Select or drag and drop an image">
                                    <img id="featured_image_preview"
                                        src="{{ $category->featured_image ? asset('storage/' . $category->featured_image) : '' }}"
                                        alt="Selected image preview" />

                                    <span id="image_placeholder"
                                        style="{{ $category->featured_image ? 'display:none;' : '' }}">
                                        Click or drag and drop an image here
                                    </span>

                                    <button type="button" class="remove-btn"
                                        aria-label="Remove selected image">&times;</button>

                                    <input type="file" name="featured_image" id="featured_image_input" accept="image/*"
                                        style="display:none;">
                                </div>

                            </div>

                            <div class="form-footer mt-2">
                                <button id="saveCategoryBtn" class="btn btn-primary" type="button"
                                    data-id="{{ $category->id }}">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#t_description'))
                .then(editor => {
                    window.t_description = editor;
                })
                .catch(error => {
                    console.error('There was a problem initializing CKEditor:', error);
                });

            // Image upload and preview logic
            const imageBox = document.querySelector('.image-box-icon_image');
            const imageInput = document.getElementById('featured_image_input');
            const imagePreview = document.getElementById('featured_image_preview');
            const imagePlaceholder = document.getElementById('image_placeholder');
            const removeBtn = imageBox.querySelector('.remove-btn');

            // Check if there's an existing image on load and update UI
            if (imagePreview.src && imagePreview.src !== window.location.href) {
                imageBox.classList.add('has-image');
                imagePreview.style.display = 'block';
                imagePlaceholder.style.display = 'none';
            }

            // Click on image box to open file input
            imageBox.addEventListener('click', () => imageInput.click());

            // Keyboard accessibility for image box
            imageBox.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    imageInput.click();
                }
            });

            // Handle file selection
            imageInput.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    loadImage(e.target.files[0]);
                }
            });

            // Drag & drop handlers
            imageBox.addEventListener('dragover', (e) => {
                e.preventDefault();
                imageBox.classList.add('dragover');
            });

            imageBox.addEventListener('dragleave', (e) => {
                e.preventDefault();
                imageBox.classList.remove('dragover');
            });

            imageBox.addEventListener('drop', (e) => {
                e.preventDefault();
                imageBox.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length && files[0].type.startsWith('image/')) {
                    loadImage(files[0]);
                    imageInput.files = files; // Update input file so form submits correct file
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File',
                        text: 'Please drop an image file.',
                    });
                }
            });

            // Remove button clears image
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent click event from bubbling to imageBox
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                imagePlaceholder.style.display = 'block';
                imageInput.value = ''; // Clear the file input
                imageBox.classList.remove('has-image');
                imageBox.classList.remove('image-invalid'); // Remove validation error
            });

            // Helper function to preview image
            function loadImage(file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                    imagePreview.style.display = 'block';
                    imagePlaceholder.style.display = 'none';
                    imageBox.classList.add('has-image');
                    imageBox.classList.remove('image-invalid'); // Remove validation error on new image
                }
                reader.readAsDataURL(file);
            }
        });

        // jQuery document ready for the save functionality
        $(document).ready(function() {
            $('#saveCategoryBtn').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);
                const categoryId = btn.data('id');

                // Get form inputs
                const name = $('#name11').val().trim();
                const parent = $('select[name="parent"]').val();
                const status = $('select[name="status"]').val();
                const description = window.t_description?.getData()?.trim();
                const imageFile = $('#featured_image_input')[0].files[0];

                const imageBox = document.querySelector('.image-box-icon_image');
                const imageInput = document.getElementById('featured_image_input');
                const hasImage = imageInput.files.length > 0 || imageBox.classList.contains('has-image');

                let isValid = true;
                let errorMessages = [];

                // Validation checks
                if (!name) {
                    $('#name11').addClass('is-invalid');
                    errorMessages.push('Please enter a category name.');
                    isValid = false;
                } else {
                    $('#name11').removeClass('is-invalid');
                }

                // Note: Parent can be '0' for no parent, so check for null/undefined/empty string
                if (parent === null || parent === undefined || parent === '') {
                    $('select[name="parent"]').addClass('is-invalid');
                    errorMessages.push('Please select a parent category.');
                    isValid = false;
                } else {
                    $('select[name="parent"]').removeClass('is-invalid');
                }

                // Note: Status can be '0' or '1' or '10', so check for null/undefined/empty string
                if (status === null || status === undefined || status === '') {
                    $('select[name="status"]').addClass('is-invalid');
                    errorMessages.push('Please select a status.');
                    isValid = false;
                } else {
                    $('select[name="status"]').removeClass('is-invalid');
                }

                if (!description) {
                    errorMessages.push('Please enter a description.');
                    isValid = false;
                }

                if (!hasImage) {
                    imageBox.classList.add('image-invalid');
                    errorMessages.push('Please select a featured image.');
                    isValid = false;
                } else {
                    imageBox.classList.remove('image-invalid');
                }

                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please fix the following:',
                        html: '<ul style="text-align: left;">' + errorMessages.map(msg =>
                            `<li>${msg}</li>`).join('') + '</ul>'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to save changes to this category?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Save it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        btn.prop('disabled', true).html(
                            'Saving... <i class="fas fa-spinner fa-spin"></i>');

                        // ... (inside the result.isConfirmed block)

                        const formData = new FormData();
                        
                        formData.append('name', name);
                        formData.append('parent_id', parent);
                        formData.append('status', status);
                        formData.append('description', description);
                        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                        formData.append('_method', 'PUT');

                        // --- START: Refined Image Handling ---

                        // Case 1: A new image file has been selected
                        if (imageFile) {
                            formData.append('featured_image', imageFile);
                        }
                        // Case 2: No new image, but the user explicitly clicked the remove button
                        // This condition assumes your remove button successfully clears the has-image class and the input value.
                        else if (!imageBox.classList.contains('has-image') && !imageInput.files
                            .length) {
                            // This implies an existing image was removed, or a new image was added and then cleared.
                            // Send a signal to the backend to clear the existing image.
                            formData.append('remove_featured_image', '1');
                        }
                        // Case 3: No new image, and no explicit removal (meaning the existing image should be kept)
                        // You don't need to append anything for 'featured_image' if it's already there and not changing.
                        // The backend should simply not update the 'featured_image' column if no file is received.

                        // --- END: Refined Image Handling ---

                        // ... (rest of your AJAX call)
                        $.ajax({
                            url: `/update-category/${categoryId}`, // Your update route
                            type: 'POST', // Use POST with _method=PUT/PATCH for Laravel
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Category Updated',
                                    text: response.message ||
                                        'The category was updated successfully.',
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            // error: function(xhr) {
                            //     let errorMsg = 'An error occurred.';
                            //     if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            //         errorMsg = Object.values(xhr.responseJSON.errors)
                            //             .flat().join(
                            //                 '<br>'); // Use <br> for new lines in HTML
                            //     } else if (xhr.responseJSON?.message) {
                            //         errorMsg = xhr.responseJSON.message;
                            //     }
                            //     Swal.fire({
                            //         icon: 'error',
                            //         title: 'Error',
                            //         html: errorMsg,
                            //     });
                            //     console.error(xhr);
                            // },
                            error: function(data) {
                                $('body').html(data.responseText);
                            },
                            complete: function() {
                                btn.prop('disabled', false).html(
                                    '<i class="fas fa-save"></i> Save');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
@section('js')
    <!-- ECharts js -->
    <script src="{{ URL::asset('assets2/plugins/echarts/echarts.js') }}"></script>
    <!-- Peitychart js-->
    <script src="{{ URL::asset('assets2/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/peitychart/peitychart.init.js') }}"></script>
    <!-- Apexchart js-->
    <script src="{{ URL::asset('assets2/js/apexcharts.js') }}"></script>
    <!--Moment js-->
    <script src="{{ URL::asset('assets2/plugins/moment/moment.js') }}"></script>
    <!-- Daterangepicker js-->
    <script src="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/daterange.js') }}"></script>
    <!---jvectormap js-->
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.world.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/jvectormap/jquery.vmap.sampledata.js') }}"></script>
    <!-- P-scroll js-->
    <script src="{{ URL::asset('assets2/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
    <!-- Index js-->
    <script src="{{ URL::asset('assets2/js/index1.js') }}"></script>
    <!-- Data tables js-->
    <script src="{{ URL::asset('assets2/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/js/datatables.js') }}"></script>
    <!--Counters -->
    <script src="{{ URL::asset('assets2/plugins/counters/counterup.min.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/counters/waypoints.min.js') }}"></script>
    <!--Chart js -->
    <script src="{{ URL::asset('assets2/plugins/chart/chart.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets2/plugins/chart/utils.js') }}"></script>
@endsection
