<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
            $imagePath = $image->storeAs('public/featured_images', $imageName);
            $imagePath = Storage::url($imagePath);
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

        return view('Products.edit-product', compact('product', 'categories', 'labels', 'taxes'));

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

        return response()->json([
            'message'    => 'Product saved successfully.',
            'product_id' => $product->id,
        ]);
    }

    public function deleteProduct(Product $product)
    {
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
            'attributes'       => 'nullable|array', // Laravel expects array here
            'labels'           => 'nullable|array',
            'taxes'            => 'nullable|array',
            'featured_image_1' => 'nullable|image|max:2048',
            'featured_image_2' => 'nullable|image|max:2048',
            'featured_image_3' => 'nullable|image|max:2048',
        ]);

        // Update simple fields
        $product->product_name = $request->product_name;
        $product->category     = $request->category;
        $product->status       = $request->status;
        $product->description  = $request->description;
        $product->price        = $request->price;
        $product->sale_price   = $request->sale_price;
        $product->quantity     = $request->quantity;
        $product->sku          = $request->sku;

        // Since your model casts these fields to arrays,
        // just assign the array or null (no need to JSON encode)
        $product->attributes = $request->input('attributes', null);
        $product->labels     = $request->input('labels', []);
        $product->taxes      = $request->input('taxes', []);

        // Handle image uploads
        for ($i = 1; $i <= 3; $i++) {
            $fileKey = "featured_image_{$i}";
            if ($request->hasFile($fileKey)) {
                // Delete old image if exists
                if ($product->$fileKey) {
                    Storage::disk('public')->delete($product->$fileKey);
                }

                // Store new image
                $path              = $request->file($fileKey)->store('products', 'public');
                $product->$fileKey = $path;
            }
        }

        $product->save();

        return response()->json(['message' => 'Product updated successfully']);
    }

}
