@extends('admin.loyouts.app_admin')

@section('content')

<div class="container">

  @component('admin.components.breadcrumb')
    @slot('title') Список категорий @endslot
    @slot('parent') Главная @endslot
    @slot('active') Категории @endslot
  @endcomponent
  <hr>

  <a href="{{route('admin.category.create')}}" class="btn btn-primary pull-right"><i class="fafa-plus-square-o">Создать категорию</i></a>
  <table class="table table-striped">
    <thead>
      <th>Наименование</th>
      <th>Публикация</th>
      <th class="text-right">Действие</th>
    </thead>
    <tbody>
      @forelse ($categories as $category)
        <tr>
          <td>{{$category->title}}</td>
          <td>{{$category->published}}</td>
          <td>
            <form onsubmit="if(confirm('Удалить?')){return true}else{return false}" action="{{route('admin.category.destroy', $category)}}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              {{ csrf_field() }}

              <a href="{{route('admin.category.edit', $category)}}"><i class="fa fa-edit"></i></a>
              <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="3" class="text-center">Данние отсуствуют</td>
        </tr>
      @endforelse
    </tbody>
    <tfoot>
      <td colspan="3">
        <ul class="pagination pull-right">
          {{$categories->links()}}
        </ul>
      </td>
    </tfoot>
  </table>
</div>

@endsection
