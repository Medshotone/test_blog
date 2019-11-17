@extends('layouts.app')

@section('title', $category->title . " - Laravel-Blog")

@section('content')

  <div class="container">
    @forelse ($articles as $article)
        <div class="list-group-item">
          <h2><a href="{{ route('article', $article->slug) }}">{{ $article->title }}</a></h2>
          <p>Мини описание - {{ $article->description_short }}</p>
        </div>
    @empty
      <h2 class="text-center">Пусто</h2>
    @endforelse
  {{ $articles->links() }}
  </div>

@endsection
