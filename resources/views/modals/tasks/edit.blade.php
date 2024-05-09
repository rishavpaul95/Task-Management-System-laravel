<i class="fa-regular fa-pen-to-square" type="button" class="fa-regular fa-pen-to-square" data-bs-toggle="modal"
    data-bs-target="#editModal{{ $task->id }}">

</i>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $task->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $task->id }}">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- modal content --}}
                <form action="{{ url('/tasks/edit', $task->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ $task->date }}" required>
                    </div>

                    <div class="form-group">
                        <label for="topic">Topic:</label>
                        <input type="text" class="form-control" id="topic" name="topic"
                            value="{{ $task->topic }}" placeholder="Enter Topic" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>
                                Completed</option>
                            <option value="Active" {{ $task->status == 'Active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taskimage">Upload Image:</label>
                        <input type="file" class="form-control-file" id="taskimage" name="taskimage">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                {{-- End of modal content --}}
            </div>
        </div>
    </div>
</div>
