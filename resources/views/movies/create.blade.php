<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="topbar-title">Tambah Film</div>
            <div class="topbar-sub">Isi detail film baru</div>
        </div>
    </x-slot>

    <div style="max-width:520px">
        <form action="{{ route('movies.store') }}" method="POST"
              style="background:rgba(240,255,255,0.05);border:0.5px solid rgba(135,206,235,0.15);border-radius:14px;padding:24px;display:grid;gap:16px">
            @csrf
            @include('movies._form')
            <div style="display:flex;gap:10px;padding-top:4px">
                <button type="submit" class="btn-primary">Simpan Film</button>
                <a href="{{ route('movies.index') }}" class="btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>