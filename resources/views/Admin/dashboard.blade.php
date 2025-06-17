@extends('layouts2.master')
@section('css')
    <!---jvectormap css-->
    <link href="{{ URL::asset('assets2/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
    <!-- Data table css -->
    <link href="{{ URL::asset('assets2/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <!--Daterangepicker css-->
    <link href="{{ URL::asset('assets2/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <!--Row-->
    <div class="row">

        <style>
            .card-custom-icon {
                font-size: 3rem;
            }

            .customer-row {
                transition: background-color 0.3s ease;
                cursor: pointer;
            }

            .customer-row:hover {
                background-color: #f5f5f5;
            }

            .customer-row:hover .customer-name {
                color: #007bff;
            }

            .customer-row:hover .customer-country {
                color: #495057;
            }

            .customer-info {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .customer-name {
                margin: 0;
                font-weight: 600;
                font-size: 1rem;
                color: #333;
            }

            .customer-country {
                color: #6c757d;
                font-size: 0.875rem;
            }

            td[colspan="1"] {
                text-align: center;
                padding: 15px;
                color: #888;
                font-style: italic;
            }

            .transaction-row:hover {
                background-color: #f5f5f5;
            }
        </style>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <div class="col-xl-12 col-md-12 col-lg-12">

            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Font Awesome Shopping Cart Icon (All Orders) -->
                            <i class="fas fa-shopping-cart card-custom-icon text-primary icon-dropshadow-primary"
                                style="font-size: 3rem;"></i>
                            <p class="mb-1">All Orders</p>
                            <h2 class="mb-1 font-weight-bold">{{ $allOrders }}</h2>
                            <div class="progress progress-sm mt-3 bg-primary-transparent">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Clock Icon (Pending Orders) -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="card-custom-icon text-warning icon-dropshadow-warning" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="mb-1">Pending Orders</p>
                            <h2 class="mb-1 font-weight-bold">{{ $pendingOrders }}</h2>
                            <div class="progress progress-sm mt-3 bg-warning-transparent">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Truck Icon (Shipped Orders) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="card-custom-icon text-info icon-dropshadow-info"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17H6a1 1 0 01-1-1V6a1 1 0 011-1h9v3h3l3 3v5a1 1 0 01-1 1h-1m-3 0a2 2 0 11-4 0 2 2 0 014 0zm-10 0a2 2 0 104 0 2 2 0 00-4 0z" />
                            </svg>
                            <p class="mb-1">Shipped Orders</p>
                            <h2 class="mb-1 font-weight-bold">{{ $shippedOrders }}</h2>
                            <div class="progress progress-sm mt-3 bg-info-transparent">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Font Awesome Check Circle Icon (Delivered Orders) -->
                            <i class="fas fa-check-circle card-custom-icon text-success icon-dropshadow-success"></i>
                            <p class="mb-1">Delivered Orders</p>
                            <h2 class="mb-1 font-weight-bold">{{ $deliveredOrders }}</h2>
                            <div class="progress progress-sm mt-3 bg-success-transparent">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-md-12 col-lg-12">
                    <div class="card overflow-hidden">
                        <div class="row">
                            <div class="col-xl-8 col-md-12 col-lg-7 pb-5">
                                <div class="card-header pb-50  border-0">
                                    <h4 class="card-title">Country Base Customers</h4>
                                </div>
                                <div id="vmap" class="vmap-width"></div>
                            </div>
                            <div class="col-xl-4 col-md-12 col-lg-5 pl-0 pt-3 border-left">

    @php
        // Define your comprehensive list of countries and their codes.
        // This is crucial for mapping country names from your stats to their flags.
        // Ideally, this data (or just $countryCodes) should be passed from your controller
        // to avoid duplicating large arrays in your Blade files.
        $countries = [
            ['code' => 'af', 'name' => 'Afghanistan'],
            ['code' => 'al', 'name' => 'Albania'],
            ['code' => 'dz', 'name' => 'Algeria'],
            ['code' => 'ad', 'name' => 'Andorra'],
            ['code' => 'ao', 'name' => 'Angola'],
            ['code' => 'ag', 'name' => 'Antigua and Barbuda'],
            ['code' => 'ar', 'name' => 'Argentina'],
            ['code' => 'am', 'name' => 'Armenia'],
            ['code' => 'au', 'name' => 'Australia'],
            ['code' => 'at', 'name' => 'Austria'],
            ['code' => 'az', 'name' => 'Azerbaijan'],
            ['code' => 'bs', 'name' => 'Bahamas'],
            ['code' => 'bh', 'name' => 'Bahrain'],
            ['code' => 'bd', 'name' => 'Bangladesh'],
            ['code' => 'bb', 'name' => 'Barbados'],
            ['code' => 'by', 'name' => 'Belarus'],
            ['code' => 'be', 'name' => 'Belgium'],
            ['code' => 'bz', 'name' => 'Belize'],
            ['code' => 'bj', 'name' => 'Benin'],
            ['code' => 'bt', 'name' => 'Bhutan'],
            ['code' => 'bo', 'name' => 'Bolivia (Plurinational State of)'],
            ['code' => 'ba', 'name' => 'Bosnia and Herzegovina'],
            ['code' => 'bw', 'name' => 'Botswana'],
            ['code' => 'br', 'name' => 'Brazil'],
            ['code' => 'bn', 'name' => 'Brunei Darussalam'],
            ['code' => 'bg', 'name' => 'Bulgaria'],
            ['code' => 'bf', 'name' => 'Burkina Faso'],
            ['code' => 'bi', 'name' => 'Burundi'],
            ['code' => 'cv', 'name' => 'Cabo Verde'],
            ['code' => 'kh', 'name' => 'Cambodia'],
            ['code' => 'cm', 'name' => 'Cameroon'],
            ['code' => 'ca', 'name' => 'Canada'],
            ['code' => 'cf', 'name' => 'Central African Republic'],
            ['code' => 'td', 'name' => 'Chad'],
            ['code' => 'cl', 'name' => 'Chile'],
            ['code' => 'cn', 'name' => 'China'],
            ['code' => 'co', 'name' => 'Colombia'],
            ['code' => 'km', 'name' => 'Comoros'],
            ['code' => 'cd', 'name' => 'Congo (Democratic Republic of the)'],
            ['code' => 'cg', 'name' => 'Congo'],
            ['code' => 'cr', 'name' => 'Costa Rica'],
            ['code' => 'ci', 'name' => 'Côte d\'Ivoire'],
            ['code' => 'hr', 'name' => 'Croatia'],
            ['code' => 'cu', 'name' => 'Cuba'],
            ['code' => 'cy', 'name' => 'Cyprus'],
            ['code' => 'cz', 'name' => 'Czechia'],
            ['code' => 'dk', 'name' => 'Denmark'],
            ['code' => 'dj', 'name' => 'Djibouti'],
            ['code' => 'dm', 'name' => 'Dominica'],
            ['code' => 'do', 'name' => 'Dominican Republic'],
            ['code' => 'ec', 'name' => 'Ecuador'],
            ['code' => 'eg', 'name' => 'Egypt'],
            ['code' => 'sv', 'name' => 'El Salvador'],
            ['code' => 'gq', 'name' => 'Equatorial Guinea'],
            ['code' => 'er', 'name' => 'Eritrea'],
            ['code' => 'ee', 'name' => 'Estonia'],
            ['code' => 'sz', 'name' => 'Eswatini'],
            ['code' => 'et', 'name' => 'Ethiopia'],
            ['code' => 'fj', 'name' => 'Fiji'],
            ['code' => 'fi', 'name' => 'Finland'],
            ['code' => 'fr', 'name' => 'France'],
            ['code' => 'ga', 'name' => 'Gabon'],
            ['code' => 'gm', 'name' => 'Gambia'],
            ['code' => 'ge', 'name' => 'Georgia'],
            ['code' => 'de', 'name' => 'Germany'],
            ['code' => 'gh', 'name' => 'Ghana'],
            ['code' => 'gr', 'name' => 'Greece'],
            ['code' => 'gd', 'name' => 'Grenada'],
            ['code' => 'gt', 'name' => 'Guatemala'],
            ['code' => 'gn', 'name' => 'Guinea'],
            ['code' => 'gw', 'name' => 'Guinea-Bissau'],
            ['code' => 'gy', 'name' => 'Guyana'],
            ['code' => 'ht', 'name' => 'Haiti'],
            ['code' => 'hn', 'name' => 'Honduras'],
            ['code' => 'hu', 'name' => 'Hungary'],
            ['code' => 'is', 'name' => 'Iceland'],
            ['code' => 'in', 'name' => 'India'],
            ['code' => 'id', 'name' => 'Indonesia'],
            ['code' => 'ir', 'name' => 'Iran (Islamic Republic of)'],
            ['code' => 'iq', 'name' => 'Iraq'],
            ['code' => 'ie', 'name' => 'Ireland'],
            ['code' => 'il', 'name' => 'Israel'],
            ['code' => 'it', 'name' => 'Italy'],
            ['code' => 'jm', 'name' => 'Jamaica'],
            ['code' => 'jp', 'name' => 'Japan'],
            ['code' => 'jo', 'name' => 'Jordan'],
            ['code' => 'kz', 'name' => 'Kazakhstan'],
            ['code' => 'ke', 'name' => 'Kenya'],
            ['code' => 'ki', 'name' => 'Kiribati'],
            ['code' => 'kp', 'name' => 'Korea (Democratic People\'s Republic of)'],
            ['code' => 'kr', 'name' => 'Korea, Republic of'],
            ['code' => 'kw', 'name' => 'Kuwait'],
            ['code' => 'kg', 'name' => 'Kyrgyzstan'],
            ['code' => 'la', 'name' => 'Lao People\'s Democratic Republic'],
            ['code' => 'lv', 'name' => 'Latvia'],
            ['code' => 'lb', 'name' => 'Lebanon'],
            ['code' => 'ls', 'name' => 'Lesotho'],
            ['code' => 'lr', 'name' => 'Liberia'],
            ['code' => 'ly', 'name' => 'Libya'],
            ['code' => 'li', 'name' => 'Liechtenstein'],
            ['code' => 'lt', 'name' => 'Lithuania'],
            ['code' => 'lu', 'name' => 'Luxembourg'],
            ['code' => 'mg', 'name' => 'Madagascar'],
            ['code' => 'mw', 'name' => 'Malawi'],
            ['code' => 'my', 'name' => 'Malaysia'],
            ['code' => 'mv', 'name' => 'Maldives'],
            ['code' => 'ml', 'name' => 'Mali'],
            ['code' => 'mt', 'name' => 'Malta'],
            ['code' => 'mh', 'name' => 'Marshall Islands'],
            ['code' => 'mr', 'name' => 'Mauritania'],
            ['code' => 'mu', 'name' => 'Mauritius'],
            ['code' => 'mx', 'name' => 'Mexico'],
            ['code' => 'fm', 'name' => 'Micronesia (Federated States of)'],
            ['code' => 'md', 'name' => 'Moldova, Republic of'],
            ['code' => 'mc', 'name' => 'Monaco'],
            ['code' => 'mn', 'name' => 'Mongolia'],
            ['code' => 'me', 'name' => 'Montenegro'],
            ['code' => 'ma', 'name' => 'Morocco'],
            ['code' => 'mz', 'name' => 'Mozambique'],
            ['code' => 'mm', 'name' => 'Myanmar'],
            ['code' => 'na', 'name' => 'Namibia'],
            ['code' => 'nr', 'name' => 'Nauru'],
            ['code' => 'np', 'name' => 'Nepal'],
            ['code' => 'nl', 'name' => 'Netherlands'],
            ['code' => 'nz', 'name' => 'New Zealand'],
            ['code' => 'ni', 'name' => 'Nicaragua'],
            ['code' => 'ne', 'name' => 'Niger'],
            ['code' => 'ng', 'name' => 'Nigeria'],
            ['code' => 'mk', 'name' => 'North Macedonia'],
            ['code' => 'no', 'name' => 'Norway'],
            ['code' => 'om', 'name' => 'Oman'],
            ['code' => 'pk', 'name' => 'Pakistan'],
            ['code' => 'pw', 'name' => 'Palau'],
            ['code' => 'pa', 'name' => 'Panama'],
            ['code' => 'pg', 'name' => 'Papua New Guinea'],
            ['code' => 'py', 'name' => 'Paraguay'],
            ['code' => 'pe', 'name' => 'Peru'],
            ['code' => 'ph', 'name' => 'Philippines'],
            ['code' => 'pl', 'name' => 'Poland'],
            ['code' => 'pt', 'name' => 'Portugal'],
            ['code' => 'qa', 'name' => 'Qatar'],
            ['code' => 'ro', 'name' => 'Romania'],
            ['code' => 'ru', 'name' => 'Russian Federation'],
            ['code' => 'rw', 'name' => 'Rwanda'],
            ['code' => 'kn', 'name' => 'Saint Kitts and Nevis'],
            ['code' => 'lc', 'name' => 'Saint Lucia'],
            ['code' => 'vc', 'name' => 'Saint Vincent and the Grenadines'],
            ['code' => 'ws', 'name' => 'Samoa'],
            ['code' => 'sm', 'name' => 'San Marino'],
            ['code' => 'st', 'name' => 'Sao Tome and Principe'],
            ['code' => 'sa', 'name' => 'Saudi Arabia'],
            ['code' => 'sn', 'name' => 'Senegal'],
            ['code' => 'rs', 'name' => 'Serbia'],
            ['code' => 'sc', 'name' => 'Seychelles'],
            ['code' => 'sl', 'name' => 'Sierra Leone'],
            ['code' => 'sg', 'name' => 'Singapore'],
            ['code' => 'sk', 'name' => 'Slovakia'],
            ['code' => 'si', 'name' => 'Slovenia'],
            ['code' => 'sb', 'name' => 'Solomon Islands'],
            ['code' => 'so', 'name' => 'Somalia'],
            ['code' => 'za', 'name' => 'South Africa'],
            ['code' => 'ss', 'name' => 'South Sudan'],
            ['code' => 'es', 'name' => 'Spain'],
            ['code' => 'lk', 'name' => 'Sri Lanka'],
            ['code' => 'sd', 'name' => 'Sudan'],
            ['code' => 'sr', 'name' => 'Suriname'],
            ['code' => 'se', 'name' => 'Sweden'],
            ['code' => 'ch', 'name' => 'Switzerland'],
            ['code' => 'sy', 'name' => 'Syrian Arab Republic'],
            ['code' => 'tj', 'name' => 'Tajikistan'],
            ['code' => 'tz', 'name' => 'Tanzania, United Republic of'],
            ['code' => 'th', 'name' => 'Thailand'],
            ['code' => 'tl', 'name' => 'Timor-Leste'],
            ['code' => 'tg', 'name' => 'Togo'],
            ['code' => 'to', 'name' => 'Tonga'],
            ['code' => 'tt', 'name' => 'Trinidad and Tobago'],
            ['code' => 'tn', 'name' => 'Tunisia'],
            ['code' => 'tr', 'name' => 'Türkiye'],
            ['code' => 'tm', 'name' => 'Turkmenistan'],
            ['code' => 'tv', 'name' => 'Tuvalu'],
            ['code' => 'ug', 'name' => 'Uganda'],
            ['code' => 'ua', 'name' => 'Ukraine'],
            ['code' => 'ae', 'name' => 'United Arab Emirates'],
            [
                'code' => 'gb',
                'name' => 'United Kingdom of Great Britain and Northern Ireland',
            ],
            ['code' => 'us', 'name' => 'United States of America'],
            ['code' => 'uy', 'name' => 'Uruguay'],
            ['code' => 'uz', 'name' => 'Uzbekistan'],
            ['code' => 'vu', 'name' => 'Vanuatu'],
            ['code' => 've', 'name' => 'Venezuela (Bolivarian Republic of)'],
            ['code' => 'vn', 'name' => 'Viet Nam'],
            ['code' => 'ye', 'name' => 'Yemen'],
            ['code' => 'zm', 'name' => 'Zambia'],
            ['code' => 'zw', 'name' => 'Zimbabwe'],
        ];

        // Create an associative array for efficient lookup of country codes by name.
        $countryCodes = collect($countries)->pluck('code', 'name')->toArray();
    @endphp

    <div class="countryscroll" id="simplerscroll">
        <table class="table countrytable">
            <tbody>
                @foreach ($countryStats as $stat)
                    @php
                        $customerCountryName = $stat['country'];
                        $customerCountryCode = $countryCodes[$customerCountryName] ?? '';
                    @endphp
                    <tr>
                        <td class="w-1 text-center">
                            @if ($customerCountryCode)
                                <i class="flag flag-{{ strtolower($customerCountryCode) }}"></i>
                            @else
                                {{-- Fallback icon if no flag is found for the country --}}
                                <i class="fas fa-globe text-muted"></i>
                            @endif
                        </td>
                        <td>{{ $customerCountryName }}</td>
                        <td class="text-right">
                            <span class="font-weight-bold">
                                UGX {{ number_format(data_get($stat, 'total_revenue', 0)) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-12 col-lg-6">
            <div class="row">

                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Today Revenue</p>
                                    <h2 class="mb-0 font-weight-bold">
                                        UGX {{ number_format($todayRevenue ?? 0) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-success"></i>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Total Customers</p>
                                    <h2 class="mb-0 font-weight-bold">
                                        {{ number_format($totalCustomers ?? 0) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-boxes fa-2x text-danger"></i>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Products Sold Today</p>
                                    <h2 class="mb-0 font-weight-bold">
                                        {{ number_format($productsSoldToday ?? 0) }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </div>

    <!--Row-->
    <div class="row row-deck">
        <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title">Top Products</h3>
                </div>
                <div class="card-body">
                    <div class="h-400 scrollbar3" id="scrollbar3"
                        style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                        <div class="table-responsive">
                            <table class="table transaction-table mb-0">
                                <tbody>
                                    @forelse($products as $product)
                                        <tr class="product-row"
                                            style="transition: background-color 0.3s ease; cursor: pointer;">
                                            <td style="padding: 8px 12px;">
                                                <div class="d-flex align-items-center">
                                                    <img class="w-8 h-8 rounded shadow mr-3"
                                                        src="{{ asset('storage/' . $product->featured_image_1) }}"
                                                        alt="{{ $product->product_name }}"
                                                        style="width: 50px; height: 50px; object-fit: cover;">

                                                    <div class="product-info"
                                                        style="display: flex; flex-direction: column;">
                                                        <h6 class="mb-1 font-weight-semibold text-dark"
                                                            style="font-size: 1rem;">
                                                            {{ $product->product_name }}
                                                        </h6>
                                                        <small class="text-muted">
                                                            Ugx {{ number_format($product->sale_price) }}/=
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="1"
                                                style="text-align: center; padding: 15px; color: #888; font-style: italic;">
                                                No products found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Customers</h3>
                </div>
                <div class="card-body overflow-hidden">

                    <div class="h-400 scrollbar3" id="scrollbar3"
                        style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                        <div class="table-responsive">
                            <table class="table transaction-table mb-0">
                                <tbody>
                                    @forelse($recentCustomers as $customer)
                                        <tr class="customer-row"
                                            style="transition: background-color 0.3s ease; cursor: pointer;">
                                            <td style="padding: 8px 12px;">
                                                <div class="customer-info"
                                                    style="display: flex; flex-direction: column; gap: 4px;">
                                                    <h6 class="customer-name"
                                                        style="margin: 0; font-weight: 600; font-size: 1rem; color: #333;">
                                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                                    </h6>
                                                    <small class="customer-country"
                                                        style="color: #6c757d; font-size: 0.875rem;">
                                                        {{ $customer->country ?? 'No Country' }}
                                                    </small>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="1"
                                                style="text-align: center; padding: 15px; color: #888; font-style: italic;">
                                                No recent customers found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Transactions</h3>
                </div>
                <div class="card-body overflow-hidden">
                    <div class="h-400 scrollbar3" id="scrollbar3"
                        style="height: 400px; overflow-y: auto; overflow-x: hidden;">
                        <div class="table-responsive">
                            <table class="table transaction-table mb-0">
                                <tbody>
                                    @forelse ($recentTransactions as $transaction)
                                        <tr class="transaction-row"
                                            style="transition: background-color 0.3s ease; cursor: pointer;">
                                            <td style="padding: 10px 14px;">
                                                <div class="transaction-info"
                                                    style="display: flex; flex-direction: column; gap: 4px;">
                                                    <h6 class="transaction-name"
                                                        style="margin: 0; font-weight: 600; font-size: 1rem; color: #333;">
                                                        {{ $transaction->user->first_name ?? 'Guest' }}
                                                        {{ $transaction->user->last_name ?? '' }}
                                                    </h6>
                                                    <small class="transaction-status"
                                                        style="color: #6c757d; font-size: 0.875rem;">
                                                        UGX {{ number_format($transaction->total_amount) }} -
                                                        {{ ucfirst($transaction->status) }}
                                                    </small>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="1"
                                                style="text-align: center; padding: 15px; color: #888; font-style: italic;">
                                                No recent transactions found.
                                            </td>
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
    <!--End row-->

    </div>
    </div><!-- end app-content-->
    </div>
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
