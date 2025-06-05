@extends('layouts2.master')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!---jvectormap css-->
    <link href="{{ URL::asset('assets2/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Data table css -->
    <link href="{{ URL::asset('assets2/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <!--Daterangepicker css-->
    <link href="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <!-- DataTables CSS (Bootstrap 5) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endsection
@section('page-header')
    <div class="page-header">
        <div class="page-leftheader">
            <h4 class="page-title">Product Categories</h4>
        </div>
        <div class="page-rightheader ml-auto d-lg-flex d-none">
            <div class="ml-5 mb-0">
                <a href="{{ route('add.product') }}" class="btn btn-md btn-primary">
                    <i class="fas fa-plus me-2"></i> Create
                </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Products</h5>
            </div>

            <div class="card-body p-3">
                <div class="table-responsive">
                    <table id="productsTable" class="table table-striped table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 1px;">No</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th style="width: 90px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                                <tr>
                                    <td class="fw-bold" style="width: 1px;"s>{{ $key + 1 }}</td>
                                    <td>
                                        @if ($product->featured_image_1)
                                            <img src="{{ asset('storage/' . $product->featured_image_1) }}" alt="Image"
                                                class="rounded shadow-sm" style="width: 45px; height: auto;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $product->product_name }}</td>
                                    <td><strong>${{ number_format((float) str_replace(',', '', $product->price), 2) }}</strong>
                                    </td>
                                    <td>
                                        @switch($product->status)
                                            @case(10)
                                                <span class="badge bg-success">Published</span>
                                            @break

                                            @case(0)
                                                <span class="badge bg-secondary">Draft</span>
                                            @break

                                            @case(1)
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @break

                                            @default
                                                <span class="badge bg-light text-dark">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary me-1 btn-edit"
                                            data-id="{{ $product->id }}"
                                            data-edit-url="{{ route('edit.product', $product->id) }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btn-delete"
                                            data-id="{{ $product->id }}" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No products found.</td>
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


        <style>
            .table-hover tbody tr:hover {
                background-color: #f8f9fa !important;
            }

            .dataTables_filter input {
                border-radius: 6px;
                padding: 6px 10px;
                border: 1px solid #ccc;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0.35rem 0.65rem;
                margin: 0 2px;
                border-radius: 4px;
                font-size: 0.875rem;
            }

            .dataTables_wrapper .dataTables_length select {
                border-radius: 5px;
                padding: 4px 8px;
            }

            .dt-buttons .btn {
                margin-right: 6px;
                margin-bottom: 10px;
            }
        </style>

        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @section('js')
        <script>
            $(document).ready(function() {
                var table = $('#productsTable').DataTable({
                    responsive: false,
                    pageLength: 10,
                    order: [
                        [0, 'desc']
                    ],
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'copy',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        {
                            extend: 'csv',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        {
                            extend: 'excel',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn btn-sm btn-outline-secondary'
                        },
                        {
                            extend: 'print',
                            className: 'btn btn-sm btn-outline-secondary'
                        }
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [1, 4, 5]
                        },
                        {
                            className: 'text-center',
                            targets: '_all'
                        }
                    ],
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search products..."
                    }
                });

                // Delete button click handler
                $('#productsTable tbody').on('click', '.btn-delete', function() {
                    var productId = $(this).data('id');
                    var row = table.row($(this).parents('tr')); // Now 'table' is defined

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/products/' + productId,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    row.remove().draw(); // remove row without page reload

                                    Swal.fire(
                                        'Deleted!',
                                        'Product has been deleted.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Error!',
                                        'Something went wrong deleting the product.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                });

                $('#productsTable tbody').on('click', '.btn-edit', function() {
                    var editUrl = $(this).data('edit-url');

                    Swal.fire({
                        title: 'Edit Product?',
                        text: "You are about to edit this product.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0d6efd',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, proceed!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = editUrl;
                        }
                    });
                });

            });
        </script>


        <!-- DataTables + Buttons JS -->

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <!-- Buttons CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" />

        <!-- Buttons JS -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

        <!-- Export libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

        <!-- Buttons HTML5 export, print and column visibility -->
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

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
