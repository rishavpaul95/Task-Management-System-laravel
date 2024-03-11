<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
    Assign Task
</button>


{{-- Add Modal Start --}}

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Assign Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/assigntask/add') }}" method="POST" enctype = 'multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="topic">Topic:</label>
                        <input type="text" class="form-control" id="topic" name="topic"
                            placeholder="Enter Topic" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Completed">Completed</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="taskimage">Upload Image:</label>
                        <input type="file" class="form-control-file" id="addtaskimage" name="taskimage">
                    </div>



                    <div class="form-group">

                        <label for="assigneduser">Assign To:</label>
                        <select name="assigneduser" id="assigneduser" class="form-control">

                            @foreach ($users as $user)
                                @if ($user->id != auth()->user()->id)
                                    <option value="{{ $user->id }}"
                                        {{ old('assigneduser') == $user->id ? 'selected' : '' }}>
                                        ID: {{ $user->id }} | {{ $user->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>


                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

{{-- Add Modal End --}}
