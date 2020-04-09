@extends('layouts.app')

@section('content')
    <div class="card-body">
        @include('errors')

        <form action="{{route('tasks')}}" method="post" class="form-horizontal">
            @csrf

            <div class="form-group">
                <div class="row">
                    <label for="name-text" class="col-sm-3 control-label">New task:</label>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <input type="text" name="name" id="name-text" placeholder="Name" class="form-control">
                    </div>
                    <div class="col-sm-3">
                        <textarea name="description" class="form-control" cols="20" rows="3" placeholder="Description"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-success">Add task</button>
                    </div>
                </div>
            </div>
        </form>

        @if (count($tasks) > 0)
            <div class="card">
                <div class="card-header">
                    Current tasks:
                </div>
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Task</th>
                            <th>Description</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="table-text">{{$task->name}}</td>
                                    <td class="table-text">{{$task->description}}</td>
                                    <td>
                                        <form action="{{url('tasks/' . $task->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}

                                            <div class="text-right">
                                                <button class="btn btn-danger text-right">Delete</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
