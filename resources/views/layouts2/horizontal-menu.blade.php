<!-- Horizontal-menu -->
<div class="horizontal-main hor-menu clearfix">
    <div class="horizontal-mainwrapper container clearfix">
        <nav class="horizontalMenu clearfix">
            <ul class="horizontalMenu-list">
                <li aria-haspopup="true">
                    <a href="{{ route('admin.dashboard') }}" class="sub-icon">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        Products <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ route('add.category') }}">Add Category</a></li>
                        <li aria-haspopup="true"><a href="{{ route('add.product') }}">Add Product</a></li>
                        <li aria-haspopup="true"><a href="{{ route('all.products') }}">Products</a></li>
                        <li aria-haspopup="true"><a href="{{ route('product.categories') }}">Product Categories</a></li>
                    </ul>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('admin.orders') }}" class="sub-icon">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        Orders
                    </a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('all.customers') }}" class="sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="hor-icon">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Customers
                    </a>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ route('customer.contactus.messages') }}"
                        class="sub-icon position-relative d-inline-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="hor-icon">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        Contact Us

                        @php
                            use App\Models\Contact;
                            $pendingMessageCount = Contact::where('status', 'pending')->count();
                        @endphp

                        @if (!empty($pendingMessageCount) && $pendingMessageCount > 0)
                            <span
                                class="badge badge-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="font-size: 0.6rem; width: 1.2rem; height: 1.2rem; padding: 0; margin-left: 0.3rem;">
                                {{ $pendingMessageCount }}
                                <span class="sr-only">unread messages</span>
                            </span>
                        @endif
                    </a>
                </li>
            </ul>
        </nav>

        <!--Nav end -->
    </div>
</div>
<!-- Horizontal-menu end -->
