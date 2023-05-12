@extends('auth.layouts')

@section('content')
    <div class="mt-5 shadow p-3 mb-5 bg-body-tertiary rounded">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Manage Posts</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">Add Post</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Images</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
                                <th scope="col">Content</th>
                                <th scope="col">Posted At</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($posts as $post)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/posts/'.$post->image) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->author }}</td>
                                    <td>{!! $post->content !!}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Are you sure ?');" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                        </form>
                                    </td>

                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      No Post Found.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>
                          {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        @if(session()->has('success'))

            toastr.success('{{ session('success') }}', 'SUCCESS!');

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'FAILED!');

        @endif
    </script>
@endsection

