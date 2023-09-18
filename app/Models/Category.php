<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function subCategories()
    {
        return $this->hasMany(subCategory::class);
    }

    public function get_categories_with_is_checked()
    {
        $categories = Category::all();
        for($i=0; $i<count($categories); $i++)
        {
            $categories[$i]["is_checked"] = true;
        }

        return $categories;
    }
}
