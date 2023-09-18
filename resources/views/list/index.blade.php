@extends('layouts.app')

@section('content')
    <div>
        <div>
            <form action="/list" method="post">
                @csrf
                <label for="text">単語</label>
                <input type="text" name="word" id="form_word"><br>
                <label for="form_text">解説</label>
                <textarea name="text" id="form_text" cols="30" rows="10"></textarea><br>
                <label for="form_category">大分類</label>
                <input type="text" name="category" id="form_category"><br>
                <label for="form_sub_category">中分類</label>
                <input type="text" name="sub_category" id="form_sub_category"><br>
                <input type="submit" value="送信" class="btn btn-dark">
            </form>
        </div>

        <div>
            <table class="table table-bordered">
                <tr><th>id</th><th>単語</th><th>意味</th><th>大分類</th><th>中分類</th><th>出題回数</th><th>分からなかった回数</th></tr>
                @for ($i = 0; $i < $count; $i++)
                    <tr>
                        <td>
                            {{$words[$i]['id']}}
                            <button class="btn btn-primary">編集</button>
                        </td>
                        <td>{{$words[$i]['word']}}</td>
                        <td>{{$words[$i]['text']}}</td>
                        <td>{{$words[$i]['category']}}</td>
                        <td>{{$words[$i]['sub_category']}}</td>
                        <td>{{$words[$i]['question_count']}}</td>
                        <td>{{$words[$i]['mistake_count']}}</td>
                    </tr>
                @endfor
            </table>
        </div>

    </div>
@endsection