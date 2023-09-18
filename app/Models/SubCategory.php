<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function get_sub_categories_with_is_checked()
    {
        $sub_categories = SubCategory::get();
        for($i=0; $i<count($sub_categories); $i++)
        {
            $sub_categories[$i]["is_checked"] = true;
        }

        return $sub_categories;
    }
}
