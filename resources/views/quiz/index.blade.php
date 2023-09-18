@extends('layouts.app')

@section('content')
    <quiz-component :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}"></quiz-component>
@endsection