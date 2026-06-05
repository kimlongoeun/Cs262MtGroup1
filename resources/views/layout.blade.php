<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title', 'STEMBODIAN')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=DM+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg: #ffffff;
            --bg-soft: #f7f8f9;
            --bg-rule: #f0f1f3;
            --border: #e4e6ea;
            --border-md: #d0d3d9;
            --text: #0f1117;
            --text-2: #525866;
            --text-3: #9098a3;
            --blue: #1a56db;
            --blue-lt: #eff4ff;
            --green: #0a7c52;
            --green-lt: #ecfdf5;
            --amber: #b45309;
            --amber-lt: #fffbeb;
            --purple: #6d28d9;
            --purple-lt: #f5f3ff;
            --nav-h: 60px;
            --max-w: 1120px;
            --font: 'DM Sans', sans-serif;
            --mono: 'DM Mono', monospace;
            --r: 6px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: var(--bg);
            color: var(--text);

            font-size: 15px;
            line-height: 1.65;
            min-height: 100vh;
            padding-top: var(--nav-h);
            -webkit-font-smoothing: antialiased;
            font-family: Georgia, 'Times New Roman', serif;
        }

        /* ── NAV ── */
        nav.site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-h);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1000;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 32px;
            height: 32px;
            background: var(--blue);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-logo-icon img {
            width: 20px;
            height: 20px;
            filter: brightness(0) invert(1);
            object-fit: contain;
        }

        .nav-logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .nav-logo-text .t1 {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            letter-spacing: 0.04em;
        }

        .nav-logo-text .t2 {
            font-size: 10px;
            color: var(--text-3);
            letter-spacing: 0.06em;
            font-weight: 400;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .nav-link {
            font-size: 13.5px;
            font-weight: 400;
            color: var(--text-2);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: var(--r);
            transition: color .15s, background .15s;
        }

        .nav-link:hover {
            color: var(--text);
            background: var(--bg-soft);
        }

        .nav-link.active {
            color: var(--blue);
            font-weight: 500;
        }

        .nav-btn {
            font-size: 13px;
            font-weight: 500;
            color: #fff;
            background: var(--blue);
            text-decoration: none;
            padding: 7px 16px;
            border-radius: var(--r);
            margin-left: 6px;
            transition: opacity .15s;
        }

        .nav-btn:hover {
            opacity: .85;
            color: #fff;
        }

        /* ── FLASH ── */
        .flash-msg {
            background: var(--blue-lt);
            border-bottom: 1px solid #bfcfef;
            color: var(--blue);
            font-size: 13px;
            font-family: var(--mono);
            padding: .6rem 2rem;
            text-align: center;
        }

        /* ── FOOTER ── */
        footer.site-footer {
            background: var(--bg-soft);
            border-top: 1px solid var(--border);
            padding: 3rem 2rem 1.75rem;
        }

        .footer-inner {
            max-width: var(--max-w);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr;
            gap: 3rem;
        }

        .footer-brand-name {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
            letter-spacing: 0.04em;
            margin-bottom: 8px;
        }

        .footer-brand p {
            font-size: 13px;
            color: var(--text-3);
            line-height: 1.7;
            max-width: 240px;
        }

        .footer-col h4 {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-3);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .footer-col a {
            display: block;
            font-size: 13px;
            color: var(--text-2);
            text-decoration: none;
            padding: 3px 0;
            transition: color .15s;
        }

        .footer-col a:hover {
            color: var(--text);
        }

        .footer-bottom {
            max-width: var(--max-w);
            margin: 2rem auto 0;
            padding-top: 1.25rem;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: var(--text-3);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--green);
            background: var(--green-lt);
            padding: 3px 10px;
            border-radius: 100px;
        }

        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--green);
        }
    </style>
</head>

<body>

    <nav class="site-nav">
        <a href="{{ url('') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <img src="{{ asset('img/logosteam.png') }}" alt="STEM Cambodia">
            </div>
            <div class="nav-logo-text">
                <span class="t1">STEMBODIAN</span>
                <span class="t2">Cambodia</span>
            </div>
        </a>

        <div class="nav-links">
            <a class="nav-link active" href="{{ url('') }}">Home</a>
            <a class="nav-link" href="/news">News</a>
            <a class="nav-link" href="/signup">Sign up</a>
            <a class="nav-btn" href="/dashboard">Dashboard</a>
        </div>
    </nav>

    @if (session('message'))
        <div class="flash-msg">{{ session('message') }}</div>
    @endif

    @yield('content')

    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <div class="footer-brand-name">STEMBODIAN</div>
                <p>Advancing Cambodia's future through science, technology, engineering, and mathematics education.</p>
            </div>
            <div class="footer-col">
                <h4>Navigate</h4>
                <a href="/">Home</a>
                <a href="/news">News & events</a>
                <a href="/bookmarks">Bookmarks</a>
            </div>
            <div class="footer-col">
                <h4>Subjects</h4>
                <a href="/science">Science</a>
                <a href="/technology">Technology</a>
                <a href="/engineering">Engineering</a>
                <a href="/mathematics">Mathematics</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2025 STEMBODIAN — STEM Cambodia</span>
            <span class="status-pill">All systems operational</span>
        </div>
    </footer>

</body>

</html>
