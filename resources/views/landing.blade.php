<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Watchoria — Catat Film Kamu</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(160deg, #0a0a2e 0%, #1a0545 50%, #0d1a4a 100%);
            min-height: 100vh;
            color: #F0FFFF;
        }

        nav {
            display: flex; justify-content: space-between; align-items: center;
            padding: 18px 48px;
            border-bottom: 0.5px solid rgba(135,206,235,0.1);
        }
        .logo { font-size: 20px; font-weight: 700; color: #F0FFFF; }
        .logo span { color: #87CEEB; }
        .nav-actions { display: flex; gap: 10px; }

        .hero {
            display: flex; flex-direction: column; align-items: center;
            text-align: center;
            padding: 90px 24px 60px;
        }
        .badge {
            font-size: 11px; font-weight: 500; letter-spacing: .08em;
            padding: 5px 14px; border-radius: 99px;
            background: rgba(104,9,206,0.25);
            border: 0.5px solid rgba(104,9,206,0.5);
            color: #B39DDB;
            margin-bottom: 28px;
        }
        h1 {
            font-size: clamp(32px, 5vw, 56px);
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #F0FFFF 30%, #87CEEB 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sub {
            font-size: 16px; color: rgba(240,255,255,0.5);
            max-width: 460px; line-height: 1.7; margin-bottom: 36px;
        }
        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; }

        .btn-primary {
            background: linear-gradient(135deg,#6809CE,#6495ED);
            color: #F0FFFF; border: none; border-radius: 10px;
            padding: 11px 26px; font-size: 14px; font-weight: 500;
            cursor: pointer; text-decoration: none; display: inline-block;
            transition: opacity .15s;
        }
        .btn-primary:hover { opacity: .88; color: #F0FFFF; }
        .btn-ghost {
            background: rgba(240,255,255,0.06);
            color: #87CEEB; border: 0.5px solid rgba(135,206,235,0.3);
            border-radius: 10px; padding: 11px 26px;
            font-size: 14px; cursor: pointer;
            text-decoration: none; display: inline-block;
            transition: background .15s;
        }
        .btn-ghost:hover { background: rgba(240,255,255,0.1); color: #87CEEB; }

        .preview {
            display: flex; gap: 12px; justify-content: center;
            padding: 0 24px 80px; flex-wrap: wrap;
        }
        .preview-card {
            background: rgba(240,255,255,0.05);
            border: 0.5px solid rgba(135,206,235,0.15);
            border-radius: 12px; padding: 16px;
            width: 170px; text-align: left;
        }
        .preview-card-title { font-size: 13px; font-weight: 500; color: #F0FFFF; margin-bottom: 6px; }
        .preview-card-genre { font-size: 11px; color: rgba(240,255,255,0.35); margin-bottom: 10px; }
        .preview-card-badge { font-size: 10px; padding: 2px 8px; border-radius: 99px; font-weight: 500; }
        .badge-completed { background: linear-gradient(135deg,#6495ED,#87CEEB); color: #00008B; }
        .badge-watching  { background: linear-gradient(135deg,#6809CE,#6495ED); color: #F0FFFF; }

        .features {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 14px; max-width: 760px; margin: 0 auto 80px; padding: 0 24px;
        }
        .feature-card {
            background: rgba(240,255,255,0.04);
            border: 0.5px solid rgba(135,206,235,0.12);
            border-radius: 14px; padding: 20px;
        }
        .feature-title { font-size: 13px; font-weight: 600; color: #F0FFFF; margin-bottom: 6px; }
        .feature-desc { font-size: 12px; color: rgba(240,255,255,0.4); line-height: 1.6; }

        footer {
            text-align: center; padding: 24px;
            font-size: 12px; color: rgba(240,255,255,0.2);
            border-top: 0.5px solid rgba(135,206,235,0.08);
        }
    </style>
</head>
<body>

<nav>
    <div class="logo">Watch<span>oria</span></div>
    <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-ghost">Login</a>
        <a href="{{ route('register') }}" class="btn-primary">Daftar Gratis</a>
    </div>
</nav>

<section class="hero">
    <div class="badge">Watchlist Pribadi Kamu</div>
    <h1>Catat, Lacak, &<br>Nikmati Film Kamu</h1>
    <p class="sub">Simpan film yang ingin ditonton, yang sedang ditonton, dan yang sudah selesai — semua dalam satu tempat.</p>
    <div class="hero-actions">
        <a href="{{ route('register') }}" class="btn-primary">Mulai Sekarang</a>
        <a href="{{ route('movies.index') }}" class="btn-ghost">Lihat Film Publik</a>
    </div>
</section>

<div class="preview">
    @foreach([
        ['Sore: Istri dari Masa Depan','Romance','completed','badge-completed'],
        ['Dune: Part Two','Sci-Fi','watching','badge-watching'],
        ['Your Name','Animation','completed','badge-completed'],
        ['Interstellar','Sci-Fi','watching','badge-watching'],
        ['The Batman','Action','completed','badge-completed'],
    ] as [$title,$genre,$status,$cls])
    <div class="preview-card">
        <div class="preview-card-title">{{ $title }}</div>
        <div class="preview-card-genre">{{ $genre }}</div>
        <span class="preview-card-badge {{ $cls }}">{{ $status }}</span>
    </div>
    @endforeach
</div>

<div class="features">
    <div class="feature-card">
        <div class="feature-title">Watchlist Terorganisir</div>
        <div class="feature-desc">Kelompokkan film berdasarkan status: Want to Watch, Watching, atau Completed.</div>
    </div>
    <div class="feature-card">
        <div class="feature-title">Rating Pribadi</div>
        <div class="feature-desc">Beri rating 0–10 untuk setiap film yang sudah kamu tonton.</div>
    </div>
    <div class="feature-card">
        <div class="feature-title">Privasi Terjaga</div>
        <div class="feature-desc">Film "Want to Watch" hanya bisa dilihat oleh kamu sendiri.</div>
    </div>
</div>

<footer>© {{ date('Y') }} Watchoria</footer>

</body>
</html>