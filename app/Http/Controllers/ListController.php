<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Category;
use App\Models\SubCategory;

class ListController extends Controller
{
    public function index(Request $request) {

        // 単語を全て取得
        $words = Word::all();
        $categories = Category::all();
        $sub_categories = SubCategory::all();

        $data = [
            'words' => $words,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'count' => count($words)
        ];
    
        

        return view('list.index', $data);
    }

    public function post(Request $request) {

        $new_word = new Word;
        $new_word->word = $request->word;
        $new_word->text = $request->text;
        $new_word->category_id = $request->category_id;
        $new_word->sub_category_id = $request->sub_category_id;
        $new_word->save();

        return redirect('/');
    }


}
