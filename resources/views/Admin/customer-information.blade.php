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
                <li class="breadcrumb-item"><a href="javascript:void();">Customer</a></li>
            </ol>
        </div>
    </div>
    <!--End Page header-->
@endsection
@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <div class="card box-widget widget-user">

                <div class="card-body text-center">
                    <div class="pro-user">
                        <h3 class="pro-user-username text-dark mb-1">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </h3>
                        <h6 class="pro-user-desc text-muted">{{ $customer->company_name ?? 'No Company' }}</h6>
                    </div>
                </div>
                <div class="card-footer p-0">
                    <div class="row">
                        <div class="col-sm-6 border-right text-center">
                            <div class="description-block p-4">
                                <h5 class="description-header mb-1 font-weight-bold">
                                    {{ $customer->created_at->diffForHumans() }}</h5>
                                <span class="text-muted">Joined</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="description-block text-center p-4">
                                @php
                                    $statusMap = [
                                        1 => ['label' => 'Active', 'class' => 'text-success'],
                                        0 => ['label' => 'Temporarily Disabled', 'class' => 'text-warning'],
                                        -1 => ['label' => 'Banned', 'class' => 'text-danger'],
                                    ];

                                    $status = $statusMap[$customer->is_active] ?? [
                                        'label' => 'Unknown',
                                        'class' => 'text-muted',
                                    ];
                                @endphp

                                <h5 class="description-header mb-1 font-weight-bold {{ $status['class'] }}">
                                    {{ $status['label'] }}
                                </h5>
                                <span class="text-muted">Status</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Customer Information</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @php
                            $inputAttrs = 'class=form-control readonly disabled';
                        @endphp
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" value="{{ $customer->first_name }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" value="{{ $customer->last_name }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ $customer->email }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="{{ $customer->mobile }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" value="{{ $customer->address }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" value="{{ $customer->city }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Postcode</label>
                                <input type="text" value="{{ $customer->postcode }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" value="{{ $customer->country }}" {!! $inputAttrs !!}>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row align-items-start">
                        <!-- Left: Status Form -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="userStatus" class="form-label">Account Status</label>
                                <form id="update-user-status-form"
                                    action="{{ route('admin.customers.updateStatus', $customer->id) }}" method="POST"
                                    class="d-flex align-items-center">

                                    @csrf
                                    <select name="is_active" id="userStatus" class="form-select form-control w-100">
                                        @foreach ([1 => 'Active', 0 => 'Temporarily Disabled', -1 => 'Banned'] as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ $customer->is_active == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>

                        <!-- Right: Back Button -->
                        <div class="col-md-6 d-flex flex-column align-items-end justify-content-end ms-auto">
                            <div class="form-group text-end">
                                <label class="form-label d-block">Return to Customers</label>
                                <a href="{{ route('all.customers') }}" class="btn btn-md btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Back to List
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Row -->

    </div>
    </div><!-- end app-content-->
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('userStatus');
            const form = document.getElementById('update-user-status-form');

            const statusLabels = {
                '1': 'Active',
                '0': 'Temporarily Disabled',
                '-1': 'Banned'
            };

            const currentStatus = "{{ $customer->is_active }}";

            statusSelect.addEventListener('change', function() {
                const newStatus = this.value;

                if (newStatus === currentStatus) return;

                Swal.fire({
                    title: 'Change Account Status?',
                    text: `Are you sure you want to set the user account to "${statusLabels[newStatus]}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Updating account status, please wait.',
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

    <!--Select2 js -->
    <script src="{{ URL::asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
@endsection
