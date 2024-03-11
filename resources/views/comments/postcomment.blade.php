<div class="row justify-content-center">
    <div class="col-md-11">

        <div class="card">
            <h4 class="card-title m-3">Post a Comment</h4>
            <div class="card-body">

                <form action="{{ url('/comment') }}/{{ $task->id }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">Your Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>

            </div>
        </div>
    </div>
</div>
