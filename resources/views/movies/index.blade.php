<style>

.edit-btn,
.delete-btn{
    flex:1;
    border:none;
    border-radius:12px;
    padding:10px;
    font-size:12px;
    cursor:pointer;
    transition:.2s;
}

.edit-btn{
    background:linear-gradient(135deg,#7B2FF7,#9F44FF);
    color:white;
}

.edit-btn:hover{
    transform:translateY(-2px);
}

.delete-btn{
    background:rgba(255,80,80,0.12);
    color:#FFB4B4;
    border:1px solid rgba(255,80,80,0.2);
}

.delete-btn:hover{
    background:rgba(255,80,80,0.22);
}

</style>

<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">Semua Film</div>
            <div class="topbar-sub">{{ $movies->count() }} judul tersimpan</div>
        </div>
        @auth
            <button onclick="openModal()" class="btn-primary">+ Tambah Film</button>
        @endauth
    </x-slot>

    {{-- Stats --}}
    <div style="display:grid;grid-template-columns:repeat({{ auth()->check() ? 3 : 2 }},1fr);gap:10px;margin-bottom:20px">
        @foreach(['completed'=>'Completed','watching'=>'Watching','want to watch'=>'Want to watch'] as $key=>$label)
        @guest @if($key === 'want to watch') @continue @endif @endguest
        <div style="background:rgba(240,255,255,0.06);border:0.5px solid rgba(135,206,235,0.15);border-radius:12px;padding:14px 16px">
            <div style="font-size:24px;font-weight:600;color:#F0FFFF">{{ $movies->where('status',$key)->count() }}</div>
            <div style="font-size:12px;color:rgba(135,206,235,0.6);margin-top:3px">{{ $label }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filter chips --}}
    <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
        @foreach([null=>'Semua','completed'=>'Completed','watching'=>'Watching','want to watch'=>'Want to watch'] as $val=>$label)
        @guest @if($val === 'want to watch') @continue @endif @endguest
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
           <div
            data-title="{{ $movie->title }}"
            data-genre="{{ $movie->genre }}"
            data-status="{{ $movie->status }}"
            data-rating="{{ $movie->rating }}"
            data-description="{{ $movie->description }}"
            style="background:rgba(240,255,255,0.05);
            border:0.5px solid rgba(135,206,235,0.15);
            border-radius:16px;
            padding:14px;
            transition:.2s">

    <div style="display:flex;
                justify-content:space-between;
                align-items:flex-start;
                gap:8px;
                margin-bottom:10px">

        <span style="font-size:13px;
                     font-weight:600;
                     color:#F0FFFF;
                     line-height:1.35">
            {{ $movie->title }}
        </span>

        <span style="
            font-size:10px;
            padding:4px 8px;
            border-radius:99px;
            font-weight:500;
            white-space:nowrap;

            @if($movie->status==='completed')
                background:linear-gradient(135deg,#6495ED,#87CEEB);
                color:#00008B;
            @elseif($movie->status==='watching')
                background:linear-gradient(135deg,#6809CE,#6495ED);
                color:#F0FFFF;
            @else
                background:rgba(135,206,235,0.12);
                color:#87CEEB;
                border:0.5px solid rgba(135,206,235,0.3);
            @endif
        ">
            {{ $movie->status }}
        </span>
    </div>

    <div style="font-size:11px;
                color:rgba(240,255,255,0.38)">
        {{ $movie->genre }}
    </div>

    @if($movie->rating)
    <div style="font-size:12px;
                color:#87CEEB;
                margin-top:8px">
        ★ {{ $movie->rating }}/10
    </div>
    @endif

    {{-- ACTION BUTTON --}}
    @auth
    <div style="display:flex;gap:8px;margin-top:14px">

        <button
            class="edit-btn"
            onclick="openEditModal(this, {{$movie->id }})">
            Edit
        </button>

        <form action="{{ route('movies.destroy',$movie) }}"
              method="POST"
              style="flex:1"
              onsubmit="return confirm('Hapus film ini?')">

            @csrf
            @method('DELETE')

            <button type="submit" class="delete-btn">
                Hapus
            </button>
        </form>

        </div>
        @endauth

    </div>
            @endforeach
        </div>
    @endif

    {{-- ===== MODAL TAMBAH FILM ===== --}}
    @auth
    <div id="movieModal" onclick="if(event.target===this)closeModal()"
         style="display:none;position:fixed;inset:0;z-index:999;
                background:rgba(5,0,30,0.75);backdrop-filter:blur(6px);
                align-items:center;justify-content:center;padding:20px">
        <div style="background:linear-gradient(160deg,#0e0e35,#160840);
                    border:0.5px solid rgba(135,206,235,0.2);border-radius:18px;
                    padding:22px;width:100%;max-width:400px;position:relative">

            {{-- Header modal --}}
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:22px">
                <div>
                    <div style="font-size:15px;font-weight:600;color:#F0FFFF">Tambah Film</div>
                    <div style="font-size:11px;color:rgba(240,255,255,0.35);margin-top:2px">Isi detail film baru</div>
                </div>
                <button onclick="closeModal()"
                        style="background:rgba(240,255,255,0.06);border:0.5px solid rgba(135,206,235,0.2);
                               border-radius:8px;width:32px;height:32px;color:rgba(240,255,255,0.5);
                               font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center">
                    ✕
                </button>
            </div>

            {{-- Form --}}
            <form action="{{ route('movies.store') }}" method="POST" style="display:grid;gap:14px">
                @csrf
                @include('movies._form')
                <div style="display:flex;gap:10px;padding-top:4px">
                    <button type="submit" class="btn-primary" style="flex:1">Simpan Film</button>
                    <button type="button" onclick="closeModal()" class="btn-ghost">Batal</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== EDIT MODAL ===== --}}
<div id="editModal"
     style="
        display:none;
        position:fixed;
        inset:0;
        z-index:999;
        background:rgba(5,0,30,0.72);
        backdrop-filter:blur(8px);
        padding:20px;
        overflow-y:auto;
        align-items:center;
        justify-content:center;
     "
     onclick="if(event.target===this)closeEditModal()">

    <div style="
        width:100%;
        max-width:400px;
        background:linear-gradient(160deg,#0e0e35,#160840);
        border:1px solid rgba(135,206,235,0.12);
        border-radius:24px;
        padding:22px;
        position:relative;
    ">

        <div style="display:flex;
                    justify-content:space-between;
                    align-items:center;
                    margin-bottom:20px">

            <div>
                <div style="font-size:16px;
                            font-weight:600;
                            color:#F0FFFF">
                    Edit Film
                </div>

                <div style="font-size:11px;
                            color:rgba(240,255,255,0.35)">
                    Update data film
                </div>
            </div>

            <button onclick="closeEditModal()"
                    style="
                        width:32px;
                        height:32px;
                        border:none;
                        border-radius:10px;
                        cursor:pointer;
                        background:rgba(255,255,255,0.08);
                        color:white;
                    ">
                ✕
            </button>
        </div>

        <form id="editForm"
              method="POST"
              style="display:grid;gap:14px">

            @csrf
            @method('PUT')

            @include('movies._form')

            <div style="display:flex;gap:10px">

                <button type="submit"
                        class="btn-primary"
                        style="flex:1">
                    Update
                </button>

                <button type="button"
                        onclick="closeEditModal()"
                        class="btn-ghost">
                    Batal
                </button>

            </div>
        </form>

    </div>
</div>

<script>

       function openModal() {
            const m = document.getElementById('movieModal');
            const form = m.querySelector('form');
            form.querySelector('[name="title"]').value = '';
            form.querySelector('[name="genre"]').value = '';
            form.querySelector('[name="status"]').value = 'want to watch';
            form.querySelector('[name="rating"]').value = '';
            form.querySelector('[name="description"]').value = '';
            m.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const m = document.getElementById('movieModal');
            m.style.display = 'none';
            document.body.style.overflow = '';
        }

        function openEditModal(button, id) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');

        form.action = `/movies/${id}`;

        const card = button.closest('[data-title]');

        form.querySelector('[name="title"]').value = card.dataset.title || '';
        form.querySelector('[name="genre"]').value = card.dataset.genre || '';
        form.querySelector('[name="status"]').value = card.dataset.status || '';
        form.querySelector('[name="rating"]').value = card.dataset.rating || '';
        form.querySelector('[name="description"]').value = card.dataset.description || '';

        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {

        if(e.key === 'Escape') {
            closeModal();
            closeEditModal();
        }

    });

    @if($errors->any())
        openModal();
    @endif

</script>
    @endauth

</x-app-layout>