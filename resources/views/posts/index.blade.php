@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Scheduled Posts</h1>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">Schedule New Post</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Platforms</th>
                        <th>Scheduled Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ Str::limit($post->title, 30) }}</td>
                            <td>{{ Str::limit($post->content, 50) }}</td>
                            <td>
                                @foreach($post->platforms as $platform)
                                    <span class="badge bg-secondary">{{ $platform->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $post->scheduled_time->format('M j, Y H:i') }}</td>
                            <td>
                            <span class="badge
                                @if($post->status == 'scheduled') bg-warning
                                @elseif($post->status == 'published') bg-success
                                @else bg-secondary @endif">
                                {{ ucfirst($post->status) }}
                            </span>
                            </td>
                            <td>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No posts scheduled yet.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
