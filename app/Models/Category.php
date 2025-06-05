<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'status', 'description', 'featured_image'
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
