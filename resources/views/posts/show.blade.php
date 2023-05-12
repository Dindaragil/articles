@extends('auth.layouts')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h2>{{ $post->title }}</h2>
                        <img src="{{ asset('storage/posts/'.$post->image) }}" class="w-100 rounded">
                        <hr>
                        <p class="tmt-3">
                            {!! $post->content !!}
                        </p>
                    </div>
                    <h5>Comments</h5>
                        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])
                        <hr />
                        <h6>Add comment</h6>
                        <form method="post" action="{{ route('comments.store') }}">
                        @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" class="btn btn-success" value="Add Comment" />
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
