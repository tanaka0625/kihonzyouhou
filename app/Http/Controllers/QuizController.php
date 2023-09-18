<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Category;
use App\Models\SubCategory;

class QuizController extends Controller
{
    public function index(Request $request) {
        $words = Word::all();

        $categories = Category::get_categories_with_is_checked();
        $sub_categories = SubCategory::get_sub_categories_with_is_checked();


        $data = [
            'words' => $words,
            'count' => count($words),
            'categories' => $categories,
            'sub_categories' => $sub_categories
        ];

        return view('quiz.index', $data);
    }
}
