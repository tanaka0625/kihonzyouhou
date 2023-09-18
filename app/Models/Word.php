<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }    

    public function get_categories() {
        $categories = Word::groupBy('category')->get(['category']);
        for($i=0; $i<count($categories); $i++)
        {
            $categories[$i]["is_checked"] = true;
        }

        return $categories;
    }

    public function get_sub_categories() {
        $sub_categories = Word::groupBy('sub_category')->get(['sub_category']);
        for($i=0; $i<count($sub_categories); $i++)
        {
            $sub_categories[$i]["is_checked"] = true;
        }

        return $sub_categories;
    }

}
