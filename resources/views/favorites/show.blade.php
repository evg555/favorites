@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="card">
        <div class="card-body">
            <h1>{{$favorite->title}}</h1>
            <p>Favicon:
                @if (!empty($favorite->favicon))
                    <img class="img-fluid" src="data:image/png;base64,'{{base64_encode($favorite->favicon)}}" alt="">
                @endif
            </p>
            <p>Дата создания: {{$favorite->created_at->format('d.m.Y')}}</p>
            <p>URL страницы: <a href="{{$favorite->url}}">{{$favorite->url}}</a></p>
            <p>META Description: {{$favorite->meta_description}}</p>
            <p>META Keywords: {{$favorite->meta_keywords}}</p>
        </div>

        <div class="card-body">
            <a href="{{route('favorites.index')}}" class="btn btn-primary">Вернуться к списку закладок</a>
        </div>
    </div>
</div>

@endsection

