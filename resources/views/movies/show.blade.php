<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">{{ $movie->title }}</div>
            <div class="topbar-sub">{{ $movie->genre }}</div>
        </div>
        @auth
        <div style="display:flex;gap:8px">
            <button onclick="openEditModal()" class="btn-ghost">Edit</button>
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
                <span style="font-size:13px;color:#87CEEB">{{ $movie->rating }}/10</span>
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
            Kembali ke daftar
        </a>
    </div>

    {{-- Modal Edit --}}
    @auth
    <div id="editModal" onclick="if(event.target===this)closeEditModal()"
         style="display:none;position:fixed;inset:0;z-index:999;
                background:rgba(5,0,30,0.75);backdrop-filter:blur(6px);
                align-items:center;justify-content:center;padding:16px">
        <div style="background:linear-gradient(160deg,#0e0e35,#160840);
                    border:0.5px solid rgba(135,206,235,0.2);border-radius:16px;
                    padding:20px;width:100%;max-width:400px;
                    max-height:90vh;overflow-y:auto;position:relative">

            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px">
                <div>
                    <div style="font-size:14px;font-weight:600;color:#F0FFFF">Edit Film</div>
                    <div style="font-size:11px;color:rgba(240,255,255,0.35);margin-top:1px">{{ $movie->title }}</div>
                </div>
                <button onclick="closeEditModal()"
                        style="background:rgba(240,255,255,0.06);border:0.5px solid rgba(135,206,235,0.2);
                               border-radius:8px;width:28px;height:28px;color:rgba(240,255,255,0.5);
                               font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;
                               flex-shrink:0">
                    X
                </button>
            </div>

            <form action="{{ route('movies.update',$movie) }}" method="POST" style="display:grid;gap:12px">
                @csrf @method('PUT')
                @include('movies._form')
                <div style="display:flex;gap:8px;padding-top:2px">
                    <button type="submit" class="btn-primary" style="flex:1;font-size:13px;padding:8px 12px">Update Film</button>
                    <button type="button" onclick="closeEditModal()" class="btn-ghost" style="font-size:13px;padding:8px 12px">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', e => { if(e.key === 'Escape') closeEditModal(); });

        @if($errors->any())
            openEditModal();
        @endif
    </script>
    @endauth

</x-app-layout>