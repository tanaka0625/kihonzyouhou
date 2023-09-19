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

        $category_flag = 0;
        $sub_category_flag = 0;

        $category = Category::where('category', $request->category)->get();
        
        // 大分類が新しいものに修正された場合
        if($category->count() === 0)
        {
            $new_category = new Category;
            $new_category->category = $request->category;
            $new_category->save();

            $category = Category::where('category', $request->category)->get();
        }

        
        $sub_category = SubCategory::where('sub_category', $request->sub_category)->get();

        // 中分類が新しいものに修正された場合
        if($sub_category->count() === 0)
        {
            $new_sub_category = new Sub_Category;
            $new_sub_category->sub_category = $request->sub_category;
            $new_sub_category->category_id = $category[0]->id;
            $new_sub_category->save();

            $sub_category = SubCategory::where('sub_category', $request->sub_category)->get();
        }


        // 単語更更新 機能が更新されてもされなくてもアップデートする
        $new_word = Word::find($request->word_id);
        $new_word->word = $request->word;
        $new_word->text = $request->text;
        $new_word->category_id = $category[0]->id;
        $new_word->sub_category_id = $sub_category[0]->id;

        $new_word->save();

        return redirect('/');
    }
}
