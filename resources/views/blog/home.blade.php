@extends('layouts.app')

@section('title', "Laravel-Blog")

@section('content')
    @foreach ($categories as $category)
        <a href="{{ route('category', $category->slug) }}" class="list-group-item">
            <h4 class="list-group-item-heading">{{ $category->title }}</h4>
            <p class="list-group-item-text">
                Количество постов : {{$category->articles()->where('published', 1)->count()}}
            </p>
        </a>
    @endforeach


@endsection
