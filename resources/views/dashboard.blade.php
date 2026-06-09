@extends('layout')
@section('title', 'STEM Cambodia - Dashboard')
@section('content')

    <style>
        /* ── LAYOUT ── */
        .dash-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2.5rem 1.5rem 5rem;
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 2rem;
            align-items: start;
        }

        @media (max-width: 780px) {
            .dash-wrap {
                grid-template-columns: 1fr;
            }

            .dash-sidebar {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar-nav {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.25rem;
            }
        }

        /* ── SIDEBAR ── */
        .dash-sidebar {
            position: sticky;
            top: calc(60px + 1.5rem);
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .profile-card {
            background: linear-gradient(135deg,
                    var(--clr-surface),
                    rgba(37, 99, 235, 0.05));
            border: 1.5px solid var(--clr-border);
            border-radius: 18px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .04);
        }

        .avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
            border: 3px solid rgba(37, 99, 235, .15);
            color: white;
            font-size: 22px;
            font-weight: 700;
        }

        .profile-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--clr-text);
            line-height: 1.3;
        }

        .profile-email {
            font-size: 12px;
            color: var(--clr-muted);
            font-family: 'DM Mono', monospace;
        }

        .profile-badge {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--clr-accent);
            background: var(--clr-accent-dim);
            padding: 0.2rem 0.65rem;
            border-radius: 100px;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 13.5px;
            color: var(--clr-muted);
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: color 0.15s, background 0.15s;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
        }

        .sidebar-nav-item:hover {
            color: var(--clr-text);
            background: var(--clr-accent-dim);
        }

        .sidebar-nav-item.active {
            color: var(--clr-accent);
            background: var(--clr-accent-dim);
            font-weight: 500;
        }

        .sidebar-nav-item .nav-icon {
            font-size: 16px;
            width: 18px;
            flex-shrink: 0;
            display: inline-flex;
        }

        .sidebar-divider {
            height: 1px;
            background: var(--clr-border);
            margin: 0.25rem 0;
        }

        .sidebar-nav-item.danger {
            color: #b91c1c;
        }

        .sidebar-nav-item.danger:hover {
            background: #fef2f2;
            color: #b91c1c;
        }

        /* ── MAIN PANELS ── */
        .dash-main {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            min-width: 0;
        }

        .panel {
            background: var(--clr-surface);
            border: 1.5px solid var(--clr-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow:
                0 4px 12px rgba(0, 0, 0, 0.04),
                0 1px 3px rgba(0, 0, 0, 0.08);
            transition: all .2s ease;
        }

        .panel:hover {
            border-color: var(--clr-accent);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--clr-border);
            position: relative;
        }

        .panel-header::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: var(--clr-accent);
        }

        .panel-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--clr-text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .panel-title .material-symbols-outlined {
            font-size: 17px;
            color: var(--clr-accent);
        }

        .panel-count {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--clr-muted);
            background: var(--clr-bg);
            border: 1px solid var(--clr-border);
            border-radius: 100px;
            padding: 0.1rem 0.55rem;
        }

        .panel-body {
            padding: 1.5rem;
        }

        /* ── STATS ROW ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        .stat-card {
            background: linear-gradient(135deg,
                    rgba(37, 99, 235, 0.05),
                    rgba(37, 99, 235, 0.01));
            border: 1px solid rgba(37, 99, 235, .15);
            border-radius: 14px;
            padding: 1.25rem;
        }

        .stat-label {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--clr-muted);
            margin-bottom: 0.4rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--clr-accent);
        }

        .stat-sub {
            font-size: 12px;
            color: var(--clr-muted);
            margin-top: 0.25rem;
        }

        /* ── POST LIST ── */
        .post-list {
            display: flex;
            flex-direction: column;
        }

        .post-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--clr-border);
            transition: background 0.15s;
        }

        .post-row:last-child {
            border-bottom: none;
        }

        .post-row:hover {
            background: var(--clr-bg);
        }

        .post-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-nav-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .8rem 1rem;
            border-radius: 10px;
            border: 1px solid transparent;
            transition: all .2s ease;
        }

        .sidebar-nav-item.active {
            background: rgba(37, 99, 235, .12);
            border: 1px solid rgba(37, 99, 235, .2);
            color: var(--clr-accent);
        }

        .sidebar-nav-item:hover {
            background: rgba(37, 99, 235, .08);
            border-color: rgba(37, 99, 235, .15);
        }

        .post-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--clr-text);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0.25rem;
        }

        .post-meta {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--clr-muted);
        }

        .post-body-preview {
            font-size: 12.5px;
            color: var(--clr-muted);
            margin-top: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 420px;
        }

        .post-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .btn-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border: 1px solid var(--clr-border);
            border-radius: 6px;
            background: transparent;
            color: var(--clr-muted);
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
            transition: border-color 0.15s, color 0.15s, background 0.15s;
        }

        .btn-icon:hover {
            border-color: var(--clr-accent);
            color: var(--clr-accent);
            background: var(--clr-accent-dim);
        }

        .btn-icon.danger:hover {
            border-color: #fca5a5;
            color: #b91c1c;
            background: #fef2f2;
        }

        /* ── CREATE POST FORM ── */
        .form-stack {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .field-label {
            font-size: 11.5px;
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--clr-muted);
        }

        .stem-input {
            width: 100%;
            background: white;
            border: 1.5px solid #dbe4f0;
            border-radius: 10px;
            padding: 0.8rem 1rem;
            font-size: 14px;
            transition: all .2s ease;
        }

        .stem-input:focus {
            border-color: var(--clr-accent);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, .12);
        }

        .stem-input::placeholder {
            color: #a1a1a1;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.75rem;
            padding-top: 0.25rem;
        }

        .btn-stem {
            background: linear-gradient(135deg,
                    #2563eb,
                    #3b82f6);
            color: white;
            border: none;
            border-radius: 10px;
            padding: .75rem 1.4rem;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(37, 99, 235, .25);
            transition: all .2s ease;
        }

        .btn-stem:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(37, 99, 235, .35);
        }

        /* ── ACCOUNT SETTINGS ── */
        .settings-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.9rem 1.5rem;
            border-bottom: 1px solid var(--clr-border);
            gap: 1rem;
        }

        .settings-row:last-child {
            border-bottom: none;
        }

        .settings-key {
            font-size: 12px;
            font-family: 'DM Mono', monospace;
            color: var(--clr-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            flex-shrink: 0;
            width: 100px;
        }

        .settings-val {
            font-size: 14px;
            color: var(--clr-text);
            flex: 1;
        }

        .settings-action {
            font-size: 12.5px;
            color: var(--clr-accent);
            text-decoration: none;
            flex-shrink: 0;
        }

        .settings-action:hover {
            text-decoration: underline;
        }

        /* ── EMPTY STATE ── */
        .empty-state {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .empty-icon {
            font-size: 32px;
            color: var(--clr-border);
            margin-bottom: 0.75rem;
        }

        .empty-text {
            font-size: 14px;
            color: var(--clr-muted);
        }

        /* ── TAB SYSTEM (JS) ── */
        .dash-section {
            display: none;
        }

        .dash-section.visible {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
    </style>

    <div class="dash-wrap">

        {{-- ── SIDEBAR ── --}}
        <aside class="dash-sidebar">

            {{-- Profile card --}}
            <div class="profile-card">
                <div class="avatar">{{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}</div>
                <div>
                    <p class="profile-name">{{ auth()->user()?->name ?? 'User' }}</p>
                    <p class="profile-email">{{ auth()->user()?->email ?? '' }}</p>
                </div>
                <span class="profile-badge">Member</span>
            </div>

            {{-- Nav --}}
            <nav class="sidebar-nav" role="navigation" aria-label="Dashboard navigation">
                <button class="sidebar-nav-item active" onclick="switchTab('overview', this)">
                    <span class="nav-icon material-symbols-outlined">grid_view</span>
                    Overview
                </button>
                <button class="sidebar-nav-item" onclick="switchTab('posts', this)">
                    <span class="nav-icon material-symbols-outlined">article</span>
                    My Posts
                </button>
                <button class="sidebar-nav-item" onclick="switchTab('create', this)">
                    <span class="nav-icon material-symbols-outlined">edit</span>
                    New Post
                </button>
                <button class="sidebar-nav-item" onclick="switchTab('settings', this)">
                    <span class="nav-icon material-symbols-outlined">manage_accounts</span>
                    Account
                </button>

                <div class="sidebar-divider"></div>

                <form action="/logout" method="POST" style="margin:0">
                    @csrf
                    <button type="submit" class="sidebar-nav-item danger" style="width:100%">
                        <span class="nav-icon material-symbols-outlined">logout</span>
                        Log out
                    </button>
                </form>
            </nav>
        </aside>

        {{-- ── MAIN ── --}}
        <main class="dash-main">

            {{-- ── OVERVIEW TAB ── --}}
            <div id="tab-overview" class="dash-section visible">

                {{-- Stats --}}
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <span class="material-symbols-outlined">insights</span>
                            Overview
                        </span>
                    </div>
                    <div class="panel-body">
                        <div class="stats-row">
                            <div class="stat-card">
                                <p class="stat-label">Posts</p>
                                <p class="stat-value">{{ isset($posts) ? count($posts) : 0 }}</p>
                                <p class="stat-sub">published</p>
                            </div>
                            <div class="stat-card">
                                <p class="stat-label">Member since</p>
                                <p class="stat-value" style="font-size:1.1rem; padding-top:0.3rem">
                                    {{ auth()->user()?->created_at?->format('M Y') ?? '—' }}
                                </p>
                                <p class="stat-sub">joined</p>
                            </div>
                            <div class="stat-card">
                                <p class="stat-label">Subjects</p>
                                <p class="stat-value">4</p>
                                <p class="stat-sub">available</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent posts --}}
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <span class="material-symbols-outlined">article</span>
                            Recent posts
                        </span>
                        <span class="panel-count">{{ isset($posts) ? count($posts) : 0 }}</span>
                    </div>

                    @if (isset($posts) && count($posts) > 0)
                        <div class="post-list">
                            @foreach ($posts->take(5) as $post)
                                <div class="post-row">
                                    <div class="post-info">
                                        <p class="post-title">{{ $post->title }}</p>
                                        <p class="post-body-preview">{{ Str::limit($post->body, 80) }}</p>
                                        <p class="post-meta">
                                            {{ $post->created_at ? $post->created_at->diffForHumans() : '' }}
                                        </p>
                                    </div>
                                    <div class="post-actions">
                                        <a href="/edit-post/{{ $post->id }}" class="btn-icon" title="Edit">
                                            <span class="material-symbols-outlined" style="font-size:15px">edit</span>
                                        </a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST" style="margin:0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon danger" title="Delete">
                                                <span class="material-symbols-outlined" style="font-size:15px">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon material-symbols-outlined">article</div>
                            <p class="empty-text">No posts yet. Write your first one.</p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- ── POSTS TAB ── --}}
            <div id="tab-posts" class="dash-section">
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <span class="material-symbols-outlined">article</span>
                            All posts
                        </span>
                        <span class="panel-count">{{ isset($posts) ? count($posts) : 0 }}</span>
                    </div>

                    @if (isset($posts) && count($posts) > 0)
                        <div class="post-list">
                            @foreach ($posts as $post)
                                <div class="post-row">
                                    <div class="post-info">
                                        <p class="post-title">{{ $post->title }}</p>
                                        <p class="post-body-preview">{{ Str::limit($post->body, 100) }}</p>
                                        <p class="post-meta">
                                            {{ $post->created_at ? $post->created_at->diffForHumans() : '' }}
                                        </p>
                                    </div>
                                    <div class="post-actions">
                                        <a href="/edit-post/{{ $post->id }}" class="btn-icon" title="Edit">
                                            <span class="material-symbols-outlined" style="font-size:15px">edit</span>
                                        </a>
                                        <form action="/delete-post/{{ $post->id }}" method="POST" style="margin:0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon danger" title="Delete">
                                                <span class="material-symbols-outlined"
                                                    style="font-size:15px">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-icon material-symbols-outlined">article</div>
                            <p class="empty-text">No posts yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── CREATE POST TAB ── --}}
            <div id="tab-create" class="dash-section">
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <span class="material-symbols-outlined">edit</span>
                            New post
                        </span>
                    </div>
                    <div class="panel-body">
                        <form action="/create-post" method="POST" class="form-stack">
                            @csrf
                            <div class="field-group">
                                <label class="field-label" for="new-title">Title</label>
                                <input id="new-title" type="text" name="title" class="stem-input"
                                    placeholder="Give your post a title" value="{{ old('title') }}">
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="new-body">Content</label>
                                <textarea id="new-body" name="body" class="stem-input" rows="10" placeholder="Write something…">{{ old('body') }}</textarea>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn-stem">Publish post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ── ACCOUNT TAB ── --}}
            <div id="tab-settings" class="dash-section">
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title">
                            <span class="material-symbols-outlined">manage_accounts</span>
                            Account details
                        </span>
                    </div>

                    <div class="settings-row">
                        <span class="settings-key">Username</span>
                        <span class="settings-val">{{ auth()->user()?->name ?? '—' }}</span>
                        <a href="#" class="settings-action">Edit</a>
                    </div>
                    <div class="settings-row">
                        <span class="settings-key">Email</span>
                        <span class="settings-val">{{ auth()->user()?->email ?? '—' }}</span>
                        <a href="#" class="settings-action">Edit</a>
                    </div>
                    <div class="settings-row">
                        <span class="settings-key">Password</span>
                        <span class="settings-val" style="color: var(--clr-muted)">••••••••</span>
                        <a href="#" class="settings-action">Change</a>
                    </div>
                    <div class="settings-row">
                        <span class="settings-key">Joined</span>
                        <span class="settings-val">
                            {{ auth()->user()?->created_at?->format('d M Y') ?? '—' }}
                        </span>
                        <span></span>
                    </div>
                </div>

                {{-- Danger zone --}}
                <div class="panel">
                    <div class="panel-header">
                        <span class="panel-title" style="color:#b91c1c">
                            <span class="material-symbols-outlined" style="color:#b91c1c">warning</span>
                            Danger zone
                        </span>
                    </div>
                    <div class="panel-body"
                        style="display:flex; align-items:center; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                        <div>
                            <p style="font-size:14px; font-weight:500; color:var(--clr-text); margin-bottom:0.2rem">Log out
                                of all devices</p>
                            <p style="font-size:13px; color:var(--clr-muted)">End all active sessions for your account.</p>
                        </div>
                        <form action="/logout" method="POST" style="margin:0">
                            @csrf
                            <button type="submit" class="btn-stem" style="background:#b91c1c">Log out</button>
                        </form>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <script>
        function switchTab(name, el) {
            document.querySelectorAll('.dash-section').forEach(s => s.classList.remove('visible'));
            document.querySelectorAll('.sidebar-nav-item').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('visible');
            el.classList.add('active');
        }
    </script>

@endsection
