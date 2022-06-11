<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    </head>
    <body>
        <div class="container">
            <h2>TASKS</h2>
            <hr>
            <form method="POST" action="{{route('save')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="task" class="form-label">Task</label>
                        <input name="task" type="text" class="form-control" id="task" required>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <hr>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>


                @forelse($tasks as $task)
                    @if($task->is_complete === 0)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->task }}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>
                                <form action="{{ route('finish', $task->id ) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Finish</button>
                                </form>
                                <form action="{{ route('tasks.destroy', $task->id ) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td><s>{{ $task->task }}</s></td>
                            <td>{{ $task->updated_at }}</td>
                            <td>
                                <form action="{{ route('start-again', $task->id ) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Start Again</button>
                                </form>
                                <form action="{{ route('tasks.destroy', $task->id ) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                    @empty
                            Nothing
                    @endforelse
                {{ $tasks->links('vendor.pagination.bootstrap-5') }}
                @if(Request::route()->getName() === 'show')
                        <a href="{{ route('show-hide') }}" class="btn btn-outline-primary"> Hide completed </a>
                    @else
                        <a href="{{ route('show') }}" class="btn btn-outline-primary"> Show All </a>
                @endif
                </tbody>
            </table>
            </ul>
        </div>
    </body>
</html>
