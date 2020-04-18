@extends('layouts.app')

@section('content')

    <div class="card-body">
        <div class="card">
            <div class="card-header">
                Сохраненные закладки:
            </div>

            <div class="card-body">
                <a href="{{route('favorites.create')}}" class="btn btn-primary">Добавить закладку</a>
            </div>

            @if (count($favorites) > 0)
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Дата добавления</th>
                            <th>Favicon</th>
                            <th>URL страницы</th>
                            <th>Заголовок страницы</th>
                            <th>Подробнее</th>
                        </thead>
                        <tbody>
                            @foreach ($favorites as $favorite)
                                <tr>
                                    <td class="table-text">{{$favorite->created_at->format('d.m.Y')}}</td>
                                    <td>
                                        @if (!empty($favorite->favicon))
                                            <img class="img-fluid" width="24" height="24" src="{{$favorite->favicon}}" alt="">
                                        @endif
                                    </td>
                                    <td class="table-text">{{$favorite->url}}</td>
                                    <td class="table-text">{{$favorite->title}}</td>
                                    <td><a href="{{route('favorites.show', $favorite)}}" class="btn btn-primary">Смотреть</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$favorites->links()}}
                </div>
            @else
                <div class="card-body">
                    Закладок не найдено
                </div>
            @endif
        </div>
    </div>

@endsection
