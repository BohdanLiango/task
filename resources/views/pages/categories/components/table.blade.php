<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Category</th>
        @if(Request::route()->getName() === 'tasks.category.show-deleted')
            <th scope="col">Date deleted</th>
        @else
            <th scope="col">Date add</th>
        @endif
        <th scope="col">Count task</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>

    @forelse($categories as $category)
            @if(Request::route()->getName() === 'tasks.category.show-deleted')
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td><h3><span class="badge text-bg-{{ $category->color }}"><s>{{ $category->title }}</s></span></h3></td>
                    <td>{{ $category->deleted_at }}</td>
                    <td>{{ $category->tasks->count() }}</td>
                    <td>
                        <form action="{{ route('tasks.category.restore', $category->id ) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Restore</button>
                        </form>
                        <form action="{{ route('tasks.category.force-delete', $category->id ) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Force Delete</button>
                        </form>
                    </td>
                </tr>
            @else
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td><h3><span class="badge text-bg-{{ $category->color }}">{{ $category->title }}</span></h3></td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->tasks->count() }}</td>
                    <td>
                        <form action="{{ route('tasks.category.delete', $category->id ) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endif
        @empty
    @endforelse

    {{ $categories->links('vendor.pagination.bootstrap-5') }}

    @if(Request::route()->getName() === 'tasks.category.show-deleted')
        <a href="{{ route('tasks.category.show-all') }}" class="btn btn-outline-primary"> Show All </a>
    @else
        <a href="{{ route('tasks.category.show-deleted') }}" class="btn btn-outline-danger"> Show Deleted </a>
    @endif

    </tbody>
</table>
