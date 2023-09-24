@extends('layouts.app')

@section('content')
    <div>
        <quiz-component :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}" :words="{{Js::from($words)}}"></quiz-component>
        <form-word-component :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}"></form-word-component>
        <form-category-component></form-category-component>
        <form-sub-category-component :categories="{{Js::from($categories)}}"></form-sub-category-component>
        <word-table-component :words="{{Js::from($words)}}" :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}"></word-table-component>
    </div>
@endsection