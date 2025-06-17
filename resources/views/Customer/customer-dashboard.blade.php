@include('layouts.header')

<!-- Hero Start -->
<div class="container-fluid py-5 mb-5 hero-header">
    <div class="container py-5">

    </div>
</div>
<!-- Hero End -->

<?php
use App\Http\Controllers\Helper;
?>

<!-- Featurs Section Start -->
<div class="container-fluid featurs">

    <div class="container">
        <h1 class="mb-3" id="dashboard-heading"> </h1><br>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('customer.orders') }}">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-car-side fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>My Orders</h5>
                            <p class="mb-0">Track all your orders</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('item.shop') }}">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-shopping-bag fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Shop</h5>
                            <p class="mb-0">Browse all available items</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('item.cart') }}">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-shopping-cart fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>My Cart</h5>
                            <p class="mb-0">View items in your cart</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('contact.us') }}">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Featurs Section End -->


<!-- Vesitable Shop Start-->
<div class="container-fluid vesitable">
    <div class="container py-5">
        <h1 class="mb-0">Your recent ordered Items</h1>
        <div class="owl-carousel vegetable-carousel justify-content-center">

            @foreach ($orders as $order)
                @foreach ($order->items as $item)
                    @php
                        $product = $item->product;
                        $productInformation = DB::table('products')->where('id', $item->product_id)->first();
                    @endphp

                    <div class="border border-primary rounded position-relative vesitable-item mb-4">
                        <a href="{{ url('/product-item/' . $product->id) }}" class="stretched-link"></a>
                        <div class="vesitable-img">
                            <img src="{{ asset('storage/' . $product->featured_image_1) }}"
                                class="img-fluid w-100 rounded-top" alt="Product Thumbnail"
                                alt="{{ $productInformation->product_name ?? 'Product' }}">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">
                            {{ Helper::product_category_name($product->category) ?? 'Category' }}
                        </div>
                        <div class="p-4 rounded-bottom">
                            <h4>{{ $productInformation->product_name ?? 'Product Name' }}</h4>

                            @php
                                $plainText = strip_tags($productInformation->description);
                                $wordLimit = 15;
                                $shortDescription = Str::words($plainText, $wordLimit, '...');
                            @endphp

                            <p class="text-muted">{{ $shortDescription }}</p>

                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">
                                    {{ number_format($productInformation->sale_price) }} UGX x
                                    {{ $productInformation->quantity }}
                                </p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Ordered
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

        </div>
    </div>
</div>
<!-- Vesitable Shop End -->

<!-- Bestsaler Product Start -->
<div class="container-fluid">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 700px;">
            <h1 class="display-4">Best seller Products</h1>
            <p>Explore our most popular products, trusted by thousands of customers for their exceptional quality,
                performance, and value.</p>
        </div>
        @php
            $cart = session('cart', []);
        @endphp

        <div class="row g-4">
            @foreach ($BestSellingProducts as $product)
                @php
                    $isInCart = array_key_exists($product->id, $cart);
                @endphp

                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light h-100">
                        <div class="row align-items-center">
                            {{-- Product Image --}}
                            <div class="col-6">
                                <img src="{{ asset('storage/' . $product->featured_image_1) }}"
                                    class="img-fluid rounded-circle w-100" alt="{{ $product->product_name }}">
                            </div>

                            {{-- Product Details --}}
                            <div class="col-6">
                                {{-- Product Name --}}
                                <a href="{{ url('/product-item/' . $product->id) }}"
                                    class="h5 d-block">{{ $product->product_name }}</a>

                                {{-- Star Ratings (Placeholder) --}}
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>

                                {{-- Price --}}
                                <h4 class="mb-3">UGX {{ number_format($product->sale_price) }}/=</h4>

                                {{-- Cart Button --}}
                                @if ($isInCart)
                                    <button type="button"
                                        class="btn border border-success rounded-pill px-3 text-success" disabled>
                                        <i class="fa fa-check me-2 text-success"></i> In Cart
                                    </button>
                                @else
                                    <form method="POST" action="{{ route('shop.add.cart', $product->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn border border-primary rounded-pill px-3 text-primary">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Bestsaler Product End -->

<script>
    const customerName = "{{ Helper::customer_name(Session('LoggedCustomer')) }}";

    if (sessionStorage.getItem('showWelcome') === 'true') {
        document.getElementById('dashboard-heading').innerText = `Hi ${customerName}! Welcome to your dashboard.`;
        sessionStorage.setItem('dashboardVisited', 'true');
        sessionStorage.removeItem('showWelcome');
    } else {
        document.getElementById('dashboard-heading').innerText = 'Dashboard Information';
    }
</script>

@include('layouts.footer')
