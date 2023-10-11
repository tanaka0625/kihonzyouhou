@extends('layouts.app')

@section('content')
    <div>
        <home-component :categories="{{Js::from($categories)}}" :sub_categories="{{Js::from($sub_categories)}}" :words="{{Js::from($words)}}"></home-component>
    </div>
@endsection