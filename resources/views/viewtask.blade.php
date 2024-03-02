@extends('layouts.main')

@push('page-title')
    <title>Task: {{ $task->topic }}</title>
@endpush

@section('main-section')
    <div class="content-wrapper">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid d-flex justify-content-end">
                <a class="navbar-brand ms-auto" href="/alltask">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </nav>


        <section>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-8 card ">
                        <div class="text-center card-body">
                            <h4 class="card-title mb-3">Task Details</h4>
                            <p class="card-text"><strong>Due Date:</strong> {{ $task->date }}</p>
                            <p class="card-text"><strong>Assigned By:</strong> {{ $assignedBy->name }}</p>
                            <p class="card-text"><strong>Assigned To:</strong> {{ $assignedTo->name }}</p>
                            <p class="card-text"><strong>Project:</strong> {{ $categoryName }}</p>
                            <p class="card-text"><strong>Task:</strong> {{ $task->topic }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">



                        <div class="card-body text-center">
                            @if ($task->taskimage)
                                <img src="{{ asset('storage/' . $task->taskimage) }}" alt="Task Image"
                                    class="img-fluid mb-3">
                            @else
                                <p class="card-text mt-3">No Image</p>
                            @endif
                        </div>


                    </div>
                </div>

                @if (auth()->check() && (auth()->user()->id == $assignedBy->id || auth()->user()->id == $assignedTo->id))
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
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-10">

                        <div class="card">
                            <h4 class="card-title m-3">Comments</h4>
                            <div class="card-body">

                                {{-- Display Existing Comments --}}
                                @foreach ($comments as $comment)
                                    <div class="comment mb-3">
                                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                                    </div>
                                @endforeach

                                {{-- Show a message if there are no comments --}}
                                @if (count($comments) === 0)
                                    <p>No comments yet. Be the first to comment!</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection