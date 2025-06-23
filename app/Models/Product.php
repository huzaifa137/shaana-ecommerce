<?php
namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'category',
        'status',
        'description',
        'price',
        'sale_price',
        'quantity',
        'sku',
        'is_combo',
        'attributes',
        'labels',
        'taxes',
        'featured_image_1',
        'featured_image_2',
        'featured_image_3',
    ];

    protected $casts = [
        'attributes' => 'array',
        'labels'     => 'array',
        'taxes'      => 'array',
        'is_combo'   => 'boolean',
    ];

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

}
