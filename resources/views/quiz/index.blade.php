@extends('layouts.app')

@section('content')
    <quiz-component :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}" :num="3" :words="{{Js::from($words)}}"></quiz-component>
@endsection