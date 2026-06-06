@extends('layout')
@section('title', 'STEM Cambodia - Edit Post')
@section('content')

    <style>
        .edit-wrap {
            max-width: 680px;
            margin: 0 auto;
            padding: 3rem 1.5rem 5rem;
        }

        .edit-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--clr-muted);
            margin-bottom: 0.5rem;
        }

        .edit-heading {
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--clr-text);
            margin-bottom: 2rem;
        }

        .edit-card {
            background: var(--clr-surface);
            border: 1px solid var(--clr-border);
            border-radius: var(--radius);
            padding: 2rem;
        }

        .edit-form {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .field-label {
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.04em;
            color: var(--clr-muted);
            margin-bottom: 0.3rem;
            display: block;
        }

        .stem-input {
            width: 100%;
            background: var(--clr-bg);
            border: 1px solid var(--clr-border);
            border-radius: 6px;
            padding: 0.65rem 0.9rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--clr-text);
            outline: none;
            transition: border-color 0.15s;
            resize: vertical;
            box-sizing: border-box;
        }

        .stem-input:focus {
            border-color: var(--clr-accent);
        }

        .edit-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.5rem;
        }

        .btn-stem {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--clr-surface);
            background: var(--clr-accent);
            border: none;
            border-radius: 6px;
            padding: 0.55rem 1.25rem;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .btn-stem:hover {
            opacity: 0.85;
        }

        .btn-cancel {
            font-size: 13.5px;
            font-weight: 400;
            color: var(--clr-muted);
            background: transparent;
            border: 1px solid var(--clr-border);
            border-radius: 6px;
            padding: 0.55rem 1.1rem;
            text-decoration: none;
            transition: border-color 0.15s, color 0.15s;
        }

        .btn-cancel:hover {
            border-color: var(--clr-muted);
            color: var(--clr-text);
        }

        .error-msg {
            font-size: 12px;
            color: #e05252;
            margin-top: 0.25rem;
        }

        .alert-success {
            font-size: 13px;
            color: #2e7d32;
            background: #f0faf0;
            border: 1px solid #a5d6a7;
            border-radius: 6px;
            padding: 0.6rem 0.9rem;
            margin-bottom: 1rem;
        }
    </style>

    <div class="edit-wrap">
        <p class="edit-eyebrow">Posts</p>
        <h1 class="edit-heading">Edit post</h1>

        @auth
            <div class="edit-card">

                @if (session('success'))
                    <div class="alert-success">{{ session('success') }}</div>
                @endif

                <form action="/edit-post/{{ $post->id }}" method="POST" class="edit-form">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="field-label" for="edit-title">Title</label>
                        <input id="edit-title" type="text" name="title" class="stem-input"
                            value="{{ old('title', $post->title) }}">
                        @error('title')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="field-label" for="edit-body">Content</label>
                        <textarea id="edit-body" name="body" class="stem-input" rows="8">{{ old('body', $post->body) }}</textarea>
                        @error('body')
                            <p class="error-msg">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="edit-actions">
                        <button type="submit" class="btn-stem">Save changes</button>
                        <a href="{{ url('') }}" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        @endauth
    </div>

@endsection
