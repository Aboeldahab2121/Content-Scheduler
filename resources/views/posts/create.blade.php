@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Schedule New Post</h1>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" required oninput="updateCharacterCount()"></textarea>
                <small id="characterCount" class="form-text text-muted">0 characters</small>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL (optional)</label>
                <input type="url" class="form-control" id="image_url" name="image_url">
            </div>

            <div class="form-group">
                <label for="scheduled_time">Scheduled Time</label>
                <input type="datetime-local" class="form-control" id="scheduled_time" name="scheduled_time" required>
            </div>

            <div class="form-group">
                <label>Platforms</label><br>
                @foreach($platforms as $platform)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="platforms[]"
                               id="platform{{ $platform->id }}" value="{{ $platform->id }}">
                        <label class="form-check-label" for="platform{{ $platform->id }}">
                            {{ $platform->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Schedule Post</button>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
