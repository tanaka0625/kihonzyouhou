<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class QuizController extends Controller
{
    public function index(Request $request) {
        $words = Word::all();

        

        $data = [
            'words' => $words,
            'count' => count($words)
        ];

        return view('quiz.index', $data);
    }
}
