<i class="fa-regular fa-pen-to-square" type="button" data-bs-toggle="modal"
    data-bs-target="#editRoleModal{{ $role->id }}"></i>

<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1"
    aria-labelledby="editRoleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleModalLabel{{ $role->id }}">
                    Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('/roles/edit') }}/{{ $role->id }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $role->name }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
