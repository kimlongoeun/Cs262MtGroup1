@extends('layout')
@section('title', 'STEM Cambodia - Welcome')
@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Geist+Mono:wght@400;500&family=Instrument+Sans:wght@400;500;600&display=swap');

        .auth-root {
            min-height: calc(100vh - var(--nav-h));
            background: #ffffff;
            color: #0f1117;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .grid-bg {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(0, 0, 0, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .radial-glow {
            position: absolute;
            top: -160px;
            left: 50%;
            transform: translateX(-50%);
            width: 700px;
            height: 400px;
            background: radial-gradient(ellipse at 50% 0%, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            pointer-events: none;
        }

        .page-body {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4rem 1.5rem;
            position: relative;
            z-index: 5;
        }

        .auth-container {
            width: 100%;
            max-width: 880px;
        }

        .auth-eyebrow {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .eyebrow-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 100px;
            padding: 4px 14px;
            font-family: 'Geist Mono', monospace;
            font-size: 11px;
            color: #2563eb;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .eyebrow-badge::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #3b82f6;
        }

        .auth-headline {
            font-size: 28px;
            font-weight: 600;
            color: #0f1117;
            letter-spacing: -0.02em;
            line-height: 1.3;
            margin-bottom: 6px;
        }

        .auth-headline span {
            color: #2563eb;
        }

        .auth-subline {
            font-size: 14px;
            color: #6b7280;
        }

        .auth-panels {
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06), 0 1px 4px rgba(0, 0, 0, 0.04);
        }

        .divider-col {
            background: #e5e7eb;
            position: relative;
        }

        .divider-col::after {
            content: 'or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            color: #9ca3af;
            font-size: 11px;
            font-family: 'Geist Mono', monospace;
            padding: 8px 0;
            white-space: nowrap;
            writing-mode: vertical-lr;
        }

        .auth-panel {
            padding: 2.25rem 2.5rem;
        }

        .panel-label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.25rem;
        }

        .panel-label-text {
            font-family: 'Geist Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #9ca3af;
            white-space: nowrap;
        }

        .panel-label-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .panel-title {
            font-size: 17px;
            font-weight: 600;
            color: #0f1117;
            margin-bottom: 4px;
            letter-spacing: -0.01em;
        }

        .panel-sub {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 1.5rem;
            line-height: 1.55;
        }

        .panel-features {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #374151;
        }

        .feature-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .feature-dot svg {
            width: 10px;
            height: 10px;
            stroke: #2563eb;
            fill: none;
            stroke-width: 2.5;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .alert-stem {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 12px;
            color: #b91c1c;
            margin-bottom: 14px;
        }

        .alert-stem ul {
            margin: 0;
            padding-left: 1rem;
        }

        .form-stack {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .input-label {
            font-size: 12px;
            font-weight: 500;
            color: #374151;
            letter-spacing: 0.01em;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stem-input {
            width: 100%;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 13px;
            font-size: 13px;
            color: #0f1117;
            font-family: 'Instrument Sans', sans-serif;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
            box-sizing: border-box;
        }

        .stem-input::placeholder {
            color: #d1d5db;
        }

        .stem-input:focus {
            background: #fff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .btn-stem {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: opacity 0.15s, transform 0.1s;
            font-family: 'Instrument Sans', sans-serif;
            margin-top: 6px;
            letter-spacing: 0.01em;
            background: #2563eb;
            color: #fff;
        }

        .btn-stem:hover {
            opacity: 0.88;
        }

        .btn-stem:active {
            transform: scale(0.99);
        }

        .btn-stem-ghost {
            width: 100%;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            transition: background 0.15s, border-color 0.15s, transform 0.1s;
            font-family: 'Instrument Sans', sans-serif;
            margin-top: 6px;
            letter-spacing: 0.01em;
            background: #fff;
            color: #0f1117;
        }

        .btn-stem-ghost:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .btn-stem-ghost:active {
            transform: scale(0.99);
        }

        .sso-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 1.25rem 0;
        }

        .sso-divider-line {
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .sso-divider-text {
            font-size: 11px;
            color: #9ca3af;
            font-family: 'Geist Mono', monospace;
        }

        .sso-row {
            display: flex;
            gap: 8px;
        }

        .btn-sso {
            flex: 1;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #374151;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: background 0.15s, border-color 0.15s;
        }

        .btn-sso:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .forgot-link {
            font-size: 11px;
            color: #2563eb;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .form-footer {
            margin-top: 14px;
            font-size: 12px;
            color: #9ca3af;
            text-align: center;
        }

        .form-footer a {
            color: #2563eb;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .auth-panels {
                grid-template-columns: 1fr;
            }

            .divider-col {
                display: none;
            }

            .auth-panel {
                padding: 1.75rem 1.5rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .sso-row {
                flex-direction: column;
            }
        }
    </style>

    <div class="auth-root">
        <div class="grid-bg"></div>
        <div class="radial-glow"></div>

        <div class="page-body">
            <div class="auth-container">

                <div class="auth-eyebrow">
                    <div class="eyebrow-badge">STEM Cambodia Platform</div>
                    <div class="auth-headline">Your gateway to <span>science &amp; tech</span> in Cambodia</div>
                    <div class="auth-subline">Join thousands of students and educators building Cambodia's future.</div>
                </div>

                @auth
                    <div
                        style="max-width:400px; margin: 0 auto; background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:2rem; text-align:center; box-shadow:0 4px 24px rgba(0,0,0,0.06);">
                        <p style="font-size:14px; color:#6b7280; margin-bottom:1.25rem;">You are currently logged in.</p>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn-stem-ghost" style="max-width:160px; margin:0 auto;">Log out</button>
                        </form>
                    </div>
                @else
                    <div class="auth-panels">

                        {{-- SIGN UP --}}
                        <div class="auth-panel">
                            <div class="panel-label">
                                <span class="panel-label-text">New here</span>
                                <div class="panel-label-line"></div>
                            </div>
                            <div class="panel-title">Create an account</div>
                            <div class="panel-sub">Start your STEM journey today — it's free.</div>



                            @if ($errors->any())
                                <div class="alert-stem">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="/register" method="POST" class="form-stack">
                                @csrf
                                <div class="input-group">
                                    <label class="input-label">Username</label>
                                    <input type="text" name="name" class="stem-input" placeholder="your_username"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="input-group">
                                    <label class="input-label">Email address</label>
                                    <input type="email" name="email" class="stem-input" placeholder="you@example.com"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="form-row">
                                    <div class="input-group">
                                        <label class="input-label">Password</label>
                                        <input type="password" name="password" class="stem-input" placeholder="••••••••">
                                    </div>
                                    <div class="input-group">
                                        <label class="input-label">Confirm</label>
                                        <input type="password" name="password_confirmation" class="stem-input"
                                            placeholder="••••••••">
                                    </div>
                                </div>
                                <button type="submit" class="btn-stem">Create account →</button>
                            </form>
                            <div class="form-footer">By signing up you agree to our <a href="#">Terms of Service</a></div>
                        </div>

                        <div class="divider-col"></div>

                        {{-- LOG IN --}}
                        <div class="auth-panel">
                            <div class="panel-label">
                                <span class="panel-label-text">Returning</span>
                                <div class="panel-label-line"></div>
                            </div>
                            <div class="panel-title">Welcome back</div>
                            <div class="panel-sub">Log in to your dashboard and continue learning.</div>

                            @if ($errors->has('loginname'))
                                <div class="alert-stem">{{ $errors->first('loginname') }}</div>
                            @endif

                            <form action="/login" method="POST" class="form-stack">
                                @csrf
                                <div class="input-group">
                                    <label class="input-label">Username</label>
                                    <input type="text" name="loginname" class="stem-input" placeholder="your_username"
                                        value="{{ old('loginname') }}">
                                </div>
                                <div class="input-group">
                                    <div class="label-row">
                                        <label class="input-label">Password</label>
                                        <a href="#" class="forgot-link">Forgot password?</a>
                                    </div>
                                    <input type="password" name="loginpassword" class="stem-input" placeholder="••••••••">
                                </div>
                                <button type="submit" class="btn-stem-ghost">Log in →</button>
                            </form>

                            <div class="sso-divider">
                                <div class="sso-divider-line"></div>
                                <span class="sso-divider-text">or continue with</span>
                                <div class="sso-divider-line"></div>
                            </div>

                            <div class="sso-row">
                                <button class="btn-sso">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#374151"
                                        stroke-width="2">
                                        <path
                                            d="M15 22v-4a4.8 4.8 0 0 0-1-3.2c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65-.17.6-.22 1.23-.15 1.85v4" />
                                        <path d="M9 18c-4.51 2-5-2-7-2" />
                                    </svg>
                                    GitHub
                                </button>
                                <button class="btn-sso">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                            fill="#4285F4" />
                                        <path
                                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                            fill="#34A853" />
                                        <path
                                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                            fill="#FBBC05" />
                                        <path
                                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                            fill="#EA4335" />
                                    </svg>
                                    Google
                                </button>
                            </div>

                            <div class="form-footer" style="margin-top:16px;">Don't have an account? <a href="#">Sign
                                    up free</a></div>
                        </div>

                    </div>
                @endauth

            </div>
        </div>
    </div>

@endsection
