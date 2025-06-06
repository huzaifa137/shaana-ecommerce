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
                <a href="{{ url(route('add.category')) }}" class="btn btn-md btn-primary">
                    <i class="fas fa-plus me-2"></i> Create Category
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">

        <div class="col-xl-12 col-lg-6">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <div class="card-body p-3">
                                            <div class="table-responsive">
                                                <table id="categoryTable"
                                                    class="table table-bordered table-hover align-middle">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th style="width: 1px;">No</th>
                                                            <th>Category Name</th>
                                                            <th colspan="2">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($categories as $key => $category)
                                                            <tr class="bg-light">
                                                                <td class="fw-bold" style="width: 1px;">{{ $key + 1 }}
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center justify-content-between mb-3"
                                                                        style="width: 100%;">
                                                                        <a class="btn btn-white w-100 text-left me-2"
                                                                            href="#">
                                                                            <i class="fe fe-grid text"></i>
                                                                            <span
                                                                                style="font-weight: bold">{{ $category->name }}</span>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-outline-primary me-1 btn-edit"
                                                                        data-id="{{ $category->id }}"
                                                                        data-edit-url="{{ route('edit.product', $category->id) }}"
                                                                        title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-sm btn-outline-danger btn-delete"
                                                                        data-id="{{ $category->id }}" title="Delete">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr class="bg-light">
                                                                <td colspan="7" class="text-center text-muted py-4">No
                                                                    categories found.</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>

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
