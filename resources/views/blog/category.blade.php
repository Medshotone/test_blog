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

      <div class="row" style="margin-top: 20px">
          <div class="col-sm-12">
              <h4>Display Comments</h4>
              <div id="article-comments">No comments</div>
              <script type="application/javascript">
                  //comment ajax load
                      $.ajax({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          url: '{{ route("comment.category.show", ["category" => "{$category->id}"]) }}',
                          type: 'GET',
                          dataType: 'json',
                          success: function (json) {
                              let html = '';
                              for(let key in json) {

                                  html += comment.template(json[key]);

                              }

                              $('#article-comments').html(html);
                          }
                      });
              </script>
              <hr />
              <h4>Add comment</h4>
              <form id="add-comment" method="post" action="{{route('comment.category.store')}}">
                  @csrf
                  <div class="form-group">
                      <input type="text" name="user_name" class="form-control" placeholder="ФИО" />
                  </div>
                  <div class="form-group">
                      <input type="text" name="body" class="form-control" placeholder="Текст отзыва" />
                  </div>

                  <input type="hidden" name="category_id" value="{{ $category->id }}" />

                  <div class="form-group">
                      <input type="submit" class="btn btn-warning" value="Add Comment" />
                  </div>
              </form>
          </div>
      </div>

  </div>

@endsection
