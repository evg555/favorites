@extends('layouts.app')

@section('content')

    <div class="card-body">
{{--        @include('layouts.errors')--}}

{{--        <form action="{{route('favorites.store')}}" method="post" class="form-horizontal">--}}
{{--            @csrf--}}

{{--            <div class="form-group">--}}
{{--                <div class="row">--}}
{{--                    <label for="name-text" class="col-sm-3 control-label">New task:</label>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <input type="text" name="name" id="name-text" placeholder="Name" class="form-control">--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-3">--}}
{{--                        <textarea name="description" class="form-control" cols="20" rows="3" placeholder="Description"></textarea>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <button type="submit" class="btn btn-success">Add task</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}

        <div class="card">
            <div class="card-header">
                Сохраненные закладки:
            </div>

            <div class="card-body">
                <a href="{{route('favorites.add')}}" class="btn btn-primary">Добавить закладку</a>
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
                                            <img class="img-fluid" src="data:image/png;base64,'{{base64_encode($favorite->favicon)}}" alt="">
                                        @endif
                                    </td>
                                    <td class="table-text">{{$favorite->url}}</td>
                                    <td class="table-text">{{$favorite->title}}</td>
                                    <td><a href="{{route('favorites.show', $favorite)}}" class="btn btn-primary">Смотреть</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="card-body">
                    Закладок не найдено
                </div>
            @endif
        </div>
    </div>
@endsection
