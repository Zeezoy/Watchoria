<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">Semua Film</div>
            <div class="topbar-sub">{{ $movies->count() }} judul tersimpan</div>
        </div>
        @auth
            <a href="{{ route('movies.create') }}" class="btn-primary">+ Tambah Film</a>
        @endauth
    </x-slot>

    {{-- Stats --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:20px">
        @foreach(['completed'=>'Completed','watching'=>'Watching','want to watch'=>'Want to watch'] as $key=>$label)
        <div style="background:rgba(240,255,255,0.06);border:0.5px solid rgba(135,206,235,0.15);border-radius:12px;padding:14px 16px">
            <div style="font-size:24px;font-weight:600;color:#F0FFFF">{{ $movies->where('status',$key)->count() }}</div>
            <div style="font-size:12px;color:rgba(135,206,235,0.6);margin-top:3px">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filter chips --}}
    <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
        @foreach([null=>'Semua','completed'=>'Completed','watching'=>'Watching','want to watch'=>'Want to watch'] as $val=>$label)
        <a href="{{ route('movies.index', $val ? ['status'=>$val] : []) }}"
           style="font-size:12px;padding:5px 14px;border-radius:99px;text-decoration:none;
           {{ request('status')===$val || (request('status')===null && $val===0)
               ? 'background:linear-gradient(135deg,#6809CE,#6495ED);color:#F0FFFF;border:none'
               : 'background:rgba(240,255,255,0.05);color:rgba(240,255,255,0.5);border:0.5px solid rgba(135,206,235,0.25)' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    {{-- Grid --}}
    @if($movies->isEmpty())
        <div style="text-align:center;padding:60px 0;color:rgba(240,255,255,0.3);font-size:14px">
            Belum ada film. Mulai tambahkan!
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px">
            @foreach($movies as $movie)
            <a href="{{ route('movies.show',$movie) }}"
               style="display:block;background:rgba(240,255,255,0.05);border:0.5px solid rgba(135,206,235,0.15);border-radius:12px;padding:14px;text-decoration:none;transition:.15s"
               onmouseover="this.style.background='rgba(240,255,255,0.09)';this.style.borderColor='rgba(135,206,235,0.4)'"
               onmouseout="this.style.background='rgba(240,255,255,0.05)';this.style.borderColor='rgba(135,206,235,0.15)'">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:8px;margin-bottom:10px">
                    <span style="font-size:13px;font-weight:500;color:#F0FFFF;line-height:1.35">{{ $movie->title }}</span>
                    <span style="font-size:10px;padding:2px 8px;border-radius:99px;font-weight:500;white-space:nowrap;flex-shrink:0;
                        @if($movie->status==='completed') background:linear-gradient(135deg,#6495ED,#87CEEB);color:#00008B
                        @elseif($movie->status==='watching') background:linear-gradient(135deg,#6809CE,#6495ED);color:#F0FFFF
                        @else background:rgba(135,206,235,0.12);color:#87CEEB;border:0.5px solid rgba(135,206,235,0.3) @endif">
                        {{ $movie->status }}
                    </span>
                </div>
                <div style="font-size:11px;color:rgba(240,255,255,0.38)">{{ $movie->genre }}</div>
                @if($movie->rating)
                <div style="font-size:12px;color:#87CEEB;margin-top:8px">★ {{ $movie->rating }}/10</div>
                @endif
            </a>
            @endforeach
        </div>
    @endif
</x-app-layout>
