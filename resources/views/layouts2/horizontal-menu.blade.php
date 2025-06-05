<!-- Horizontal-menu -->
<div class="horizontal-main hor-menu clearfix">
    <div class="horizontal-mainwrapper container clearfix">
        <nav class="horizontalMenu clearfix">
            <ul class="horizontalMenu-list">
                <li aria-haspopup="true">
                    <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="26"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Dashboard <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard 01</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard 02</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard 03</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard 04</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard 05</a></li>
                    </ul>
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
                        <li aria-haspopup="true"><a href="{{ route('all.products') }}">All Products</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Product Prices</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Product Inventory</a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ route('product.categories') }}">Product Categories</a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Tags</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Attributes</a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Options</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Collections</a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Labels</a>
                        </li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Product Reviews</a>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        Widgets <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard 01</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard 02</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard 03</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard 04</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard 05</a></li>
                    </ul>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="hor-icon">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                        Forms <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard 01</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard 02</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard 03</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard 04</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard 05</a></li>
                    </ul>
                </li>
                <li aria-haspopup="true"><a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="hor-icon">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        Advanced UI <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true" class="sub-menu-sub"><a
                                href="{{ url('/' . ($page = '#')) }}">Charts</a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard
                                        01</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard
                                        02</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard
                                        03</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard
                                        04</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard
                                        05</a></li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="sub-menu-sub"><a
                                href="{{ url('/' . ($page = '#')) }}">Maps</a>
                            <ul class="sub-menu">
                                <li><a href="{{ url('/' . ($page = 'maps')) }}" class="slide-item">Vector Maps</a>
                                </li>
                                <li><a href="{{ url('/' . ($page = 'maps2')) }}" class="slide-item">Leaflet Maps</a>
                                </li>
                                <li><a href="{{ url('/' . ($page = 'maps3')) }}" class="slide-item">Mapel Maps</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="sub-menu-sub"><a
                                href="{{ url('/' . ($page = '#')) }}">Tables</a>
                            <ul class="sub-menu">
                                <li><a href="{{ url('/' . ($page = 'tables')) }}" class="slide-item">Default
                                        table</a>
                                </li>
                                <li><a href="{{ url('/' . ($page = 'datatable')) }}" class="slide-item">Data
                                        Table</a>
                                </li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="sub-menu-sub"><a
                                href="{{ url('/' . ($page = '#')) }}">Invoice</a>
                            <ul class="sub-menu">
                                <li><a href="{{ url('/' . ($page = 'invoice-list')) }}">Invoice list</a></li>
                                <li><a href="{{ url('/' . ($page = 'invoice-1')) }}">Invoice 01</a></li>
                                <li><a href="{{ url('/' . ($page = 'invoice-2')) }}">Invoice 02</a></li>
                                <li><a href="{{ url('/' . ($page = 'invoice-3')) }}">Invoice 03</a></li>
                                <li><a href="{{ url('/' . ($page = 'invoice-add')) }}">Add Invoice</a></li>
                                <li><a href="{{ url('/' . ($page = 'invoice-edit')) }}">Edit Invoice</a></li>
                            </ul>
                        </li>
                        <li aria-haspopup="true" class="sub-menu-sub"><a
                                href="{{ url('/' . ($page = '#')) }}">Shop</a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard
                                        01</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard
                                        02</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard
                                        03</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard
                                        04</a></li>
                                <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard
                                        05</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li aria-haspopup="true">
                    <a href="{{ url('/' . ($page = '#')) }}" class="sub-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="hor-icon">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        Elements <i class="fa fa-angle-down horizontal-icon"></i>
                    </a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard 01</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard 02</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard 03</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard 04</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard 05</a></li>
                    </ul>
                </li>
                <li aria-haspopup="true"><a href="{{ url('/' . ($page = '#')) }}" class="sub-icon ">
                        <svg class="hor-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                        Pages <i class="fa fa-angle-down horizontal-icon"></i></a>
                    <ul class="sub-menu">
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index')) }}">Dashboard 01</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index2')) }}">Dashboard 02</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index3')) }}">Dashboard 03</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index4')) }}">Dashboard 04</a></li>
                        <li aria-haspopup="true"><a href="{{ url('/' . ($page = 'index5')) }}">Dashboard 05</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--Nav end -->
    </div>
</div>
<!-- Horizontal-menu end -->
