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
                <!-- LEFT COLUMN: List of all categories -->
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

                <!-- RIGHT COLUMN: Edit Form -->
                <div class="col-xl-8 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="name11" value="{{ $category->name }}"
                                    placeholder="Enter category name">
                            </div>

                            <!-- Parent and Status -->
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

                            <!-- Description -->
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea id="t_description" name="description">{{ $category->description }}</textarea>
                            </div>

                            <!-- CKEditor -->
                            <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    ClassicEditor
                                        .create(document.querySelector('#t_description'))
                                        .then(editor => {
                                            window.t_description = editor;
                                        })
                                        .catch(error => {
                                            console.error('There was a problem initializing CKEditor:', error);
                                        });

                                    @if ($category->featured_image)
                                        const preview = document.getElementById('featured_image_preview');
                                        preview.src = "{{ $category->featured_image }}";
                                        preview.style.display = 'block';
                                        document.getElementById('image_placeholder').style.display = 'none';
                                        document.querySelector('.image-box-icon_image').classList.add('has-image');
                                    @endif
                                });
                            </script>

                            <!-- Featured Image -->
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

                            <!-- Save Button -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageBox = document.querySelector('.image-box-icon_image');
            const imageInput = document.getElementById('featured_image_input');
            const imagePreview = document.getElementById('featured_image_preview');
            const imagePlaceholder = document.getElementById('image_placeholder');
            const removeBtn = imageBox.querySelector('.remove-btn');

            // If there is an initial image, add class to container
            if (imagePreview.src) {
                imageBox.classList.add('has-image');
                imagePreview.style.display = 'block';
                imagePlaceholder.style.display = 'none';
            }

            // Click triggers file select
            imageBox.addEventListener('click', () => imageInput.click());

            // Keyboard accessibility (enter/space)
            imageBox.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    imageInput.click();
                }
            });

            // File input change
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
                    imageInput.files = files; // update input file so form submits correct file
                } else {
                    alert('Please drop an image file.');
                }
            });

            // Remove button clears image
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                imagePlaceholder.style.display = 'block';
                imageInput.value = '';
                imageBox.classList.remove('has-image');
            });

            // Helper function to preview image
            function loadImage(file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                    imagePreview.style.display = 'block';
                    imagePlaceholder.style.display = 'none';
                    imageBox.classList.add('has-image');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#saveCategoryBtn').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);
                const categoryId = btn.data('id'); // get category id from button data attribute

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

                if (!name) {
                    $('#name11').addClass('is-invalid');
                    errorMessages.push('Please enter a category name.');
                    isValid = false;
                } else {
                    $('#name11').removeClass('is-invalid');
                }

                if (!parent) {
                    $('select[name="parent"]').addClass('is-invalid');
                    errorMessages.push('Please select a parent category.');
                    isValid = false;
                } else {
                    $('select[name="parent"]').removeClass('is-invalid');
                }

                if (!status) {
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
                        title: 'Please fix the following : ',
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

                        const formData = new FormData();
                        formData.append('name', name);
                        formData.append('parent', parent);
                        formData.append('status', status);
                        formData.append('description', description);
                        if (imageFile) {
                            formData.append('featured_image', imageFile);
                        }
                        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                        $.ajax({
                            url: `/update-category/${categoryId}`, // your update route
                            type: 'POST', // or 'PUT' if you configure it
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
                                    // Optionally redirect or reload page
                                    location.reload();
                                });
                            },
                            // error: function(xhr) {
                            //     let errorMsg = 'An error occurred.';
                            //     if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            //         errorMsg = Object.values(xhr.responseJSON.errors)
                            //             .flat().join('\n');
                            //     }
                            //     Swal.fire({
                            //         icon: 'error',
                            //         title: 'Error',
                            //         text: errorMsg,
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

    <script>
        $(document).ready(function() {
            const imageBox = $('.image-box-icon_image');
            const imageInput = $('#featured_image_input');
            const imagePreview = $('#featured_image_preview');
            const imagePlaceholder = $('#image_placeholder');
            const removeBtn = imageBox.find('.remove-btn');

            // Show image preview if initial image src exists
            if (imagePreview.attr('src')) {
                imageBox.addClass('has-image');
                imagePreview.show();
                imagePlaceholder.hide();
                removeBtn.show();
            }

            // Click on box triggers file input
            imageBox.on('click', function() {
                imageInput.click();
            });

            // Keyboard accessibility (Enter/Space opens file dialog)
            imageBox.on('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    imageInput.click();
                }
            });

            // File input change -> load preview
            imageInput.on('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.attr('src', event.target.result).show();
                        imagePlaceholder.hide();
                        imageBox.addClass('has-image');
                        removeBtn.show();
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Drag & drop handlers
            imageBox.on('dragover', function(e) {
                e.preventDefault();
                imageBox.addClass('dragover');
            });

            imageBox.on('dragleave', function(e) {
                e.preventDefault();
                imageBox.removeClass('dragover');
            });

            imageBox.on('drop', function(e) {
                e.preventDefault();
                imageBox.removeClass('dragover');

                const files = e.originalEvent.dataTransfer.files;
                if (files.length && files[0].type.startsWith('image/')) {
                    imageInput[0].files = files;
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.attr('src', event.target.result).show();
                        imagePlaceholder.hide();
                        imageBox.addClass('has-image');
                        removeBtn.show();
                    }
                    reader.readAsDataURL(files[0]);
                } else {
                    alert('Please drop an image file.');
                }
            });

            // Remove image button click
            removeBtn.on('click', function(e) {
                e.stopPropagation();
                imageInput.val('');
                imagePreview.attr('src', '').hide();
                imagePlaceholder.show();
                imageBox.removeClass('has-image');
                removeBtn.hide();
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
