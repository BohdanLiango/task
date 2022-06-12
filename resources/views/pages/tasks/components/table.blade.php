<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Task</th>
        <th scope="col">Category</th>
        @if(Request::route()->getName() === 'task.show-deleted')
            <th scope="col">Date deleted</th>
        @else
            <th scope="col">Date add</th>
        @endif
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    @forelse($tasks as $task)
        @if(Request::route()->getName() !== 'tasks.show-deleted')
            @if($task->is_complete === 0)
                <tr>
                    <th scope="row">{{ $task->id }}</th>
                    <td>{{ $task->title }} <span class="badge text-bg-success">new</span></td>
                    @empty($task->category)  <td> <span class="badge text-bg-danger">-</span> </td>
                    @else
                        <td><h3><span class="badge text-bg-{{ $task->category->color }}">{{ $task->category->title }}</span></h3></td>
                    @endempty
                    <td>{{ $task->created_at }}</td>
                    <td>
                        <form action="{{ route('tasks.finish', $task->id ) }}" method="POST">
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
                    <td><s>{{ $task->title }}</s><span class="badge text-bg-warning">completed</span></td>
                    @empty($task->category)  <td> <span class="badge text-bg-danger">-</span> </td>
                    @else
                        <td><h3><span class="badge text-bg-{{ $task->category->color }}">{{ $task->category->title }}</span></h3></td>
                    @endempty
                    <td>{{ $task->updated_at }}</td>
                    <td>
                        <form action="{{ route('tasks.start-again', $task->id ) }}" method="POST">
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
        @else
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td><s>{{ $task->title }}</s><span class="badge text-bg-danger">deleted</span></td>
                @empty($task->category)  <td> <span class="badge text-bg-danger">-</span> </td>
                @else
                    <td><h3><span class="badge text-bg-{{ $task->category->color }}">{{ $task->category->title }}</span></h3></td>
                @endempty
                <td>{{ $task->deleted_at }}</td>
                <td>
                    <form action="{{ route('tasks.restore', $task->id ) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">Resfore</button>
                    </form>
                    <form action="{{ route('tasks.force-delete', $task->id ) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Force Delete</button>
                    </form>
                </td>
            </tr>

        @endif
    @empty
        Nothing
    @endforelse
    {{ $tasks->links('vendor.pagination.bootstrap-5') }}

    @if(Request::route()->getName() !== 'tasks.show-active')
        <a href="{{ route('tasks.show-active') }}" class="btn btn-outline-primary">Show Active</a>
    @endif
    @if(Request::route()->getName() !== 'tasks.show-hide')
        <a href="{{ route('tasks.show-hide') }}" class="btn btn-outline-primary"> Show completed </a>
    @endif
    @if(Request::route()->getName() !== 'tasks.show-all')
        <a href="{{ route('tasks.show-all') }}" class="btn btn-outline-primary"> Show All </a>
    @endif
    @if(Request::route()->getName() !== 'tasks.show-deleted')
        <a href="{{ route('tasks.show-deleted') }}" class="btn btn-outline-danger"> Show Deleted </a>
    @endif
    </tbody>
</table>
