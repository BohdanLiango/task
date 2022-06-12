<form method="POST" action="{{route('tasks.save')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <label for="task" class="form-label">Task</label>
            <input name="title" type="text" class="form-control" id="task" required>
            @foreach ($errors->all() as $error)
                <strong style="color: red">{{ $error }}!</strong>
            @endforeach
        </div>

        <div class="col-md-12">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" class="form-select" id="category" aria-label="Default select example">
                <option selected>Select category</option>
                @forelse($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @empty
                @endforelse
            </select>

        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
