@extends('layout')
@section('title', 'STEM Cambodia - Dashboard')
@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist+Mono:wght@400;500&family=Instrument+Sans:wght@400;500;600&display=swap');

        .db-root {
            font-family: 'Instrument Sans', sans-serif;
            background: #fff;
            color: #0f1117;
            min-height: calc(100vh - var(--nav-h, 60px));
            position: relative;
            overflow: hidden;
        }

        .db-gridbg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
            z-index: 0;
        }

        .db-glow {
            position: absolute;
            top: -120px;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 300px;
            background: radial-gradient(ellipse at 50% 0%, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .db-inner {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 1.5rem;
            padding: 2rem 1.5rem 4rem;
            max-width: 1100px;
            margin: 0 auto;
            align-items: start;
        }

        @media (max-width: 780px) {
            .db-inner { grid-template-columns: 1fr; }
            .db-sidebar { flex-direction: row; flex-wrap: wrap; }
            .db-nav { flex-direction: row; flex-wrap: wrap; }
        }

        .db-sidebar {
            position: sticky;
            top: calc(60px + 1.5rem);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .db-profile {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 1.25rem;
            text-align: center;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }

        .db-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            border: 2px solid rgba(37,99,235,0.15);
            color: #fff;
            font-size: 20px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.75rem;
        }

        .db-pname  { font-size: 14px; font-weight: 600; color: #0f1117; margin-bottom: 2px; }
        .db-pemail { font-family: 'Geist Mono', monospace; font-size: 11px; color: #9ca3af; margin-bottom: 0.6rem; }
        .db-pbadge {
            display: inline-block;
            font-family: 'Geist Mono', monospace; font-size: 10px;
            letter-spacing: 0.08em; text-transform: uppercase;
            color: #2563eb; background: rgba(59,130,246,0.08);
            border: 1px solid rgba(59,130,246,0.2);
            padding: 3px 10px; border-radius: 100px;
        }

        .db-nav {
            display: flex; flex-direction: column; gap: 2px;
            background: #fff; border: 1px solid #e5e7eb;
            border-radius: 14px; padding: 0.5rem;
            box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        }

        .db-navitem {
            display: flex; align-items: center; gap: 0.6rem;
            font-size: 13px; color: #6b7280;
            padding: 0.55rem 0.75rem; border-radius: 8px;
            cursor: pointer; border: none; background: none;
            width: 100%; text-align: left;
            transition: color 0.15s, background 0.15s;
            font-family: 'Instrument Sans', sans-serif;
        }
        .db-navitem:hover  { color: #0f1117; background: #f9fafb; }
        .db-navitem.active { color: #2563eb; background: rgba(59,130,246,0.08); font-weight: 500; }
        .db-navitem.danger { color: #b91c1c; }
        .db-navitem.danger:hover { background: #fef2f2; color: #b91c1c; }
        .nav-ic { font-size: 16px; width: 17px; flex-shrink: 0; }
        .db-nav-divider { height: 1px; background: #e5e7eb; margin: 4px 0; }

        .db-main { display: flex; flex-direction: column; gap: 1rem; min-width: 0; }
        .db-section { display: none; flex-direction: column; gap: 1rem; }
        .db-section.visible { display: flex; }

        .panel {
            background: #fff; border: 1px solid #e5e7eb;
            border-radius: 14px; overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }

        .panel-hd {
            display: flex; align-items: center; justify-content: space-between;
            padding: 0.85rem 1.25rem; border-bottom: 1px solid #e5e7eb;
            position: relative;
        }
        .panel-hd::before {
            content: ''; position: absolute; left: 0; top: 0;
            width: 3px; height: 100%; background: #2563eb;
        }
        .panel-htitle { display: flex; align-items: center; gap: 0.5rem; font-size: 12px; font-weight: 500; color: #0f1117; }
        .panel-htitle .material-symbols-outlined { font-size: 16px; color: #2563eb; }
        .panel-badge {
            font-family: 'Geist Mono', monospace; font-size: 10px;
            color: #9ca3af; background: #f9fafb;
            border: 1px solid #e5e7eb; border-radius: 100px; padding: 2px 8px;
        }
        .panel-bd { padding: 1.25rem; }

        .stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 0.75rem; }
        @media (max-width: 600px) { .stats-grid { grid-template-columns: 1fr 1fr; } }

        .stat-card {
            background: rgba(59,130,246,0.04);
            border: 1px solid rgba(59,130,246,0.12);
            border-radius: 12px; padding: 1rem;
        }
        .stat-lbl { font-family: 'Geist Mono', monospace; font-size: 10px; letter-spacing: 0.08em; text-transform: uppercase; color: #9ca3af; margin-bottom: 0.3rem; }
        .stat-val { font-size: 1.75rem; font-weight: 700; color: #2563eb; line-height: 1; }
        .stat-sub { font-size: 11px; color: #9ca3af; margin-top: 0.25rem; }

        .post-list { display: flex; flex-direction: column; }
        .post-row {
            display: flex; align-items: flex-start; justify-content: space-between;
            gap: 1rem; padding: 0.85rem 1.25rem;
            border-bottom: 1px solid #f3f4f6; transition: background 0.15s;
        }
        .post-row:last-child { border-bottom: none; }
        .post-row:hover { background: #fafafa; }
        .post-info { flex: 1; min-width: 0; }
        .post-title { font-size: 13.5px; font-weight: 500; color: #0f1117; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .post-preview { font-size: 12px; color: #9ca3af; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 3px; }
        .post-meta { font-family: 'Geist Mono', monospace; font-size: 10px; color: #d1d5db; }
        .post-acts { display: flex; gap: 6px; flex-shrink: 0; }

        .btn-ic {
            display: flex; align-items: center; justify-content: center;
            width: 28px; height: 28px; border: 1px solid #e5e7eb;
            border-radius: 6px; background: #fff; color: #9ca3af;
            cursor: pointer; font-size: 13px; text-decoration: none;
            transition: all 0.15s;
        }
        .btn-ic:hover { border-color: #2563eb; color: #2563eb; background: rgba(59,130,246,0.06); }
        .btn-ic.del:hover { border-color: #fca5a5; color: #b91c1c; background: #fef2f2; }

        .empty-state { padding: 2.5rem 1.25rem; text-align: center; }
        .empty-state .material-symbols-outlined { font-size: 32px; color: #e5e7eb; display: block; margin-bottom: 0.5rem; }
        .empty-state p { font-size: 13px; color: #9ca3af; }

        /* ── CREATE FORM ── */
        .form-stack { display: flex; flex-direction: column; gap: 0.75rem; }
        .f-group { display: flex; flex-direction: column; gap: 5px; }
        .f-label { font-family: 'Geist Mono', monospace; font-size: 10px; letter-spacing: 0.1em; text-transform: uppercase; color: #9ca3af; }

        .stem-input {
            width: 100%; background: #f9fafb; border: 1px solid #e5e7eb;
            border-radius: 8px; padding: 9px 12px; font-size: 13px;
            color: #0f1117; font-family: 'Instrument Sans', sans-serif;
            outline: none; transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            box-sizing: border-box;
        }
        .stem-input::placeholder { color: #d1d5db; }
        .stem-input:focus { background: #fff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }

        /* ADDED: file input */
        .file-input {
            width: 100%; background: #f9fafb; border: 1px solid #e5e7eb;
            border-radius: 8px; padding: 8px 12px; font-size: 12px;
            color: #6b7280; cursor: pointer; box-sizing: border-box;
            transition: border-color 0.15s;
        }
        .file-input:focus { outline: none; border-color: #3b82f6; }

        .error-msg { font-size: 11px; color: #b91c1c; margin-top: 3px; }

        .form-footer-right { display: flex; justify-content: flex-end; padding-top: 4px; }

        .btn-stem {
            padding: 9px 18px; background: #2563eb; color: #fff;
            border: none; border-radius: 8px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'Instrument Sans', sans-serif;
            transition: opacity 0.15s;
        }
        .btn-stem:hover { opacity: 0.87; }

        .alert-stem {
            background: #fef2f2; border: 1px solid #fecaca;
            border-radius: 8px; padding: 10px 14px;
            font-size: 12px; color: #b91c1c; margin-bottom: 12px;
        }
        .alert-stem ul { margin: 0; padding-left: 1rem; }

        .srow { display: flex; align-items: center; justify-content: space-between; padding: 0.8rem 1.25rem; border-bottom: 1px solid #f3f4f6; gap: 1rem; }
        .srow:last-child { border-bottom: none; }
        .skey { font-family: 'Geist Mono', monospace; font-size: 10px; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; width: 90px; flex-shrink: 0; }
        .sval { font-size: 13px; color: #0f1117; flex: 1; }
        .sedit { font-size: 12px; color: #2563eb; text-decoration: none; flex-shrink: 0; }
        .sedit:hover { text-decoration: underline; }

        .danger-zone-body { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
        .btn-danger { padding: 8px 16px; background: #b91c1c; color: #fff; border: none; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; font-family: 'Instrument Sans', sans-serif; }
    </style>

    <div class="db-root">
        <div class="db-gridbg"></div>
        <div class="db-glow"></div>

        <div class="db-inner">

            {{-- SIDEBAR --}}
            <aside class="db-sidebar">
                <div class="db-profile">
                    <div class="db-avatar">{{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}</div>
                    <p class="db-pname">{{ auth()->user()?->name ?? 'User' }}</p>
                    <p class="db-pemail">{{ auth()->user()?->email ?? '' }}</p>
                    <span class="db-pbadge">Member</span>
                </div>

                <nav class="db-nav" role="navigation" aria-label="Dashboard navigation">
                    <button class="db-navitem active" onclick="switchTab('overview', this)">
                        <span class="nav-ic material-symbols-outlined">grid_view</span> Overview
                    </button>
                    <button class="db-navitem" onclick="switchTab('posts', this)">
                        <span class="nav-ic material-symbols-outlined">article</span> My Posts
                    </button>
                    <button class="db-navitem" onclick="switchTab('create', this)">
                        <span class="nav-ic material-symbols-outlined">edit</span> New Post
                    </button>
                    <button class="db-navitem" onclick="switchTab('settings', this)">
                        <span class="nav-ic material-symbols-outlined">manage_accounts</span> Account
                    </button>
                    <div class="db-nav-divider"></div>
                    <form action="/logout" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="db-navitem danger" style="width:100%">
                            <span class="nav-ic material-symbols-outlined">logout</span> Log out
                        </button>
                    </form>
                </nav>
            </aside>

            {{-- MAIN --}}
            <main class="db-main">

                {{-- OVERVIEW TAB --}}
                <div id="tab-overview" class="db-section visible">
                    <div class="panel">
                        <div class="panel-hd">
                            <span class="panel-htitle">
                                <span class="material-symbols-outlined">insights</span> Overview
                            </span>
                        </div>
                        <div class="panel-bd">
                            <div class="stats-grid">
                                <div class="stat-card">
                                    <p class="stat-lbl">Posts</p>
                                    <p class="stat-val">{{ isset($posts) ? count($posts) : 0 }}</p>
                                    <p class="stat-sub">published</p>
                                </div>
                                <div class="stat-card">
                                    <p class="stat-lbl">Member since</p>
                                    <p class="stat-val" style="font-size:1rem;padding-top:6px">
                                        {{ auth()->user()?->created_at?->format('M Y') ?? '—' }}
                                    </p>
                                    <p class="stat-sub">joined</p>
                                </div>
                                <div class="stat-card">
                                    <p class="stat-lbl">Subjects</p>
                                    <p class="stat-val">4</p>
                                    <p class="stat-sub">available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-hd">
                            <span class="panel-htitle">
                                <span class="material-symbols-outlined">article</span> Recent posts
                            </span>
                            <span class="panel-badge">{{ isset($posts) ? count($posts) : 0 }}</span>
                        </div>
                        @if (isset($posts) && count($posts) > 0)
                            <div class="post-list">
                                @foreach ($posts->take(5) as $post)
                                    <div class="post-row">
                                        <div class="post-info">
                                            <p class="post-title">{{ $post->title }}</p>
                                            <p class="post-preview">{{ Str::limit($post->body, 80) }}</p>
                                            <p class="post-meta">{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</p>
                                        </div>
                                        <div class="post-acts">
                                            <a href="/edit-post/{{ $post->id }}" class="btn-ic" title="Edit">
                                                <span class="material-symbols-outlined" style="font-size:14px">edit</span>
                                            </a>
                                            <form action="/delete-post/{{ $post->id }}" method="POST" style="margin:0">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-ic del" title="Delete">
                                                    <span class="material-symbols-outlined" style="font-size:14px">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <span class="material-symbols-outlined">article</span>
                                <p>No posts yet. Write your first one.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- POSTS TAB --}}
                <div id="tab-posts" class="db-section">
                    <div class="panel">
                        <div class="panel-hd">
                            <span class="panel-htitle">
                                <span class="material-symbols-outlined">article</span> All posts
                            </span>
                            <span class="panel-badge">{{ isset($posts) ? count($posts) : 0 }}</span>
                        </div>
                        @if (isset($posts) && count($posts) > 0)
                            <div class="post-list">
                                @foreach ($posts as $post)
                                    <div class="post-row">
                                        <div class="post-info">
                                            <p class="post-title">{{ $post->title }}</p>
                                            <p class="post-preview">{{ Str::limit($post->body, 100) }}</p>
                                            <p class="post-meta">{{ $post->created_at ? $post->created_at->diffForHumans() : '' }}</p>
                                        </div>
                                        <div class="post-acts">
                                            <a href="/edit-post/{{ $post->id }}" class="btn-ic" title="Edit">
                                                <span class="material-symbols-outlined" style="font-size:14px">edit</span>
                                            </a>
                                            <form action="/delete-post/{{ $post->id }}" method="POST" style="margin:0">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-ic del" title="Delete">
                                                    <span class="material-symbols-outlined" style="font-size:14px">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <span class="material-symbols-outlined">article</span>
                                <p>No posts yet.</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- CREATE POST TAB --}}
                <div id="tab-create" class="db-section">
                    <div class="panel">
                        <div class="panel-hd">
                            <span class="panel-htitle">
                                <span class="material-symbols-outlined">edit</span> New post
                            </span>
                        </div>
                        <div class="panel-bd">

                            @if ($errors->any())
                                <div class="alert-stem">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- CHANGED: added enctype for file upload --}}
                            <form action="/create-post" method="POST" class="form-stack" enctype="multipart/form-data">
                                @csrf
                                <div class="f-group">
                                    <label class="f-label" for="new-title">Title</label>
                                    <input id="new-title" type="text" name="title" class="stem-input"
                                        placeholder="Give your post a title" value="{{ old('title') }}">
                                    @error('title')<p class="error-msg">{{ $message }}</p>@enderror
                                </div>
                                <div class="f-group">
                                    <label class="f-label" for="new-body">Content</label>
                                    <textarea id="new-body" name="body" class="stem-input" rows="10"
                                        placeholder="Write something…">{{ old('body') }}</textarea>
                                    @error('body')<p class="error-msg">{{ $message }}</p>@enderror
                                </div>

                                {{-- ADDED: image upload --}}
                                <div class="f-group">
                                    <label class="f-label">Featured image <span style="text-transform:none;letter-spacing:0;font-size:10px">(optional)</span></label>
                                    <input type="file" name="featured_image" class="file-input" accept="image/png,image/jpeg,image/webp">
                                    @error('featured_image')<p class="error-msg">{{ $message }}</p>@enderror
                                </div>

                                <div class="form-footer-right">
                                    <button type="submit" class="btn-stem">Publish post →</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ACCOUNT TAB --}}
                <div id="tab-settings" class="db-section">
                    <div class="panel">
                        <div class="panel-hd">
                            <span class="panel-htitle">
                                <span class="material-symbols-outlined">manage_accounts</span> Account details
                            </span>
                        </div>
                        <div class="srow"><span class="skey">Username</span><span class="sval">{{ auth()->user()?->name ?? '—' }}</span><a href="#" class="sedit">Edit</a></div>
                        <div class="srow"><span class="skey">Email</span><span class="sval">{{ auth()->user()?->email ?? '—' }}</span><a href="#" class="sedit">Edit</a></div>
                        <div class="srow"><span class="skey">Password</span><span class="sval" style="color:#d1d5db">••••••••</span><a href="#" class="sedit">Change</a></div>
                        <div class="srow"><span class="skey">Joined</span><span class="sval">{{ auth()->user()?->created_at?->format('d M Y') ?? '—' }}</span><span></span></div>
                    </div>

                    <div class="panel" style="border-color:#fecaca">
                        <div class="panel-hd" style="border-bottom-color:#fecaca">
                            <span class="panel-htitle" style="color:#b91c1c">
                                <span class="material-symbols-outlined" style="color:#b91c1c;font-size:16px">warning</span>
                                Danger zone
                            </span>
                        </div>
                        <div class="panel-bd">
                            <div class="danger-zone-body">
                                <div>
                                    <p style="font-size:13.5px;font-weight:500;color:#0f1117;margin-bottom:3px">Log out of all devices</p>
                                    <p style="font-size:12px;color:#9ca3af">End all active sessions for your account.</p>
                                </div>
                                <form action="/logout" method="POST" style="margin:0">
                                    @csrf
                                    <button type="submit" class="btn-danger">Log out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function switchTab(name, el) {
            document.querySelectorAll('.db-section').forEach(s => s.classList.remove('visible'));
            document.querySelectorAll('.db-navitem').forEach(b => b.classList.remove('active'));
            document.getElementById('tab-' + name).classList.add('visible');
            el.classList.add('active');
        }
    </script>

@endsection