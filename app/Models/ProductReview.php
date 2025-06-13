<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'review_message',
        'review_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
