<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\SubCategory;
use App\Models\Category;


class PostSubCategoryController extends Controller
{
    public function index(Request $request) {
        $new_sub_category = new SubCategory;
        $new_sub_category->sub_category = $request->sub_category;
        $new_sub_category->category_id = $request->category_id;
        $new_sub_category->save();

        return redirect('/');
    }
}
