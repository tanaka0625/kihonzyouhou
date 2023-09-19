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

        $categories = Category::all();
        $sub_categories = SubCategory::all();

        $data = [
            'words' => $words,
            'count' => count($words),
            'categories' => $categories,
            'sub_categories' => $sub_categories
        ];

        return view('quiz.index', $data);
    }
}
