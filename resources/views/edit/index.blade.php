@extends('layouts.app')

@section('content')
    <div>
        <h2>編集ページ</h2>
        <div>
            <form action="/edit/{{$word['id']}}" method="post">
                @csrf
                <label for="text">単語</label>
                <input type="text" name="word" id="form_word" value="{{$word['word']}}"><br>
                <label for="form_text">解説</label>
                <textarea name="text" id="form_text" cols="30" rows="10">{{$word['text']}}</textarea><br>
                <label for="form_category">大分類</label>
                <input type="text" name="category" id="form_category" value="{{$word->category['category']}}"><br>
                <label for="form_sub_category">中分類</label>
                <input type="text" name="sub_category" id="form_sub_category" value="{{$word->sub_category['sub_category']}}"><br>
                <input type="submit" value="送信" class="btn btn-dark">
            </form>
        </div>
    </div>

@endsection