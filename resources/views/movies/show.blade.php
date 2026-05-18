<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">{{ $movie->title }}</div>
            <div class="topbar-sub">{{ $movie->genre }}</div>
        </div>
        @auth
        <div style="display:flex;gap:8px">
            <a href="{{ route('movies.edit',$movie) }}" class="btn-ghost">Edit</a>
            <form action="{{ route('movies.destroy',$movie) }}" method="POST"
                  onsubmit="return confirm('Hapus film ini?')">
                @csrf @method('DELETE')
                <button type="submit" style="background:rgba(226,75,74,0.2);color:#F09595;border:0.5px solid rgba(226,75,74,0.35);border-radius:8px;padding:8px 16px;font-size:13px;cursor:pointer">
                    Hapus
                </button>
            </form>
        </div>
        @endauth
    </x-slot>

    <div style="max-width:600px">
        <div style="background:rgba(240,255,255,0.05);border:0.5px solid rgba(135,206,235,0.15);border-radius:14px;padding:24px">

            <div style="display:flex;gap:12px;align-items:center;margin-bottom:20px">
                <span style="font-size:10px;padding:4px 12px;border-radius:99px;font-weight:500;
                    @if($movie->status==='completed') background:linear-gradient(135deg,#6495ED,#87CEEB);color:#00008B
                    @elseif($movie->status==='watching') background:linear-gradient(135deg,#6809CE,#6495ED);color:#F0FFFF
                    @else background:rgba(135,206,235,0.12);color:#87CEEB;border:0.5px solid rgba(135,206,235,0.3) @endif">
                    {{ $movie->status }}
                </span>
                @if($movie->rating)
                <span style="font-size:13px;color:#87CEEB">★ {{ $movie->rating }}/10</span>
                @endif
            </div>

            <div style="display:grid;gap:14px">
                <div style="border-bottom:0.5px solid rgba(135,206,235,0.1);padding-bottom:14px">
                    <div style="font-size:11px;color:rgba(240,255,255,0.35);margin-bottom:4px">Genre</div>
                    <div style="font-size:14px;color:#F0FFFF">{{ $movie->genre }}</div>
                </div>

                @if($movie->description)
                <div>
                    <div style="font-size:11px;color:rgba(240,255,255,0.35);margin-bottom:6px">Deskripsi</div>
                    <div style="font-size:14px;color:rgba(240,255,255,0.8);line-height:1.7">{{ $movie->description }}</div>
                </div>
                @endif

                <div style="border-top:0.5px solid rgba(135,206,235,0.1);padding-top:14px">
                    <div style="font-size:11px;color:rgba(240,255,255,0.35)">Ditambahkan {{ $movie->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>

        <a href="{{ route('movies.index') }}" style="display:inline-block;margin-top:16px;font-size:13px;color:rgba(135,206,235,0.6);text-decoration:none">
            ← Kembali ke daftar
        </a>
    </div>
</x-app-layout>