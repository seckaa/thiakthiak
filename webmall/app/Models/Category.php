<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Category as ModelsCategory;

class Category extends ModelsCategory
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }

    public function allProducts()
    {
        // dd($this->children);

        $allProducts = collect([]);

        // dd($this->products);

        $mainCategoryProducts = $this->products;

        $allProducts = $allProducts->concat($mainCategoryProducts);

        if ($this->children->isNotEmpty()) {

            foreach ($this->children as $child) {
                // dd($this->children);
                // dd($child->products);
                $allProducts = $allProducts->concat($child->products);
            }
        }

        // dd($allProducts);
        return $allProducts;
    }
}
