<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class ListController extends Controller
{
    public function index(Request $request) {

        // 単語を全て取得
        $words = Word::all();

        $data = [
            'words' => $words,
            'count' => count($words)
        ];
    
        

        return view('list.index', $data);
    }

    public function post(Request $request) {

        $new_word = new Word;
        $new_word->word = $request->word;
        $new_word->text = $request->text;
        $new_word->category = $request->category;
        $new_word->sub_category = $request->sub_category;
        $new_word->save();

        return redirect('/list');
    }


}
