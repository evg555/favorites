@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                Сохраненные закладки:
            </div>

            <div class="card-body">
                <a href="{{route('favorites.create')}}" class="btn btn-primary">Добавить закладку</a>

                @if (count($favorites) > 0)
                    <a href="{{route('favorites.export')}}" class="btn btn-primary">Экспорт в Excel</a>
                @endif
            </div>

            @if (count($favorites) > 0)
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Дата добавления
                                @if ($params['order'] === 'created_at' && $params['by'] === 'asc')
                                    <a href="{{route('favorites.index', ['order' => 'created_at','by' => 'desc'])}}"><i class="fa fa-caret-up"></i></a>
                                @else
                                    <a href="{{route('favorites.index', ['order' => 'created_at','by' => 'asc'])}}"><i class="fa fa-sort-down"></i></a>
                                @endif
                            </th>
                            <th>Favicon</th>
                            <th>URL страницы
                                @if ($params['order'] === 'url' && $params['by'] === 'asc')
                                    <a href="{{route('favorites.index', ['order' => 'url','by' => 'desc'])}}"><i class="fa fa-caret-up"></i></a>
                                @else
                                    <a href="{{route('favorites.index', ['order' => 'url','by' => 'asc'])}}"><i class="fa fa-sort-down"></i></a>
                                @endif
                            </th>
                            <th>Заголовок страницы
                                @if ($params['order'] === 'title' && $params['by'] === 'asc')
                                    <a href="{{route('favorites.index', ['order' => 'title','by' => 'desc'])}}"><i class="fa fa-caret-up"></i></a>
                                @else
                                    <a href="{{route('favorites.index', ['order' => 'title','by' => 'asc'])}}"><i class="fa fa-sort-down"></i></a>
                                @endif
                            </th>
                            <th>Подробнее</th>
                        </thead>
                        <tbody>
                            @foreach ($favorites as $favorite)
                                <tr>
                                    <td class="table-text">{{$favorite->created_at->format('d.m.Y')}}</td>
                                    <td>
                                        @if (!empty($favorite->favicon))
                                            <img class="img-fluid" width="24" height="24" src="{{Config::get('app.upload_dir') . '/' . $favorite->favicon}}" alt="">
                                        @endif
                                    </td>
                                    <td class="table-text">{{$favorite->url}}</td>
                                    <td class="table-text">{{$favorite->title}}</td>
                                    <td><a href="{{route('favorites.show', $favorite)}}" class="btn btn-primary">Смотреть</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{$favorites->appends($params)->links()}}
                </div>
            @else
                <div class="card-body">
                    Закладок не найдено
                </div>
            @endif
        </div>
    </div>

@endsection
