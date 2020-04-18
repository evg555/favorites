@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="card">
        <div class="card-body">
            @include('layouts.errors')

            <form action="{{route('favorites.store')}}" method="post" class="form-horizontal">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <label for="url" class="col-sm-3 control-label">Добавить вкладку:</label>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" name="url" id="url" placeholder="http://example.com" class="form-control" value="{{ old('url') }}">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <a href="{{route('favorites.index')}}" class="btn btn-primary">Вернуться к списку закладок</a>
        </div>
    </div>
</div>

@endsection

