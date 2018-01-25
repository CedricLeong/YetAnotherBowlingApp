@extends('layouts.app')

@section('content')

        <!-- Bootstrap Boilerplate... -->

<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')


    <div class="panel panel-primary">
        <div class="panel-heading">
            Yet Another Bowling App
        </div>

        <div class="panel-body">
            <form action="/scores" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <table class="table table-striped Player-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Players</th>
                    @for ($i = 1; $i <= 10; $i++)
                        <th>{{$i}}</th>
                    @endfor
                    <th>Total Score</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($users as $user)

                        <tr>
                            <!-- Player Name -->
                            <td class="table-text">
                                <div>{{ $user->name }}</div>
                            </td>
                            @for ($i = 1; $i <= 10; $i++)
                                <td>
                                    <input type="text" name="score[{{$user->id}}][{{$i}}]" id="score-value"
                                           class="form-control"
                                           value="{{isset($user->scores) && count($user->scores) > 0?$user->scores->keyBy('frame')->get($i)->value:0}}">
                                </td>
                            @endfor
                            <td>{{$user->scores->sum('value')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            Add Score
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <form action="/scores/0" method="POST">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <button type="submit" class="btn btn-danger">
            Clear All Scores
        </button>
        <div class="col-sm-2">
            <a href="/" class="btn btn-default"> Back to Player Page </a>
        </div>
    </form>
</div>
@endsection