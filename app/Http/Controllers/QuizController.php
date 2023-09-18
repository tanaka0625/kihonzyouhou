<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class QuizController extends Controller
{
    public function index(Request $request) {
        $words = Word::all();

        $categories = Word::get_categories();
        $sub_categories = Word::get_sub_categories();



        $data = [
            'words' => $words,
            'count' => count($words),
            'categories' => $categories,
            'sub_categories' => $sub_categories
        ];

        return view('quiz.index', $data);
    }
}
