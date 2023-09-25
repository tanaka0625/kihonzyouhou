<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\SubCategory;
use App\Models\Category;

class EditController extends Controller
{
    public function index(Request $request){
        $word = Word::find($request->word_id);


        $data = [
            'word' => $word
        ];

        return view('edit.index', $data);
    }

    public function edit(Request $request) {

        // 単語更更新 機能が更新されてもされなくてもアップデートする
        $new_word = Word::find($request->word_id);
        $new_word->word = $request->word;
        $new_word->text = $request->text;
        $new_word->category_id = $request->category_id;
        $new_word->sub_category_id = $request->sub_category_id;

        $new_word->save();

        return redirect('/');
    }
}
