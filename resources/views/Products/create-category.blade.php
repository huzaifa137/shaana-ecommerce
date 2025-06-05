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
        {{-- <div class="page-rightheader ml-auto d-lg-flex d-none">
            <div class="ml-5 mb-0">
                <a href="" class="btn btn-md btn-primary">
                    <i class="fas fa-plus me-2"></i> Create
                </a>
            </div>
        </div> --}}
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
            }

            .image-box span {
                color: #888;
                user-select: none;
            }

            .image-box .remove-btn {
                position: absolute;
                top: 4px;
                right: 4px;
                background: rgba(0, 0, 0, 0.6);
                color: white;
                border: none;
                border-radius: 50%;
                width: 24px;
                height: 24px;
                font-weight: bold;
                font-size: 16px;
                line-height: 20px;
                cursor: pointer;
                display: none;
            }

            .image-box.has-image .remove-btn {
                display: block;
            }
        </style>

        <div class="col-xl-12 col-lg-6">
            <div class="row">
                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-3">All Categories</p>
                                    <div>
                                        @foreach ($categories as $category)
                                            <div class="mb-3" style="width: 100%;">
                                                <a class="btn btn-white w-100 text-left" href="#">
                                                    <i class="fe fe-grid text"></i> <span
                                                        style="font-weight: bold">{{ $category->name }}</span>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-md-12 col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="form">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name11"
                                            placeholder="Enter category name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-9 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Parent</label>
                                        <select name="credit_card_type" class="form-control custom-select select2">
                                            <option value="">Select Parent Category</option>
                                            <option value="0">None</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select name="credit_card_type" class="form-control custom-select select2">
                                            <option value="10">Published</option>
                                            <option value="0">Draft</option>
                                            <option value="1">Pending</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea id="t_description" name="description"></textarea>
                            </div>

                            <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>


                            <div class="form">
                                <div class="form-group">
                                    <label class="form-label">Featured Image</label>

                                    <div class="image-box image-box-icon_image" action="select-image" tabindex="0"
                                        role="button" aria-label="Select or drag and drop an image">
                                        <img id="featured_image_preview" alt="Selected image preview" />
                                        <span id="image_placeholder">Click or drag and drop an image here</span>
                                        <button type="button" class="remove-btn"
                                            aria-label="Remove selected image">&times;</button>
                                        <input type="file" id="featured_image_input" accept="image/*"
                                            style="display:none;">
                                    </div>
                                </div>
                            </div>

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
                                });

                                const imageBox = document.querySelector('.image-box-icon_image');
                                const imageInput = document.getElementById('featured_image_input');
                                const imagePreview = document.getElementById('featured_image_preview');
                                const imagePlaceholder = document.getElementById('image_placeholder');
                                const removeBtn = imageBox.querySelector('.remove-btn');


                                imageBox.addEventListener('click', () => {
                                    imageInput.click();
                                });

                                imageBox.addEventListener('keydown', (e) => {
                                    if (e.key === 'Enter' || e.key === ' ') {
                                        e.preventDefault();
                                        imageInput.click();
                                    }
                                });


                                imageInput.addEventListener('change', (e) => {
                                    if (e.target.files.length) {
                                        loadImage(e.target.files[0]);
                                    }
                                });

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
                                    if (files.length) {
                                        if (files[0].type.startsWith('image/')) {
                                            loadImage(files[0]);
                                        } else {
                                            alert('Please drop an image file.');
                                        }
                                    }
                                });


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


                                removeBtn.addEventListener('click', (e) => {
                                    e.stopPropagation();
                                    imagePreview.src = '';
                                    imagePreview.style.display = 'none';
                                    imagePlaceholder.style.display = 'block';
                                    imageInput.value = '';
                                    imageBox.classList.remove('has-image');
                                });
                            </script>

                            <div class="form-footer mt-2">
                                <button id="saveCategoryBtn" class="btn btn-primary" type="button">
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
        $(document).ready(function() {
            $('#saveCategoryBtn').on('click', function(e) {
                e.preventDefault();

                const btn = $(this);

                // Get form inputs
                const name = $('#name11').val().trim();
                const parent = $('.select2[name="credit_card_type"]').eq(0).val();
                const status = $('.select2[name="credit_card_type"]').eq(1).val();
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
                    $('.select2[name="credit_card_type"]').eq(0).addClass('is-invalid');
                    errorMessages.push('Please select a parent category.');
                    isValid = false;
                } else {
                    $('.select2[name="credit_card_type"]').eq(0).removeClass('is-invalid');
                }


                if (!status) {
                    $('.select2[name="credit_card_type"]').eq(1).addClass('is-invalid');
                    errorMessages.push('Please select a status.');
                    isValid = false;
                } else {
                    $('.select2[name="credit_card_type"]').eq(1).removeClass('is-invalid');
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

                if (!isValid) {
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to save this category?',
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
                            url: '/store-category',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Category Saved',
                                    text: response.message ||
                                        'The category was saved successfully.',
                                }).then(() => {
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
