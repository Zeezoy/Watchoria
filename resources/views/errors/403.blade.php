<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak — Watchoria</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(160deg, #0a0a2e 0%, #1a0545 50%, #0d1a4a 100%);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
            color: #F0FFFF;
        }
        .card {
            background: rgba(240,255,255,0.05);
            border: 0.5px solid rgba(135,206,235,0.15);
            border-radius: 18px; padding: 40px 48px;
            text-align: center; max-width: 420px; width: 100%;
        }
        .code { font-size: 56px; font-weight: 700; color: rgba(135,206,235,0.2); margin-bottom: 12px; }
        .title { font-size: 18px; font-weight: 600; color: #F0FFFF; margin-bottom: 8px; }
        .desc { font-size: 13px; color: rgba(240,255,255,0.4); line-height: 1.7; margin-bottom: 28px; }
        .btn {
            background: linear-gradient(135deg,#6809CE,#6495ED);
            color: #F0FFFF; border: none; border-radius: 8px;
            padding: 10px 24px; font-size: 13px; font-weight: 500;
            cursor: pointer; text-decoration: none; display: inline-block;
        }
        .btn:hover { opacity: .88; color: #F0FFFF; }
    </style>
</head>
<body>
    <div class="card">
        <div class="code">403</div>
        <div class="title">Akses Ditolak</div>
        <div class="desc">Film ini bersifat privat dan hanya bisa dilihat oleh pemiliknya.</div>
        <a href="{{ url('/movies') }}" class="btn">Kembali ke Daftar Film</a>
    </div>
</body>
</html>