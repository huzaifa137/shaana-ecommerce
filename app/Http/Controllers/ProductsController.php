<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function productCategories()
    {
        $categories = Category::all();

        return view('Products.all-categories', compact(['categories']));
    }

    public function addCategory()
    {
        $categories = Category::all();

        return view('Products.create-category', compact(['categories']));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'parent'         => 'required',
            'status'         => 'required|in:10,0,1',
            'description'    => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imagePath = null;

        if ($request->hasFile('featured_image')) {
            $image     = $request->file('featured_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            // Store image in storage/app/public/featured_images and get relative path
            $imagePath = $image->storeAs('featured_images', $imageName, 'public');
        }

        $category = Category::create([
            'name'           => $validated['name'],
            'parent_id'      => $validated['parent'] ?: null,
            'status'         => $validated['status'],
            'description'    => $validated['description'],
            'featured_image' => $imagePath,
        ]);

        return response()->json([
            'message'  => 'Category created successfully!',
            'category' => $category,
        ]);
    }

    public function editCategory($id)
    {
        $category   = Category::findOrFail($id);
        $categories = Category::all();

        return view('Products.edit-category', compact('category', 'categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'parent'         => 'nullable|integer',
            'status'         => 'required|in:10,0,1',
            'description'    => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('featured_image')) {
            $image                    = $request->file('featured_image');
            $imageName                = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath                = $image->storeAs('featured_images', $imageName, 'public');
            $category->featured_image = $imagePath;
        }

        $category->name        = $validated['name'];
        $category->parent_id   = $validated['parent'] ?: null;
        $category->status      = $validated['status'];
        $category->description = $validated['description'] ?? null;

        $category->save();

        return response()->json([
            'message'  => 'Category updated successfully!',
            'category' => $category,
        ]);
    }

    public function deleteCategory(Category $category)
    {
        try {

            if ($category->featured_image_1) {
                Storage::delete($category->featured_image_1);
            }

            $category->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Delete failed'], 500);
        }
    }

    public function allProducts()
    {
        $products = Product::latest()->get();
        return view('Products.all-products', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::all();

        return view('Products.add-product', compact(['categories']));
    }

    public function editProduct($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();

        $labels = $product->labels ?? [];
        $taxes  = $product->taxes ?? [];

        $reviews = ProductReview::where('product_id', $product->id)->get();

        return view('Products.edit-product', compact('product', 'categories', 'labels', 'taxes', 'reviews'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'product_name'     => 'required|string',
            'category'         => 'nullable|integer',
            'status'           => 'required|integer',
            'description'      => 'nullable|string',
            'price'            => 'required|string',
            'sale_price'       => 'required|string',
            'quantity'         => 'required|integer',
            'sku'              => 'nullable|string',
            'attributes'       => 'nullable|string',
            'labels'           => 'nullable|string',
            'taxes'            => 'nullable|string',
            'featured_image_1' => 'nullable|image',
            'featured_image_2' => 'nullable|image',
            'featured_image_3' => 'nullable|image',
            'reviews'          => 'nullable|string', // reviews come as JSON string
        ]);

        $product = new Product($validated);

        $product->attributes = json_decode($request->input('attributes'), true);
        $product->labels     = json_decode($request->input('labels'), true);
        $product->taxes      = json_decode($request->input('taxes'), true);

        foreach ([1, 2, 3] as $index) {
            $key = "featured_image_{$index}";
            if ($request->hasFile($key)) {
                $path          = $request->file($key)->store("products", "public");
                $product->$key = $path;
            }
        }

        $product->save();

        // ✅ Save reviews
        $reviews = json_decode($request->input('reviews'), true);
        if (is_array($reviews)) {
            foreach ($reviews as $review) {
                ProductReview::create([
                    'product_id'     => $product->id,
                    'reviewer_name'  => $review['name'],
                    'reviewer_email' => $review['email'] ?? null,
                    'rating'         => $review['rating'] ?? null,
                    'review_message' => $review['message'],
                    'review_date'    => $review['date'] ?? null,
                ]);
            }
        }

        return response()->json([
            'message'    => 'Product saved successfully.',
            'product_id' => $product->id,
        ]);
    }

    public function deleteProduct(Product $product)
    {
        // Check if the product exists
        try {

            if ($product->featured_image_1) {
                Storage::delete($product->featured_image_1);
            }

            $product->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Delete failed'], 500);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name'     => 'required|string|max:255',
            'category'         => 'required|integer',
            'status'           => 'required|integer',
            'description'      => 'required|string',
            'price'            => 'required|numeric',
            'sale_price'       => 'required|numeric',
            'quantity'         => 'required|integer',
            'sku'              => 'required|string|max:255',
            'attributes'       => 'nullable|array',
            'labels'           => 'nullable|array',
            'taxes'            => 'nullable|array',
            'featured_image_1' => 'nullable|image|max:2048',
            'featured_image_2' => 'nullable|image|max:2048',
            'featured_image_3' => 'nullable|image|max:2048',
            'reviews'          => 'nullable|string',
            'deleted_reviews'  => 'nullable|string',
        ]);

        // Update basic product fields

        $product->product_name = $request->product_name;
        $product->category     = $request->category;
        $product->status       = $request->status;
        $product->description  = $request->description;
        $product->price        = $request->price;
        $product->sale_price   = $request->sale_price;
        $product->quantity     = $request->quantity;
        $product->sku          = $request->sku;

        $product->attributes = $request->input('attributes', null);
        $product->labels     = $request->input('labels', []);
        $product->taxes      = $request->input('taxes', []);

        // Handle images
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = "featured_image_{$i}";
            if ($request->hasFile($fileKey)) {
                if ($product->$fileKey) {
                    Storage::disk('public')->delete($product->$fileKey);
                }
                $path              = $request->file($fileKey)->store('products', 'public');
                $product->$fileKey = $path;
            }
        }

        $product->save();

        // ✅ Delete reviews if needed
        $deletedReviews = json_decode($request->input('deleted_reviews'), true);
        if (is_array($deletedReviews)) {
            ProductReview::whereIn('id', $deletedReviews)
                ->where('product_id', $product->id)
                ->delete();
        }

        // ✅ Handle reviews (create or update)
        $reviews = json_decode($request->input('reviews'), true);
        if (is_array($reviews)) {
            foreach ($reviews as $review) {
                if (! empty($review['id'])) {
                    // Update existing review
                    $existing = ProductReview::where('id', $review['id'])
                        ->where('product_id', $product->id)
                        ->first();
                    if ($existing) {
                        $existing->update([
                            'reviewer_name'  => $review['name'],
                            'reviewer_email' => $review['email'],
                            'rating'         => $review['rating'],
                            'review_message' => $review['message'],
                            'review_date'    => $review['date'],
                        ]);
                    }
                } else {
                    // Create new review
                    ProductReview::create([
                        'product_id'     => $product->id,
                        'reviewer_name'  => $review['name'],
                        'reviewer_email' => $review['email'] ?? null,
                        'rating'         => $review['rating'] ?? null,
                        'review_message' => $review['message'],
                        'review_date'    => $review['date'] ?? null,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = Session::get('cart', []);

        $cleanedPrice = (int) str_replace(',', '', $product->sale_price);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                "id"        => $product->id,
                "name"      => $product->product_name,
                "thumbnail" => $product->featured_image_1,
                "price"     => $cleanedPrice,
                "quantity"  => 1,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart.');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    public function updateQuantity(Request $request)
    {
        $productId = $request->product_id;
        $quantity  = $request->quantity;

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
        }

        session()->put('cart', $cart);

        $product   = Product::find($productId);
        $itemTotal = $product->sale_price * $quantity;

        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $p = Product::find($id);
            $subtotal += $p->sale_price * $item['quantity'];
        }

        return response()->json([
            'success'    => true,
            'item_total' => $itemTotal,
            'subtotal'   => $subtotal,
        ]);
    }

    public function getExchangeRates()
    {
        $base    = 'UGX'; 
        $symbols = 'USD,EUR,GBP';

        $response = Http::get("https://api.exchangerate.host/latest", [
            'base'    => $base,
            'symbols' => $symbols,
        ]);

        return response()->json($response->json());
    }

}
