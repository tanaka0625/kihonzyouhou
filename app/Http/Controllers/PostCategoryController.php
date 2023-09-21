<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\SubCategory;
use App\Models\Category;

class PostCategoryController extends Controller
{
    public function index(Request $request) {

        $new_category = new Category;
        $new_category->category = $request->category;
        $new_category->save();

        return redirect('/');

    }
}
