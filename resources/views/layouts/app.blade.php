<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Watchoria</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Figtree', sans-serif; background: linear-gradient(160deg, #0a0a2e 0%, #1a0545 50%, #0d1a4a 100%); min-height: 100vh; display: flex; }
        .sidebar { width: 220px; min-height: 100vh; background: rgba(0,0,80,0.6); border-right: 0.5px solid rgba(135,206,235,0.15); display: flex; flex-direction: column; flex-shrink: 0; }
        .logo { padding: 22px 18px 16px; font-size: 18px; font-weight: 600; color: #F0FFFF; }
        .logo span { color: #87CEEB; }
        .nav-section { padding: 12px 18px 4px; font-size: 10px; color: rgba(240,255,255,0.3); letter-spacing: .1em; text-transform: uppercase; margin-top: 6px; }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 9px 12px; font-size: 13px; color: rgba(240,255,255,0.55); border-radius: 8px; margin: 1px 8px; text-decoration: none; transition: .15s; }
        .nav-item:hover { background: rgba(100,149,237,0.15); color: #F0FFFF; }
        .nav-item.active { background: rgba(100,149,237,0.2); color: #87CEEB; }
        .nav-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
        .sidebar-bottom { margin-top: auto; padding: 16px 10px; }
        .user-chip { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; background: rgba(240,255,255,0.06); border: 0.5px solid rgba(135,206,235,0.15); }
        .user-avatar { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg,#6809CE,#6495ED); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 600; color: #F0FFFF; flex-shrink: 0; }
        .user-name { font-size: 12px; color: #F0FFFF; flex: 1; }
        .main-wrap { flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 24px; border-bottom: 0.5px solid rgba(135,206,235,0.1); }
        .topbar-title { font-size: 16px; font-weight: 600; color: #F0FFFF; }
        .topbar-sub { font-size: 12px; color: rgba(240,255,255,0.4); margin-top: 2px; }
        .btn-primary { background: linear-gradient(135deg,#6809CE,#6495ED); color: #F0FFFF; border: none; border-radius: 8px; padding: 8px 16px; font-size: 13px; font-weight: 500; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-primary:hover { opacity: .9; color: #F0FFFF; }
        .btn-ghost { background: rgba(240,255,255,0.06); color: #87CEEB; border: 0.5px solid rgba(135,206,235,0.3); border-radius: 8px; padding: 8px 16px; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-ghost:hover { background: rgba(240,255,255,0.1); color: #87CEEB; }
        .content { padding: 20px 24px; flex: 1; }
        .flash { margin-bottom: 16px; padding: 12px 16px; border-radius: 8px; font-size: 13px; color: #87CEEB; background: rgba(100,149,237,0.15); border: 0.5px solid rgba(100,149,237,0.35); }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">Watch<span>oria</span></div>

    <div class="nav-section">Menu</div>
    <a href="{{ route('movies.index') }}" class="nav-item {{ request()->routeIs('movies.index') ? 'active' : '' }}">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
        Semua Film
    </a>
    @auth
    <a href="{{ route('movies.create') }}" class="nav-item {{ request()->routeIs('movies.create') ? 'active' : '' }}">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        Tambah Film
    </a>
    @endauth

    <div class="nav-section">Filter Status</div>
    <a href="{{ route('movies.index', ['status' => 'completed']) }}" class="nav-item">
        <div class="nav-dot" style="background:linear-gradient(135deg,#6495ED,#87CEEB)"></div>
        Completed
    </a>
    <a href="{{ route('movies.index', ['status' => 'watching']) }}" class="nav-item">
        <div class="nav-dot" style="background:linear-gradient(135deg,#6809CE,#6495ED)"></div>
        Watching
    </a>
    <a href="{{ route('movies.index', ['status' => 'want to watch']) }}" class="nav-item">
        <div class="nav-dot" style="background:rgba(135,206,235,0.4)"></div>
        Want to watch
    </a>

    <div class="sidebar-bottom">
        @auth
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:rgba(135,206,235,0.5);font-size:12px;cursor:pointer">↩</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-ghost" style="width:100%;text-align:center;margin-bottom:8px;display:block">Login</a>
            <a href="{{ route('register') }}" class="btn-primary" style="width:100%;text-align:center;display:block">Register</a>
        @endauth
    </div>
</aside>

<div class="main-wrap">
    @if (isset($header))
        <div class="topbar">
            {{ $header }}
        </div>
    @endif

    <div class="content">
        @if(session('success'))
            <div class="flash">✓ {{ session('success') }}</div>
        @endif
        {{ $slot }}
    </div>
</div>

</body>
</html>