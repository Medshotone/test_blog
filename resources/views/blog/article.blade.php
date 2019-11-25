@extends('layouts.app')
@section('title', $article->meta_title)
@section('meta_keywords', $article->meta_keyword)
@section('meta_description', $article->meta_description)

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>{{ $article->title }}</h1>
      <p>{!!$article->description!!}</p>
    </div>
    <div class="col-sm-12">
      <h4>Display Comments</h4>
      <div id="article-comments">No comments</div>
      <script type="application/javascript">
        //comment ajax load

        document.addEventListener("DOMContentLoaded", function(event) {
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("comment.show", ["article" => "{$article->id}"]) }}',
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
        });
      </script>
      <hr />
      <h4>Add comment</h4>
      <form id="article-comment" method="post" action="{{route('comment.store')}}">
        @csrf
        <div class="form-group">
          <input type="text" name="user_name" class="form-control" placeholder="ФИО" />
        </div>
        <div class="form-group">
          <input type="text" name="body" class="form-control" placeholder="Текст отзыва" />
        </div>

        <input type="hidden" name="article_id" value="{{ $article->id }}" />

        <div class="form-group">
          <input type="submit" class="btn btn-warning" value="Add Comment" />
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
