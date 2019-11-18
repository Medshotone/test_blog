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
      <div id="article-comments"></div>
      <script type="application/javascript">
        //comment ajax load
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("comment.show", ["article" => "{$article->id}"]) }}',
            type: 'GET',
            dataType: 'json',
            success: function (json) {
              let html = '<div class="list-group">';
              for(let key in json) {
                html += '<div class="list-group-item list-group-item-action flex-column align-items-start">';

                html += '<div class="d-flex w-100 justify-content-between">';
                html += "<h5 class='mb-1'>Comment</h5>";
                html += '<small>'+json[key]['created_at']+'</small>';
                html += '</div>';

                html += '<p class="mb-1">'+json[key]['body']+'</p>';

                html += '<small>'+json[key]['user_name']+'</small>';

                html += '</div>';
              }
              html += '</div>';

              $('#article-comments').html(html);
            }
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
      <script type="application/javascript">
        $('form#article-comment').submit(function (e) {
          e.preventDefault();
          $.ajax({
            url: '{{ route("comment.store") }}',
            data:$(this).serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (json) {
              let html = '<div class="list-group">';

                html += '<div class="list-group-item list-group-item-action flex-column align-items-start">';

                html += '<div class="d-flex w-100 justify-content-between">';
                html += "<h5 class='mb-1'>Comment</h5>";
                html += '<small>'+json.comment['created_at']+'</small>';
                html += '</div>';

                html += '<p class="mb-1">'+json.comment['body']+'</p>';

                html += '<small>'+json.comment['user_name']+'</small>';

                html += '</div>';

              html += '</div>';

              $('#article-comments').append(html);

              e.currentTarget.reset();
            }
          });
        });
      </script>
    </div>
  </div>
</div>

@endsection
