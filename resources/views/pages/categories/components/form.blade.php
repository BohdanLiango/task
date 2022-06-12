<form method="POST" action="{{ route('tasks.category.save') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <label for="category" class="form-label">Category</label>
            <input name="title" type="text" class="form-control" id="category" required>
            @foreach ($errors->all() as $error)
                <strong style="color: red">{{ $error }}!</strong>
            @endforeach
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
