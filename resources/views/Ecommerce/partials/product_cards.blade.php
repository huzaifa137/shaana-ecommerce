<?php
use App\Http\Controllers\Helper;
?>

@foreach ($products as $product)
 @php
        $cart = session('cart', []);
        $isInCart = array_key_exists($product->id, $cart);
        $cartQty = $isInCart ? $cart[$product->id]['quantity'] ?? 1 : 1;
        $reviewCounts = DB::table('product_reviews')->where('product_id', $product->id)->count();
        $displayReviewCount = $reviewCounts == 0 ? rand(1, 4) : $reviewCounts;
        $discount = 0;
        if ($product->price > 0 && $product->sale_price < $product->price) {
            $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
        }
    @endphp

    <div class="col">
        <div class="product-item bg-white p-3 rounded-2 shadow-sm h-100 d-flex flex-column position-relative"
            style="box-sizing: border-box;">
            <a href="{{ url('/product-item/' . $product->id) }}" class="stretched-link" style="z-index: 1;"></a>

            <figure class="mb-3 text-center">
                <a href="{{ url('/product-item/' . $product->id) }}" title="{{ $product->product_name }}">
                    <img src="{{ asset('storage/' . $product->featured_image_1) }}" alt="Product Thumbnail"
                        style="max-width: 100%; height: auto;">
                </a>
            </figure>
            <div class="flex-grow-1 d-flex flex-column text-center">
                <h3 class="fs-6 fw-normal">{{ $product->product_name }}</h3>
                <div class="mb-2">
                    <span class="rating">
                        @for ($i = 0; $i < 5; $i++)
                            <svg width="18" height="18" class="text-warning">
                                <use xlink:href="#star-full"></use>
                            </svg>
                        @endfor
                    </span>
                    <span>({{ $displayReviewCount }})</span>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                    <del>Ugx{{ Helper::abbreviate_number($product->price) }}</del>
                    <span class="text-dark fw-semibold">Ugx{{ Helper::abbreviate_number($product->sale_price) }}</span>
                    @if ($discount > 0)
                        <span class="badge border border-dark-subtle rounded-0 fw-normal px-1 fs-7 lh-1 text-body-tertiary">
                            {{ $discount }}% OFF
                        </span>
                    @endif
                </div>

                <div class="mt-auto pt-3" style="border-top: 1px solid #eee; margin-top: 1rem;">
                    <div class="row g-2 align-items-center">
                        <div class="col-3">
                            @if ($isInCart)
                                <input type="number" name="quantity"
                                    class="form-control border-dark-subtle input-number quantity" value="{{ $cartQty }}" min="1"
                                    max="9" readonly style="min-width: 100%; height: 40px; text-align: center;">
                            @else
                                <form method="POST" action="{{ route('shop.add.cart', $product->id) }}">
                                    @csrf
                                    <input type="number" name="quantity"
                                        class="form-control border-dark-subtle input-number quantity" value="{{ $cartQty }}"
                                        min="1" max="9" style="min-width: 100%; height: 40px; text-align: center;">
                            @endif
                        </div>

                        <div class="col-7">
                            @if ($isInCart)
                                <a href="javascript:void(0);"
                                    class="btn btn-outline-success rounded-1 p-2 fs-7 w-100 d-flex align-items-center justify-content-center gap-1"
                                    style="height: 40px;" disabled>
                                    <svg width="18" height="18">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    In Cart
                                </a>
                            @else
                                <button type="submit"
                                    class="btn btn-primary rounded-1 p-2 fs-7 w-100 d-flex align-items-center justify-content-center gap-1"
                                    style="height: 40px;">
                                    <svg width="18" height="18">
                                        <use xlink:href="#cart"></use>
                                    </svg>
                                    Add to Cart
                                </button>
                                </form>
                            @endif
                        </div>

                        <div class="col-2">
                            <a href="javascript:void(0);"
                                class="btn btn-outline-dark rounded-1 p-2 fs-6 w-100 d-flex align-items-center justify-content-center"
                                style="height: 40px;">
                                <svg width="18" height="18">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach