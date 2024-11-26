<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $primaryKey = 'category_id'; // Define the primary key
    protected $fillable = [
        'category_name'
        , 'image'
    ]; // Fillable fields

    // Define relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
