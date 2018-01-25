@extends('layouts.app')

@section('content')

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        <div class="panel panel-primary">
            <div class="panel-heading">Yet Another Bowling App</div>
            <!-- New Player Form -->
            <form action="/users" method="POST" class="form-horizontal">
                {{ csrf_field() }}
                <div class="panel-body">
                    <p>Please add atleast one player before you begin the game.</p>

                    <!-- Player Name -->
                    <div class="form-group">
                        <div class="col-sm-4">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Player Name">
                        </div>
                        <!-- Add Player Button -->
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-default">
                                Add Player
                            </button>
                        </div>
                        <!-- Start Game Button -->
                        <div class="col-sm-2">
                            <a href="/scores" class="btn btn-primary"> Start Game </a>
                        </div>
                    </div>
                </div>
        </form>

    </div>


    <!-- Current Players -->
    @if (count($users) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Players
            </div>

            <div class="panel-body">
                <table class="table table-striped Player-table">

                    <!-- Table Headings -->
                    <thead>
                    <th>Players</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <!-- Player Name -->
                            <td class="table-text">
                                <div>{{ $user->name }}</div>
                            </td>

                            <td>
                                <form action="/users/{{ $user->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        Delete Player
                                    </button>
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
