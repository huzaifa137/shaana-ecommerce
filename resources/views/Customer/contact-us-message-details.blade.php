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
    <!--Page header-->
    <div class="page-header">
        <div class="page-rightheader ml-auto d-lg-flex d-none">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="d-flex"><svg class="svg-icon"
                            xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg><span class="breadcrumb-icon"> Home</span></a></li>
                <li class="breadcrumb-item"><a href="javascript:void();">Orders</a></li>
            </ol>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="container py-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div
                        class="card-header bg-primary text-white py-4 px-4 d-flex justify-content-between align-items-center">
                        <h2 class="mb-0 text-white">Message #{{ $message->id }}</h2>
                        <form id="update-status-form" action="{{ route('admin.messages.updateStatus', $message->id) }}"
                            method="POST">
                            @csrf
                            <div class="input-group input-group-sm">
                                <select name="status" id="messageStatus"
                                    class="form-select form-control custom-select-width">
                                    @foreach (['pending', 'reviewed', 'resolved'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $message->status === $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Name:</strong> {{ $message->name }}</p>
                                <p class="mb-2"><strong>Email:</strong> {{ $message->email }}</p>
                                <p class="mb-2"><strong>Phone:</strong> {{ $message->phone }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p class="text-muted mb-0">Message received on:
                                    {{ \Carbon\Carbon::parse($message->created_at)->format('M d, Y h:i A') }}
                                </p>
                            </div>
                        </div>

                        <h4 class="mt-4 mb-3 text-primary">Message Content</h4>
                        <div class="card bg-light p-3 mb-4 rounded">
                            <p class="mb-0">{{ $message->message }}</p>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-end py-3 px-4">
                        <a href="{{ route('customer.contactus.messages') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Back to Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('messageStatus');
            const form = document.getElementById('update-status-form');

            statusSelect.addEventListener('change', function() {
                const newStatus = this.value;
                const currentStatus = "{{ $message->status }}";

                if (newStatus === currentStatus) {
                    return;
                }

                Swal.fire({
                    title: 'Confirm Status Change?',
                    text: `Are you sure you want to change the order status to "${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Updating order status, please wait.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

              
                        form.submit();
                    } else {
                        
                        statusSelect.value = currentStatus;
                    }
                });
            });


            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "{{ session('error') }}",
                    showConfirmButton: true
                });
            @endif
        });
    </script>

    <style>
        .custom-select-width {
            width: auto !important;
            min-width: 120px;
        }

        @media (max-width: 767.98px) {
            .custom-select-width {
                min-width: unset;
                width: 100% !important;
            }
        }
    </style>

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
@endsection
