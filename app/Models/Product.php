<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'name'
        , 'description'
        , 'price'
        , 'isAvailable'
        , 'has_customization'
        , 'image'
        , 'category_number'
    ];

    // Define relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_number', 'category_number'); // Specify both foreign and local keys
    }
}
